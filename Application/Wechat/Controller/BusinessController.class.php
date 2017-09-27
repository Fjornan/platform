<?php
namespace Wechat\Controller;

class BusinessController extends ComController {
	//商务合作
    public function index(){
    	session(null);
        $this->display();
    }
}