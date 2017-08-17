<?php
namespace Api\Controller;

class OrderController extends ComController {
    //订单类型
    const ORDER_TYPE_NORMAL = '1';
    const ORDER_TYPE_TEAM = '2';
    //订单状态
    const ORDER_STATUS_CANCEL = '-1';
    const ORDER_STATUS_PAY = '0';
    const ORDER_STATUS_CONFIRM = '1';
    const ORDER_STATUS_RECEIPT = '2';
    const ORDER_STATUS_FINISH = '3';


    public function index(){
        $token_res = verifyManager($token);
        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{

        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //某个订单详情
    private function detail($id){
        $Order_Goods = M('order_goods');
        $Goods = M('goods');
        $data = $Order_Goods->where('order_id='.$id)->select();
        for($i=0;$i<count($data);$i++){
            $info = $Goods->where('id='.$data[$i]['goods_id'])->find();
            $data[$i]['info'] = $info;
        }
        return $data;
    }

    //获取普通用户订单
    public function orderlist(){
        $Order = M('order');
        $User = M('user');
        $token = I('get.token');
        $status = I('get.status');

        $token_res = verifyManager($token);
        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $error = 0;
            $msg = '订单获取成功';
            $data = $Order->where('type=1 AND status='.$status)->order('id desc')->select();
            for($i=0;$i<count($data);$i++){
                $data[$i]['userinfo'] = $User->where('id='.$data[$i]['user_id'])->field('phone,name')->find();
            }

        }
        $res = $data;

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //获取普通用户订单详情
    public function orderDetail(){
        $Order_Goods = M('order_goods');
        $Goods = M('goods');
        $id = I('get.id');
        $token = I('get.token');

        $token_res = verifyManager($token);
        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $error = 0;
            $msg = '详情获取成功';
            $data = $Order_Goods->where('order_id='.$id)->select();
            for($i=0;$i<count($data);$i++){
                $data[$i]['goodsinfo'] = $Goods->where('id='.$data[$i]['goods_id'])->find();
            }

            $res = $data;
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //确认制作普通用户订单
    public function orderConfirm(){
        $Order = M('order');
        $token = I('get.token');
        $id = I('post.id');

        $token_res = verifyManager($token);
        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $update_res = $Order->where('id='.$id)->setField('status',2);
            if($update_res>0){
                $error = 0;
                $msg = '确认订单成功';
            }else{
                $error = 105;
                $msg = '确认订单失败';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 

    }
    //获取团队订单列表
    public function teamorderlist(){
        $Teamorder = M('teamorder');
        $Team = M('team');
        $User = M('user');
        $token = I('get.token');
        $status = I('get.status');

        $token_res = verifyManager($token);
        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $error = 0;
            $msg = '订单获取成功';
            $data = $Teamorder->where('status='.$status)->order('id desc')->select();
            for($i=0;$i<count($data);$i++){
                $team_data = $Team->where('id='.$data[$i]['team_id'])->find();
                $leader_id = $team_data['leader_id'];

                $data[$i]['teaminfo'] = $team_data;
                $data[$i]['userinfo'] = $User->where('id='.$leader_id)->field('name,phone')->find();
            }

        }
        $res = $data;

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //获取团队订单详情
    public function teamorderDetail(){
        $Order = M('order');
        $Teamorder = M('teamorder');
        $token = I('get.token');
        
        $id = I('get.id');

        $token_res = verifyManager($token);
        $token_res = verifyManager($token);
        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $error = 0;
            $msg = '订单详情获取成功';
            $res = $Teamorder->where('id='.$id)->find();
            $order = $Order->where('teamorder_id='.$id)->select();
            $arr = array();
            for($i=0;$i<count($order);$i++){
                $detail = $this->detail($order[$i]['id']);
                for($j=0;$j<count($detail);$j++){
                    $arr[] = $detail[$j];
                }
            }
            //优化arr
            $goodslist = array();
            for($i=0;$i<count($arr);$i++){
                $flag = 0;
                for($j=0;$j<count($goodslist);$j++){
                    if($arr[$i]['info']['id'] == $goodslist[$j]['info']['id']){
                        $goodslist[$j]['amount']+=$arr[$i]['amount'];
                        $goodslist[$j]['price']+=$arr[$i]['price'];
                        $flag = 1;
                    }
                }
                if($flag == 0){
                    $goodslist[] = $arr[$i];
                }
            }
            $res['goodslist'] = $goodslist;
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //确认制作团队订单
    public function teamorderConfirm(){
        $Teamorder = M('teamorder');
        $token = I('get.token');
        $id = I('post.id');

        $token_res = verifyManager($token);
        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $update_res = $Teamorder->where('id='.$id)->setField('status',2);
            if($update_res>0){
                $error = 0;
                $msg = '确认订单成功';
            }else{
                $error = 105;
                $msg = '确认订单失败';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }
}













