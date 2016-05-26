<?php
namespace Mt\Controller;
use Mt\Model\AuthRuleModel;
use Mt\Model\AuthGroupModel;
class AdminController extends AuthController {

    private $sModel;
    public function __construct() {
        parent::__construct();
        $this->sModel = M('admin');
        $this->assign('seo', array('title'=>'后台用户管理'));
    }

    public function index()
    {
        $page = I('get.p');
        $page = $page ? $page : 1;
        $size = 15;
        $where = array();
        $list = $this->getData($where, $page, $size);
        $count      = $this->sModel->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count, $size);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('list', $list);
        $this->assign('show', $show);

        $this->display();
    }
    public function add()
    {
        $id = I('id');

        if (IS_POST)
        {
            $id = I('post.id');
            $status = I('post.status');
            $username = I('post.username');
            $group_id = I('post.group_id');
            $password = I('post.password');
            $email = I('post.email');
            $mobile = I('post.mobile');
            if (! $id){
                if (!$username)$this->ajaxReturn(array('s'=>false, 'error'=> '用户名不能为空'));
                if (!$password)$this->ajaxReturn(array('s'=>false, 'error'=> '密码不能为空'));
                if (!$mobile)$this->ajaxReturn(array('s'=>false, 'error'=> '手机号不能为空'));
                if (!$group_id)$this->ajaxReturn(array('s'=>false, 'error'=> '请选择群组'));
            }

            $insertData = array(
                'status' => $status,
                'username' => $username,
                'password' => \Mt\Lib\Helper::password($password),
                'email' => $email,
                'mobile' => $mobile,
                'group_id' => $group_id,
                'add_time' => time(),
                'update_time' => time(),
                'status' => $status
            );
            if ($id) {
                $insertData['id'] = $id;
                if(!$password)unset($insertData['password']);
                if(!$email)unset($insertData['email']);
                if(!$mobile)unset($insertData['mobile']);
                if(!$username)unset($insertData['username']);
                unset($insertData['add_time']);
                $this->sModel->save($insertData);
            } else {
                $id = $this->sModel->add($insertData);
            }

            $this->ajaxReturn(array('s'=>true, 'id'=> $id));
        }

        $AuthGroup = D('AuthGroup')->select();

        //printR($AuthGroup);
        $this->assign('AuthGroup', $AuthGroup);
        if ($id) {
            $info = $this->sModel->where(array('id'=>$id))->find();

            $this->assign($info);
        } else {
            $this->assign('status', 1);
        }
        $this->display();
    }
    public function info()
    {
        if (IS_POST)
        {
            $id = I('post.id');
            $password = I('post.password');
            $email = I('post.email');
            $mobile = I('post.mobile');
            if (! $id){
                if (!$password)$this->ajaxReturn(array('s'=>false, 'error'=> '密码不能为空'));
                if (!$mobile)$this->ajaxReturn(array('s'=>false, 'error'=> '手机号不能为空'));
            }

            $insertData = array(
                'password' => \Mt\Lib\Helper::password($password),
                'email' => $email,
                'mobile' => $mobile,
                'update_time' => time(),
            );
            if ($id) {
                $insertData['id'] = $id;
                if(!$password)unset($insertData['password']);
                if(!$email)unset($insertData['email']);
                if(!$mobile)unset($insertData['mobile']);
                $this->sModel->save($insertData);
            }

            $this->ajaxReturn(array('s'=>true, 'id'=> $id));
        }
        $userid = session('userid');
        $info = $this->sModel->where(array('id'=>$userid))->find();

        //$AuthGroup = D('AuthGroup')->select();
        //printR($AuthGroup);
        //$this->assign('isInfo', true);
        $this->assign($info);
        $this->display();
    }
    private function getData($where, $page, $size)
    {
        $list = $this->sModel->where($where)->page("{$page}, {$size}")->order('id DESC')->select();
        $AuthGroup   =  D('AuthGroup')->getField('id,title');
        foreach ($list as &$v){
            $v['status_val'] = $v['status'] == 1 ? '正常' : '禁止';
            $v['group_title'] = $AuthGroup[$v['group_id']];
        }

        return $list;
    }

    public function del()
    {
        $id = I('post.id');
        if ($id) $this->sModel->where(array('id'=>$id))->delete();
        $this->ajaxReturn(array('s'=>true, 'id'=> $id));
    }

    public function group()
    {
        $list = D('AuthGroup')->where(array('module'=>MODULE_NAME))->order('id ASC')->select();
        foreach ($list as &$v){
            $v['status_val'] = $v['status'] == 1 ? '正常' : '禁止';
        }

        $this->assign('list', $list);

        $this->display();
    }

    public function group_del()
    {
        $id = I('post.id');
        if ($id) D('AuthGroup')->where(array('id'=>$id))->delete();
        $this->ajaxReturn(array('s'=>true, 'id'=> $id));
    }
    public function group_add()
    {
        if(IS_POST){
            if(isset($_POST['rules'])){
                sort($_POST['rules']);
                $_POST['rules']  = implode( ',' , array_unique($_POST['rules']));
            }
            $_POST['module'] =  MODULE_NAME;
            $_POST['type']   =  AuthGroupModel::TYPE_ADMIN;
            $AuthGroup       =  D('AuthGroup');
            $data = $AuthGroup->create();
            if ( $data ) {
                if ( empty($data['id']) ) {
                    $r = $AuthGroup->add();
                }else{
                    $r = $AuthGroup->save();
                    $r = $data['id'];
                }
                $this->ajaxReturn(array('s'=>true, 'id'=> $r));
            }
            $this->ajaxReturn(array('s'=>true, 'id'=> $r));
        }
        $id = I('id');
        if ($id) {
            $info = D('AuthGroup')->where(array('id'=>$id))->find();
            $this->assign($info);
        } else {
            $this->assign('status', 1);
        }
        $this->display();
    }


    public function auth()
    {
        $AuthRule =  M('AuthRule')->where(array('module'=>MODULE_NAME))->order('sort ASC,id ASC')->select();
        $AuthRule = D('Mt/Tree')->toTree($AuthRule);
        //printR($AuthRule);
        $groupId = I('group_id');
        $groupInfo = D('AuthGroup')->where(array('id'=>$groupId))->find();
        $groupInfo['_rules'] = explode(',', $groupInfo['rules']);
        //printR($groupInfo);
        $this->assign('AuthRule', $AuthRule);
        $this->assign($groupInfo);
        $this->display();
    }
    public function writeAccess()
    {
        if(IS_POST){
            //$data = I('post.');
            if(isset($_POST['rules'])){
                sort($_POST['rules']);
                $_POST['rules']  = implode( ',' , array_unique($_POST['rules']));
            }
            $AuthGroup       =  D('AuthGroup');
            $_POST['id'] = $_POST['group_id'];
            if ( empty($_POST['id']) ) {
                $r = $AuthGroup->add($_POST);
            }else{
                $r = $AuthGroup->save($_POST);
            }
            $this->success('操作成功!',U('auth', array('group_id'=>$_POST['id'])));
        }
    }
}