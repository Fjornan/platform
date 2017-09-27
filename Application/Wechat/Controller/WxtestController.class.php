<?php

namespace Wechat\Controller;

use Think\Controller;

class WxtestController extends Controller{
	public function _initialize(){
		// $this->getUserInfo();
		
	}
	private function getUserInfo(){
		//通过code换取token  
		$code = $_GET['code'];  
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=appid&secret=SECRET&code=$code&grant_type=authorization_code";  
		$json = file_get_contents($url);  
		$arr = json_decode($json,true);  
		$token = $arr['access_token'];  
		$openid = $arr['openid'];  
		//拿到token后就可以获取用户基本信息了  
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid ";  
		$json = file_get_contents($url);//获取微信用户基本信息  
		$arr = json_decode($json,true);  
		$name = $arr['nickname'];//昵称  
		$imgURL = $arr['headimgurl'];//头像地址  
		$sex = $arr['sex'];//性别  
		$province = $arr['province'];//用户个人资料填写的省份  
		$city= $arr['city'];//普通用户个人资料填写的城市  
		$country= $arr['country'];//国家，如中国为CN
	}
}