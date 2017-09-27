<?php
function isAdmin(){
	$token = I('post.token');
	$condition['token'] = $token;
	if(M('admin')->where($condition)->find()){
		return true;
	}else{
		return false;
	}
}