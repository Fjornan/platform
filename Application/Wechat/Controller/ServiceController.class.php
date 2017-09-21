<?php
namespace Wechat\Controller;

class ServiceController extends ComController {
    public function index(){
    	// $name = 'hello';
    	// $this->assign('name',$name);
        $this->display();
    }
    public function gszc(){
    	$this->display();
    }
}