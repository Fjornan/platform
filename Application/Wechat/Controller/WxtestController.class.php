<?php

namespace Wechat\Controller;

use Think\Controller;

class WxtestController extends Controller{
	public function _initialize(){
		$this->getUserInfo();
	}
	private function getUserInfo(){
		$code = $_GET['code'];  
		echo $code;
		// $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=appid&secret=SECRET&code=$code&grant_type=authorization_code";  
		// $json = file_get_contents($url);  
		// $arr = json_decode($json,true);  
		// $token = $arr['access_token'];  
		// $openid = $arr['openid'];
	}
}