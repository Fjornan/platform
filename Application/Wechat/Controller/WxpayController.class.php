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
}