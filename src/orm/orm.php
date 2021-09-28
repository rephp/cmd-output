<?php

namespace rephp\output\orm;

use rephp\output\maker\maker;

/**
 * orm模型
 * @package rephp\output\orm
 */
class orm
{
    /**
     * 加粗标题格式化字符串(黑色白底加粗)
     * @var string
     */
    protected $titleFormat = "\033[38;5;15m%s\033[0m";

    /**
     * 成功提示格式化字符串(绿色白底)
     * @var string
     */
    protected $successFormat = "\033[32m%s\033[0m";

    /**
     * 错误提示格式化字符串(白色红底)
     * @var string
     */
    protected $errorFormat = "\033[41;97m%s\033[0m";

    /**
     * 警告提示格式化字符串(红色白底)
     * @var string
     */
    protected $warningFormat = "\033[31m%s\033[0m";

    /**
     * 通知提示格式化字符串(棕色白底)
     * @var string
     */
    protected $noticeFormat = "\033[33m%s\033[0m";

    /**
     * 普通提示格式化字符串(黑色白底)
     * @var string
     */
    protected $infoFormat = "\033[0m%s\033[0m";

    /**
     * orm最终所有二维记录
     * @var array
     */
    protected $content = [];

    /**
     * 临时行记录
     * @var array
     */
    protected $row = [];

    /**
     * 临时元素记录
     * @var string
     */
    protected $item = '';

    /**
     * 追加item元素内容
     * @param string  $format    格式字符串
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow  是否换行
     * @return orm
     */
    protected function appendItem($format, $msg, $isEndItem = false, $isEndRow = false)
    {
        $this->item .= sprintf($this->infoFormat, $msg);
        return $this->endItem($isEndItem)->endRow($isEndRow);
    }

    /**
     * 普通消息(黑色白底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow  是否换行
     * @return $this
     */
    public function info($msg, $isEndItem = false, $isEndRow = false)
    {
        return $this->appendItem($this->infoFormat, $msg, $isEndItem, $isEndRow);
    }

    /**
     * 标题消息(黑色白底加粗)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow  是否换行
     * @return $this
     */
    public function title($msg, $isEndItem = false, $isEndRow = false)
    {
        return $this->appendItem($this->titleFormat, $msg, $isEndItem, $isEndRow);
    }

    /**
     * 通知消息(棕色白底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow  是否换行
     * @return $this
     */
    public function notice($msg, $isEndItem = false, $isEndRow = false)
    {
        return $this->appendItem($this->noticeFormat, $msg, $isEndItem, $isEndRow);
    }

    /**
     * 警告消息(红色白底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow  是否换行
     * @return $this
     */
    public function warning($msg, $isEndItem = false, $isEndRow = false)
    {
        return $this->appendItem($this->warningFormat, $msg, $isEndItem, $isEndRow);
    }

    /**
     * 成功消息(绿色白底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow  是否换行
     * @return $this
     */
    public function success($msg, $isEndItem = false, $isEndRow = false)
    {
        return $this->appendItem($this->successFormat, $msg, $isEndItem, $isEndRow);
    }

    /**
     * 错误消息(白色红底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow  是否换行
     * @return $this
     */
    public function error($msg, $isEndItem = false, $isEndRow = false)
    {
        return $this->appendItem($this->errorFormat, $msg, $isEndItem, $isEndRow);
    }

    /**
     * 拼接tab空字符
     * @return $this
     */
    public function tab($num = 4, $isEndItem = false, $isEndRow = false)
    {
        return $this->appendItem(str_repeat(' ', $num), '', $isEndItem, $isEndRow);
    }

    /**
     * 关闭元素
     * @param bool $isEndItem 是否关闭元素
     * @return $this
     */
    public function endItem($isEndItem = false)
    {
        if (!$isEndItem) {
            return $this;
        }
        $this->row[] = $this->item;
        $this->item  = '';

        return $this;
    }

    /**
     * 回车换行
     * @param bool $isEndRow 是否换行（结束行信息录入）
     * @return $this
     */
    public function endRow($isEndRow = false)
    {
        if (!$isEndRow) {
            return $this;
        }
        $this->row[]     = $this->item;
        $this->item      = '';
        $this->content[] = $this->row;
        $this->row       = [];

        return $this;
    }

    /**
     * 获取格式化后的数据内容
     * @return string
     */
    public function get()
    {
        //元素和tr清理后入content
        if(!empty($this->item) || !empty($this->row)){
            $this->endRow(true);
        }
        return maker::get($this->content);
    }

}