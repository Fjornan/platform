<?php
namespace Wechat\Controller;

class ShopController extends ComController {
    public function index(){
        $this->display();
    }
    public function amazonReg(){
    	$this->display();
    }
    public function apiAmazonReg(){
    	if(session('id') == null){
			$error = 1;
			$msg = '登录失效，请退出重新进入';
		}else{
			$error = 0;
			$msg = '注册成功，请等待客服联系';
		}

		$result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
}