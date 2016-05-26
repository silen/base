<?php
namespace Mt\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function _initialize()
    {



    }

    public function index()
    {
        if (\Org\Util\AdminCheck::login()){

            $url = I('redirect') ? I('redirect') : ROOT_HOST. 'index.php?m=mt';
            redirect($url);
        }
        $this->display();
    }

    public function code()
    {
        $verify = new \Org\Util\Verify();
        $verify->setFontSize(18);
        $verify->setImageSize(100, 40);
        $verify->show();
    }
    public function login()
    {
        if (\Org\Util\AdminCheck::login()){

            $url = I('redirect') ? I('redirect') : ROOT_HOST. 'index.php?m=mt';
            redirect($url);
        }
        if (IS_POST){
            $username = I('post.username');
            $password = I('post.password');

            if (!$_SERVER['SERVER_ADDR'] == '127.0.0.1') {
                $code = I('post.code');
                $verify = new \Org\Util\Verify();
                if (!$verify->check($code))$this->ajaxReturn(array('s'=>false, 'info'=>'验证码错误'));
            }

            if (!$username || !$password)$this->ajaxReturn(array('s'=>false, 'info'=>'帐号为空或者密码为空'));

            $userInfo = M('admin')->where(array('username'=>$username, 'password'=>\Mt\Lib\Helper::password($password)))->find();

            if (!$userInfo)$this->ajaxReturn(array('s'=>false, 'info'=>'用户不存在或者密码错误'));

            if (!$userInfo['status'] == 2)$this->ajaxReturn(array('s'=>false, 'info'=>'用户禁止登录'));

            cookie('username', $userInfo['username']);
            $str = "{$userInfo['username']}|{$userInfo['from_id']}|{$userInfo['id']}";
            $auth = uc_authcode($str, 'ENCODE', 'mt.fuckyou.com');
            cookie('auth', $auth);
            $this->ajaxReturn(array('s'=>true, 'info'=>'登录成功'));

        }
    }

    public function logout()
    {
        cookie('username', null);
        cookie('auth', null);
        //session('auth');
        $this->success('退出成功', C('LOGIN_URL'));
    }
}