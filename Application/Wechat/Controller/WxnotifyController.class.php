<?php

namespace Wechat\Controller;

use Think\Controller;

class WxnotifyController extends Controller{
	public function _initialize(){
		
		
	}
	public function wx_notify(){
        Vendor('Wxpay.WxPay#Api');
        $raw_xml = file_get_contents("php://input");
        $notify = new \WxPayNotifyCallBack();
        $notify->Handle(false);
        $res = $notify->GetValues();
        if($res['return_code'] ==="SUCCESS" && $res['return_msg'] ==="OK"){
            libxml_disable_entity_loader(true);
            $ret = json_decode(json_encode(simplexml_load_string($raw_xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            \Think\Log::write('微信APP支付成功订单号'.$ret['out_trade_no'], \Think\Log::DEBUG);
            //在此处处理业务逻辑部分
            echo "支付成功";
        }
    }
	
}