<?php
namespace Mt\Controller;
class RuleController extends AuthController {

    private $sModel;
    public function __construct() {
        parent::__construct();
        $this->sModel = M('auth_rule');
        $this->assign('seo', array('title'=>'后台节点管理'));
    }

    public function index()
    {
        $page = I('get.p');
        $page = $page ? $page : 1;
        $size = 15;
        $where = array();
        $list = $this->getData($where, $page, $size);
        $this->assign('list', $list);

        $this->display();
    }
    public function add()
    {
        $id = I('id');

        if (IS_POST)
        {
            $id = I('post.id');
            $data = I('post.');
            if (!$data['title'])$this->ajaxReturn(array('s'=>false, 'error'=> '节点名称不能为空'));
            if (!$data['name'])$this->ajaxReturn(array('s'=>false, 'error'=> '节点规则不能为空'));
            $data['module'] = MODULE_NAME;
            if (!empty($id)) {
                $this->sModel->save($data);
            } else {
                $id = $this->sModel->add($data);
            }

            $this->ajaxReturn(array('s'=>true, 'id'=> $id));
        }


        $menus = $this->sModel->field(true)->select();
        $menus = D('Mt/Tree')->toFormatTree($menus);
        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级节点')), $menus);
        $this->assign('Menus', $menus);
        //printR($menus);

        if ($id) {
            $info = $this->sModel->where(array('id'=>$id))->find();

            $this->assign($info);
        } else {
            $this->assign('pid', I('pid'));
        }
        $this->display();
    }
    private function getData($where, $page, $size)
    {
        $all_menu   =  $this->sModel->getField('id,title');
        $menus = $this->sModel->select();
        $menus = D('Mt/Tree')->toFormatTree($menus);

        foreach ($menus as &$v){
            $v['up_title'] = $all_menu[$v['pid']];
        }
        //printR($menus);
        return $menus;
    }

    public function del()
    {
        $id = I('post.id');
        if ($this->sModel->where(array('pid'=>$id))->getField('id'))$this->ajaxReturn(array('s'=>false, 'info'=> '存在子节点,不能删除'));
        if ($id) $this->sModel->where(array('id'=>$id))->delete();
        $this->ajaxReturn(array('s'=>true, 'id'=> $id));
    }
}