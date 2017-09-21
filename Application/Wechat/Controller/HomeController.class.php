<?php
namespace Wechat\Controller;

class HomeController extends ComController {
    public function index(){
    	$name = 'hello';
    	$this->assign('name',$name);
        $this->display();
    }
    public function add(){
    	$this->display();
    }
}