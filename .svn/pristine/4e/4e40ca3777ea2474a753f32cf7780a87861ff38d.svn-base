<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Mt\Lib;
class Helper {


    static function createToken()
    {
        $key = rand(1, 1000000000000000000);
        return md5(md5($key));
    }



    static function password($str)
    {
        return md5('silen'. $str);
    }

    static function showMessage($message, $jumpUrl = ' ', $waitSecond = 3)
    {
        $view = \Think\Think::instance('Think\View');
        $view->assign('jumpUrl', $jumpUrl);
        $view->assign('waitSecond', $waitSecond);
        $view->assign('message', $message);
        $view->display(C('TMPL_ACTION_ERROR'));
        exit;
    }
}