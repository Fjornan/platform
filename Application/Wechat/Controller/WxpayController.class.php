<?php
namespace Wechat\Controller;

class WxpayController extends ComController {
    public function index(){
        $condition['id'] = I('get.id');
        $getData = M('order')->where($condition)->find();
        if($getData['status'] == 0){
            $status = '待支付';
        }else if($getData['status'] == 1){
            $status = '处理中';
        }else if($getData['status'] == 2){
            $status = '已完成';
        }
        $pro_list = explode(",", $getData['product_sign']);
        $pro_arr = array();
        $db_pro = M('product');
        for($i=0;$i<count($pro_list);$i++){
            $search['sign'] = $pro_list[$i];
            $data = M('product')->where($search)->find();
            array_push($pro_arr, $data);
        }
        $this->assign('detail',$pro_arr);
        $this->assign('price',$getData['price']); 
        $this->assign('status',$status);
        // var_dump($data);
        $this->display();
    }

    function wx_notify(){
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