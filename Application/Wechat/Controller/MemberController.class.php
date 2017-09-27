<?php
namespace Wechat\Controller;

class MemberController extends ComController {
	//我的鲸卡
    public function index(){
        $this->display();
    }
    //申领鲸卡
    public function register(){
    	$this->display();
    }
}