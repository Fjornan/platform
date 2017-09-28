<?php
namespace Wechat\Controller;

class PublicController extends ComController {
    public function index(){
        $this->display();
    }
    public function header(){
    	$this->display();
    }
    public function alert(){
    	$this->display();
    }
}