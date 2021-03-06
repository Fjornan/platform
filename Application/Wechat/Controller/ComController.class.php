<?php

namespace Wechat\Controller;

use Think\Controller;

class ComController extends Controller{
	public function _initialize(){
		// session('id',1);
		// session('member',1);
		// session('openid','opkc-wsEIvhQ-WRildlGbaDSODn0');
		$state =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if(session('id') == null || session('openid') == null){
			$this->getCode($state);
			// $this->getUserInfo();
		}else{

		}
	}
	private function getUserInfo(){
		//通过code换取token  
		$code = $_GET['code'];  
		$appid = 'wx205959c817c7f864';
		$appsecret = 'da33bab21ed082590ad954080662092a';
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=$code&grant_type=authorization_code";  
		$json = file_get_contents($url);  
		$arr = json_decode($json,true);  
		$token = $arr['access_token'];  
		$openid = $arr['openid'];
		if($openid){
			//查询数据库中的用户记录
			$db_user = M('user');
			$condition['openid'] = $openid;
			$userinfo = $db_user->where($condition)->find();
			if($userinfo){
				$id = $userinfo['id'];
				$member = $userinfo['is_member'];
			}else{
				//不存在插入一条用户数据
				$add_data['openid'] = $openid;
				$id = $db_user->add($add_data);  
				$memeber = $db_user->where('id='.$id)->getField('is_member');
			}
			session('id',$id);
			session('openid',$openid);
			session('member',$member);
			//拿到token后就可以获取用户基本信息了  
			// $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid ";  
			// $json = file_get_contents($url);//获取微信用户基本信息  
			// $arr = json_decode($json,true);  
			// $name = $arr['nickname'];//昵称  
			// $imgURL = $arr['headimgurl'];//头像地址  
			// $sex = $arr['sex'];//性别  
			// $province = $arr['province'];//用户个人资料填写的省份  
			// $city= $arr['city'];//普通用户个人资料填写的城市  
			// $country= $arr['country'];//国家，如中国为CN
		}

		
	}
	public function getCode($state){
        // 获取配置项
        $config=C('WEIXINPAY_CONFIG');
        // 如果没有get参数没有code；则重定向去获取openid；
        
        $redirect_uri=U('Wechat/Setuser/index','','',true);
        $redirect_uri=urlencode($redirect_uri);
        $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$config['APPID'].'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_base&state='.$state.'#wechat_redirect';
        redirect($url);

    }

    public function setUser(){
    	$code = $_GET['code'];  
		$appid = 'wx205959c817c7f864';
		$appsecret = 'da33bab21ed082590ad954080662092a';
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=$code&grant_type=authorization_code";  
		$json = file_get_contents($url);  
		$arr = json_decode($json,true);  
		$token = $arr['access_token'];  
		$openid = $arr['openid'];
		if($openid){
			//查询数据库中的用户记录
			$db_user = M('user');
			$condition['openid'] = $openid;
			$userinfo = $db_user->where($condition)->find();
			if($userinfo){
				$id = $userinfo['id'];
				$member = $userinfo['is_member'];
			}else{
				//不存在插入一条用户数据
				$add_data['openid'] = $openid;
				$id = $db_user->add($add_data);  
				$memeber = $db_user->where('id='.$id)->getField('is_member');
			}
			session('id',$id);
			session('openid',$openid);
			session('member',$member);
			//拿到token后就可以获取用户基本信息了  
			// $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid ";  
			// $json = file_get_contents($url);//获取微信用户基本信息  
			// $arr = json_decode($json,true);  
			// $name = $arr['nickname'];//昵称  
			// $imgURL = $arr['headimgurl'];//头像地址  
			// $sex = $arr['sex'];//性别  
			// $province = $arr['province'];//用户个人资料填写的省份  
			// $city= $arr['city'];//普通用户个人资料填写的城市  
			// $country= $arr['country'];//国家，如中国为CN
		}

    }
}