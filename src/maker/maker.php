<?php

namespace rephp\output\maker;

/**
 * 解析orm生成结果内容
 * @package rephp\output\maker
 */
class maker
{

    public static function parsePreItemWidthInfo()
    {
        if(empty($this->tr)){
            return $this;
        }
        foreach($this->tr as $index=>$td){
            $td = preg_replace("/\033\[[^m]*m/", '', $td);
            $length = strlen(iconv('UTF-8', 'GB2312', $td));
            if(isset($this->padWidthArr[$index])){
                ($this->padWidthArr[$index] < $length) && $this->padWidthArr[$index] = $length;
            }else{
                $this->padWidthArr[$index] = $length;
            }
        }

        return $this;
    }

    /**
     * 计算要填充的空内容
     * @param string $tempTd  单元格内容
     * @param $length 预期单元格最大宽度
     * @return string
     */
    public function getRepeat($tempTd, $length)
    {
        $strLength =  strlen($tempTd);
        if($strLength>=$length){
            return '';
        }

        return str_repeat(' ', ($length-$strLength));
    }

    /**
     * 生成结果
     * @param orm $orm
     * @return string
     */
    public static function get($content)
    {
        if(empty($content)){
            return '';
        }
        return PHP_EOL;
    }

}