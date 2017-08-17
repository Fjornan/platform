<?php
//状态码
// function statusMsg($error){
// 	switch ($error) {
// 		case 0:
// 			$msg = '数据获取成功';
// 			break;
// 		case 101:
// 			$msg = '参数不能为空';
// 			break;
// 		case 102:
// 			$msg = '参数格式错误';
// 			break;
// 		case 103:
// 			$msg = '参数不存在';
// 			break;
// 		case 104:
// 			$msg = '信息匹配失败';
// 			break;
// 		case 105:
// 			$msg = '添加到数据库失败';
// 			break;
// 		case 106:
// 			$msg = '图片上传失败';
// 			break;
// 		case 201:
// 			$msg = '没有操作权限';
// 			break;
// 		case 998:
// 			$msg = '系统繁忙，请稍后再试';
// 			break;
// 		case 999:
// 			$msg = 'token错误或已失效，请重新登录';
// 			break;
// 		default:
// 			$msg = '系统繁忙';
// 			break;
// 	}
// 	return $msg;

// }
// //统一返回数据格式
// function combineResult($error,$msg,$res){
// 	$result['error'] = $error;
// 	if($msg == ''){
// 		$result['msg'] = statusMsg($error);
// 	}else{
// 		$result['msg'] = $msg;
// 	}
// 	$result['data'] = $res;
// 	return $result;
// }
// //解析并返回token
// function decodeToken($token){
//     $str = base64_decode($token);
//     $result['time'] = explode('&',$str)[0];
//     $result['phone'] = explode('&',$str)[1];
//     $result['rule'] = explode('&',$str)[2];
//     return $result;
// }
// //判断token是否过期
// function verifyToken($token){
// 	$arr = decodeToken($token);
// 	$now = strtotime('now');

// 	$search['phone'] = $arr['phone'];
// 	$data = M('user')->where($search)->find();

// 	// token失效时间 10天
// 	if($token == '' || $data['token']!=$token || $now-$arr['time'] > 864000){
// 		$result['status'] = false;
// 	}else{
// 		$result['status'] = true;
// 	}
// 	$result['id'] = $data['id'];
// 	$result['phone'] = $arr['phone'];
// 	return $result;
// }
function verifyManager($token){
	$arr = decodeToken($token);
	$now = strtotime('now');

	$search['phone'] = $arr['phone'];
	$data = M('user')->where($search)->find();

	// token失效时间 10天
	if($token == '' || $data['token']!=$token || $now-$arr['time'] > 864000){
		$result['status'] = 1;
	}else if($data['type'] != 1){
		$result['status'] = 2;
	}else{
		$result['status'] = 0;
	}
	$result['id'] = $data['id'];
	$result['phone'] = $arr['phone'];
	return $result;
}
// //判断手机号格式
// function verifyMobile($phone){
// 	$reg = '/^1[34578]{1}\d{9}$/';
// 	if(preg_match($reg, $phone)){
// 		return true;
// 	}else{
// 		return false;
// 	}
// }