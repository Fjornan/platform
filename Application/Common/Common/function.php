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
			$msg = '鲸航VIP专享资源，请先注册';
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



/**
 * 使用curl获取远程数据
 * @param  string $url url连接
 * @return string      获取到的数据
 */
function curl_get_contents($url){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
    // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
    curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    $r=curl_exec($ch);
    curl_close($ch);
    return $r;
}