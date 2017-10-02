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

        $order =  $getData;
        Vendor('Weixinpay.Weixinpay');
        $wxpay=new \Weixinpay;
        // 获取jssdk需要用到的数据
        $data=$wxpay->getParameters($order);
        // 将数据分配到前台页面
        $assign=array(
            'data'=>json_encode($data)
        );
        $this->assign($assign);
        $this->assign('detail',$pro_arr);
        $this->assign('price',$getData['price']); 
        $this->assign('status',$status);
        // var_dump($data);
        $this->display();
    }
    public function pay(){
        // 导入微信支付sdk
        Vendor('Weixinpay.Weixinpay');
        
        $wxpay=new \Weixinpay;
        // 获取jssdk需要用到的数据
        $data=$wxpay->getParameters();
        // 将数据分配到前台页面
        $assign=array(
            'data'=>json_encode($data)
            );
        $this->assign($assign);
        $this->display();
    }
    public function paytest(){
        $out_trade_no=time();
        // 组合url
        $url=U('Wechat/wxpay/pay',array('out_trade_no'=>$out_trade_no));
        // 前往支付
        redirect($url);
        // $this->redirect('Wechat/Wxpay/pay',array('out_trade_no'=>$out_trade_no));
    }
    
}