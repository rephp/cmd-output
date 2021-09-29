<?php
namespace demo;

use rephp\output\output;

class demo{

    function test()
    {
        return output::find()
              ->title('这是一个测试', 1, 1)
              ->success('测试缩进', 0)->tab(5)->info('info类型语句', 1)->info('要换行啦', 1)->br()
              ->success('success类型语句:create-permission', 1, 0)->warning('warning类型语句', 1,  true)
              ->br()
              ->error('error类型语句', 1, 0)->info('info类型语句', 1)
              ->get();
    }
}

$teser = new demo();
echo $teser->test();