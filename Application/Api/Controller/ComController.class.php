<?php

namespace Api\Controller;

use Think\Controller;

class ComController extends Controller{
	public function _initialize(){
		//判断是否存在session
		
		//在数据库中查找该openid的用户

        //若用户不存在，则新生成一条用户数据，并生成token
        
        //写入用户session（user.name && user.token && user.openid）
        session('user.name','fjn');
        session('user.token','1c549ce1184a9ad16594f5d71f6d932d');
	}
}