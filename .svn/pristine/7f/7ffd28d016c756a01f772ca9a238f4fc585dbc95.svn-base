<?php
namespace Mt\Controller;
class ToolController extends AuthController {

    private $sModel;
    public function __construct() {
        parent::__construct();
        //$this->sModel = M();
       
    }


    public function upload()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     31457280 ;// 设置附件上传大小
        $upload->saveName      =     array('uniqid', '');// 设置附件上传类型
        $upload->exts      =     array();// 设置附件上传类型
        $upload->rootPath  =     UPLOADS_PATH.'attach/'; // 设置附件上传根目录
        \Org\Util\File::mk_dir($upload->rootPath);
        $upload->replace  =     true; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->subName  = array('date','Ym');
        // 上传文件
        $info   =   $upload->upload();
        if (!$info) {
            echo $upload->getError();
            exit;
        }
        $this->ajaxReturn(array('info' => ltrim($upload->rootPath  . $info[0]['savepath'] . $info[0]['savename'], '.')));
    }
}