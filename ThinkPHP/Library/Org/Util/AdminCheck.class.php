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

namespace Org\Util;
/**
 * 日期时间操作类
 * @category   ORG
 * @package  ORG
 * @subpackage  Date
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id: Date.class.php 2662 2012-01-26 06:32:50Z liu21st $
 */
class AdminCheck {

    static public function checkAuth(){
        if (!self::login())redirect(C('LOGIN_URL'));

        $userInfo = M('admin')->where(array('id'=>session('userid')))->find();
        session('userInfo', serialize($userInfo));
        return true;
    }


    static public function login()
    {
        $auth = cookie('auth');
        if (!$auth) return false;
        $auth = uc_authcode($auth, 'DECODE', 'mt.fuckyou.com');
        if (!$auth) return false;
        list($username, $from_id, $userid) = explode('|', $auth);
        session('username', $username);
        session('userid', $userid);

        return true;
    }

    static public function getUid()
    {
        if (!self::login())return 0;
        return session('userid');
    }
}