<?php
namespace rephp\output;

use rephp\output\orm\orm;

/**
 * console输出类
 *
 * @example  echo output::find()
 * ->title('这是一个测试', 1, 1)
 * ->success('测试缩进', 0)->tab(5)->info('info类型语句', 1)->info('要换行啦', 1)->br()
 * ->success('success类型语句:create-permission', 1, 0)->warning('warning类型语句', 1,  true)
 * ->br()
 * ->error('error类型语句', 1, 0)->info('info类型语句', 1)
 * ->get();
 * @package rephp\output
 */
class output
{
    /**
     * orm模型对象
     * @var orm
     */
    protected $orm;

    /**
     * 获取实例化自身对象
     * @return static
     */
    public static function find()
    {
        return new static();
    }

    /**
     * 获取orm模型对象
     * @return orm
     */
    public function getOrm()
    {
        if(!is_object($this->orm)){
            $this->orm = new orm();
        }

        return $this->orm;
    }

    /**
     * 普通消息(黑色白底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow      是否换行
     * @return $this
     */
    public function info($msg, $isEndItem = false, $isEndRow = false)
    {
        $this->getOrm()->info($msg, $isEndItem, $isEndRow);
        return $this;
    }

    /**
     * 标题消息(黑色白底加粗)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow      是否换行
     * @return $this
     */
    public function title($msg, $isEndItem = false, $isEndRow = false)
    {
        $this->getOrm()->title($msg, $isEndItem, $isEndRow);
        return $this;
    }

    /**
     * 通知消息(棕色白底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow      是否换行
     * @return $this
     */
    public function notice($msg, $isEndItem = false, $isEndRow = false)
    {
        $this->getOrm()->notice($msg, $isEndItem, $isEndRow);
        return $this;
    }

    /**
     * 警告消息(红色白底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow      是否换行
     * @return $this
     */
    public function warning($msg, $isEndItem = false, $isEndRow = false)
    {
        $this->getOrm()->warning($msg, $isEndItem, $isEndRow);
        return $this;
    }

    /**
     * 成功消息(绿色白底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow      是否换行
     * @return $this
     */
    public function success($msg, $isEndItem = false, $isEndRow = false)
    {
        $this->getOrm()->success($msg, $isEndItem, $isEndRow);
        return $this;
    }

    /**
     * 错误消息(白色红底)
     * @param string  $msg       消息内容
     * @param boolean $isEndItem 是否关闭当前元素块
     * @param boolean $isEndRow      是否换行
     * @return $this
     */
    public function error($msg, $isEndItem = false, $isEndRow = false)
    {
        $this->getOrm()->error($msg, $isEndItem, $isEndRow);
        return $this;
    }

    /**
     * 拼接tab空字符
     * @return $this
     */
    public function tab($num = 4, $isEndItem = false, $isEndRow = false)
    {
        $this->getOrm()->tab($num, $isEndItem, $isEndRow);
        return $this;
    }

    /**
     * 关闭元素
     * @return $this
     */
    public function endItem()
    {
        $this->getOrm()->endItem(true);
        return $this;
    }

    /**
     * 回车换行
     * @return $this
     */
    public function endRow()
    {
        $this->getOrm()->endRow(true);
        return $this;
    }

    /**
     * 获取格式化后的数据内容
     * @return string
     */
    public function get()
    {
        return $this->getOrm()->get();
    }

}