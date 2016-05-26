<?php
namespace Mt\Controller;
class IndexController extends AuthController {

    private $sModel;
    public function __construct() {
        parent::__construct();
        $this->sModel = M('admin');
       
    }

    public function index()
    {


        $this->display();

    }
}