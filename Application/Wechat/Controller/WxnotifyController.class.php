<?php

namespace Wechat\Controller;

use Think\Controller;

class WxnotifyController extends Controller{
	public function _initialize(){
		
		
	}
	public function notify(){
	    // ↓↓↓下面的file_put_contents是用来简单查看异步发过来的数据 测试完可以删除；↓↓↓
	    // 获取xml
	    $xml=file_get_contents('php://input', 'r');
	    //转成php数组 禁止引用外部xml实体
	    libxml_disable_entity_loader(true);
	    $data= json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA));
	    file_put_contents('./notify.text', $data);
	    // ↑↑↑上面的file_put_contents是用来简单查看异步发过来的数据 测试完可以删除；↑↑↑
	    // 导入微信支付sdk
	    Vendor('Weixinpay.Weixinpay');
	    $wxpay=new \Weixinpay();
	    $result=$wxpay->notify();
	    if ($result) {
	        // 验证成功 修改数据库的订单状态等 $result['out_trade_no']为订单id
	        $id = $result['out_trade_no'];
	    	$db = M('order');
	        $db->where('id='$id)->setField('status',1);

	    }
	}
	
}