<?php
namespace Wechat\Controller;

class UnionController extends ComController {
	//鲸航联盟主页
    public function index(){
        $this->display();
    }
   	//找货源
    public function seekGoods(){
    	$this->display();
    }
    //有货源
    public function hasGoods(){
    	$this->display();
    }
   	//自荐、求职
    public function apply(){
    	$this->display();
    }
    //求才、招聘
    public function recruit(){
    	$this->display();
    }
    //当期活动
    public function activity(){
        $this->display();
    }
    //联合运营
    public function operate(){
        $this->display();
    }
}