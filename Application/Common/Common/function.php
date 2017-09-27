<?php
//状态码
function statusMsg($error){
	switch ($error) {
		case 0:
			$msg = '操作成功';
			break;
		case 101:
			$msg = 'token不存在或已失效，请重新登录';
			break;
		case 102:
			$msg = '暂无操作权限';
			break;
		case 103:
			$msg = '请求超时，请稍后再试';
			break;
		case 201:
			$msg = '登录失效，请关闭公众号重新进入';
			break;
		case 202:
			$msg = '成为鲸航Vip用户才可操作哟';
			break;
		default:
			$msg = '系统繁忙，请稍后再试';
			break;
	}
	return $msg;
}
//统一返回数据格式
function return_json($error,$msg,$res){
	$result['error'] = $error;
	if($msg == ''){
		$result['msg'] = statusMsg($error);
	}else{
		$result['msg'] = $msg;
	}
	$result['data'] = $res;
	return $result;
}

//判断手机号格式
function verifyMobile($phone){
	$reg = '/^1[34578]{1}\d{9}$/';
	if(preg_match($reg, $phone)){
		return true;
	}else{
		return false;
	}
}
//测试
function commonTest(){
	return 'hello';
}