<?php
namespace Wechat\Controller;

class OrderController extends ComController {
	//航海里程
    public function index(){
        $condition['user_id'] = session('id');
        $condition['del'] = 0;
        $condition['status'] = 1;

        $db_pro = M('product');
        $db_order = M('order');
        $getData = $db_order->where($condition)->select();
        for($i=0;$i<count($getData);$i++){
            $pro_list = explode(",", $getData[$i]['product_sign']);
            $str = '';
            for($j=0;$j<count($pro_list);$j++){
                $search['sign'] = $pro_list[$j];
                $proinfo = $db_pro->where($search)->find();
                if($str == ''){
                    $str =$str.$proinfo['name'].$proinfo['sub_name'];
                }else{
                    $str =$str.','.$proinfo['name'].$proinfo['sub_name'];
                }
            }
            $getData[$i]['product'] = $str;
        }
        $this->assign('list',$getData);
        $this->display();
    }
    public function getList(){
        

    }
    public function confirm(){
    	if(session('id') == null){
            $error = 201;
        }else{
            $db_order = M('order');
            $data['user_id'] = session('id');
            $data['order_id'] = $this->createOrderID();
            $data['product_sign'] = I('post.product_sign');
            $data['service_sign'] = I('post.service_sign');
            $data['price'] = I('post.price');
            $data['note'] = I('post.note');
            $data['contact'] = I('post.contact');
            $data['amount'] = I('post.amount');
            $data['type'] = I('post.type');
            if($data['price'] <= 0){
                $data['status'] = 1;
            }
            if($data['type'] == ''){
                $data['type'] = 1;
            }
            $add_res = $db_order->add($data);
            if($add_res>0){
                $error = 0;
                $msg = '提交成功，请等待客服联系';
            }else{
                $msg = 1;
                $msg = '提交失败，请稍后再试';
            }
            $res = $add_res;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    private function createOrderID(){
    	$date = date("YmdHis");
    	$rand = rand(1000,9999);
    	return $date.$rand;
    }
}