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

function getUserInfo($user_id){
	$db_user = M('user');
	$condition['id'] = $user_id;
    $userinfo = $db_user->where($condition)->find();
    return $userinfo;
}