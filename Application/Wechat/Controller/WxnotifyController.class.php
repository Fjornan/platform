<?php

namespace Wechat\Controller;

use Think\Controller;

class WxnotifyController extends Controller{
	public function _initialize(){
		
		
	}
	public function notify(){
	    Vendor('Weixinpay.Weixinpay');
    	$wxpay=new \Weixinpay();
    	$result=$wxpay->notify();
	    if ($result) {
	        // 验证成功 修改数据库的订单状态等 $result['out_trade_no']为订单id
	        $id = $result['out_trade_no'];
	        // $id = 1;
	    	$db = M('order');
	        $db->where('id='.$id)->setField('status',1);

	    }
	}
	
}