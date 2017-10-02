<?php

namespace Wechat\Controller;

use Think\Controller;

class WxnotifyController extends Controller{
	public function _initialize(){
		
		
	}
	public function notify(){
	    // ↓↓↓下面的file_put_contents是用来简单查看异步发过来的数据 
	    // 导入微信支付sdk
	    Vendor('Weixinpay.Weixinpay');
	    $wxpay=new \Weixinpay();
	    $result=$wxpay->notify();
	    if ($result) {
	        // 验证成功 修改数据库的订单状态等 $result['out_trade_no']为订单id
	        $id = substr($result['out_trade_no'],14);
	    	$db = M('order');
	        $db->where('id='.$id)->setField('status',1);

	    }
	}
	
}