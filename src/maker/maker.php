<?php
namespace rephp\output\maker;

/**
 * 解析orm生成结果内容
 * @package rephp\output\maker
 */
class maker
{
	/**
     * 元素宽度配置信息-自动计算
     * @var array
     */
    protected static $columnWidthConfig = [];

    /**
     * 计算元素宽度
     * @param array $content 所有内容数组
     * @return bool
     */
    public static function parseItemWidth($content)
    {
        foreach ($content as $row) {
            foreach ($row as $index => $item) {
                $item   = preg_replace("/\033\[[^m]*m/", '', $item);
                $length = strlen(iconv('UTF-8', 'GB2312', $item));
                if (isset(self::$columnWidthConfig[$index])) {
                    (self::$columnWidthConfig[$index] < $length) && self::$columnWidthConfig[$index] = $length;
                } else {
                    self::$columnWidthConfig[$index] = $length;
                }
            }
        }

        return true;
    }

    /**
     * 计算元素要填充的空内容
     * @param string $item  元素内容
     * @param int    $index 当前元素序号
     * @return string
     */
    public static function getRepeat($item, $index)
    {
        $tempRow   = iconv('UTF-8', 'GB2312', preg_replace("/\033\[[^m]*m/", '', $item));
        $length    = isset(self::$columnWidthConfig[$index]) ? self::$columnWidthConfig[$index] : 20;
        $strLength = strlen($tempRow);
        if ($strLength >= $length) {
            return '';
        }

        return str_repeat(' ', ($length - $strLength));
    }

    /**
     * 生成结果
     * @param orm $orm
     * @return string
     */
    public static function get($content)
    {
        if (empty($content)) {
            return '';
        }
        //计算元素宽度
        self::parseItemWidth($content);
        $result = '';
        foreach ($content as $row) {
            foreach ($row as $index => $item) {
                $result .= $item . self::getRepeat($item, $index) . '  ';
            }
            $result .= PHP_EOL;
        }

        return $result;
    }

}