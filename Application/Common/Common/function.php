<?php
//状态码
function statusMsg($error){
	switch ($error) {
		case 0:
			$msg = '操作成功';
			break;
		case 1:
			$msg = 'token不存在或已失效，请重新登录';
			break;
		case 2:
			$msg = '暂无操作权限';
			break;
		case 3:
			$msg = '请求超时，请稍后再试';
			break;
		default:
			$msg = '系统繁忙，请稍后再试';
			break;
	}
	return $msg;
}
//统一返回数据格式
function return_json($error,$res,$msg){
	$result['error'] = $error;
	$result['data'] = $res;
	if($msg == ''){
		$result['msg'] = statusMsg($error);
	}else{
		$result['msg'] = $msg;
	}
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