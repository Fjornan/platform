<?php
namespace Customer\Controller;

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
        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
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
    //订单与商品关联
    private function orderlink($order_id,$user_id){
        $Cart = M('shoppingcart');
        $Goods = M('goods');
        $Order_Goods = M('order_goods');

        //获取该用户在购物车中的商品
        $cart_goods = $Cart->where('user_id='.$user_id)->select();
        //数据插入order_goods关系表
        $total_amount = 0;
        $total_price = 0;
        for($i=0;$i<count($cart_goods);$i++){
            $add_link['order_id'] = $order_id;
            $add_link['goods_id'] = $cart_goods[$i]['goods_id'];
            $c_amount = $cart_goods[$i]['amount'];
            $add_link['amount'] = $c_amount;
            $total_amount = $total_amount+$c_amount;
            $goods_info = $Goods->where('id='.$cart_goods[$i]['goods_id'])->find();
            $add_link['price'] = $goods_info['price'];
            $total_price = $total_price+$goods_info['price']*$c_amount;
            $Order_Goods->add($add_link);
            $Cart->where('id='.$cart_goods[$i]['id'])->delete();

        }

        $result['amount'] = $total_amount;
        $result['price'] = $total_price;
        return $result;

    }
    //生成普通订单
    public function create(){
        $Order = M('order');
        $token = I('post.token');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else{
            $add_order['user_id'] = $token_res['id'];
            $add_order['type'] = 1;
            $add_order['amount'] = 0;
            $add_order['price'] = 0;
            $order_id = $Order->add($add_order);
            if($order_id>0){
                $link_res = $this->orderlink($order_id,$token_res['id']);
                $update['amount'] = $link_res['amount'];
                $update['price']=$link_res['price'];
                $update_res = $Order->where('id='.$order_id)->save($update);
                if($update_res > 0){
                    $error = 0;
                    $msg = '订单添加成功';
                }else{
                    $error = 105;
                    $msg = '订单关系添加失败';
                }
            }else{
                $error = 105;
                $msg = '订单添加失败';
            }

            
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }
    //获取用户普通订单
    public function getOrder(){
        $Order = M('order');
        $Order_goods = M('order_goods');
        $token = I('get.token');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else{
            $search['type'] = 1;
            $search['user_id'] = $token_res['id'];
            $data = $Order->where($search)->order('id desc')->select();
            
            $error = 0;
            $msg = '个人订单获取成功';
            $res = $data;
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //获取个人订单详情
    public function orderDetail(){
        $token = I('get.token');
        $id = I('get.id');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else{
            $error = 0;
            $msg = '订单详情获取成功';
            $res = $this->detail($id);
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //取消个人订单
    public function cancelOrder(){
        $Order = M('order');
        $token = I('post.token');
        $id = I('post.id');
        $type = I('post.type');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
            $error = 101;
            $msg ='订单号不能为空';
        }else if($type == 1){
            $order_data = $Order->where('id='.$id)->find();
            if($order_data['user_id'] != $token_res['id']){
                $error = 201;
                $msg = '没有操作权限';
            }else if($order_data['status'] != 0){
                $error = 201;
                $msg = '订单无法取消';
            }else{
                $Order->where('id='.$id)->setField('status',-1);
                $error = 0;
                $msg = '订单已取消';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }
    //个人订单付款
    public function payOrder(){
        $Order = M('order');
        $User = M('user');
        $token = I('post.token');
        $id = I('post.id');
        $type = I('post.type');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
            $error = 101;
            $msg ='订单号不能为空';
        }else if($type == 1){
            $order_data = $Order->where('id='.$id)->find();
            if($order_data['user_id'] != $token_res['id']){
                $error = 201;
                $msg = '没有操作权限';
            }else if($order_data['status']!=0){
                $error = 201;
                $msg = '订单无法支付';
            }else{
                $user_data = $User->where('id='.$token_res['id'])->find();
                if($order_data['price']>$user_data['balance']){
                    $error = 201;
                    $msg = '账户余额不足';
                }else{
                    $balance = $user_data['balance']-$order_data['price'];
                    $User->where('id='.$token_res['id'])->setField('balance',$balance);
                    $Order->where('id='.$id)->setField('status',1);
                    $error = 0;
                    $msg = '订单支付成功';
                }
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }
    //确认完成个人订单
    public function finishOrder(){
        $Order = M('order');
        $token = I('post.token');
        $id = I('post.id');
        $type = I('post.type');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
            $error = 101;
            $msg ='订单号不能为空';
        }else if($type == 1){
            $order_data = $Order->where('id='.$id)->find();
            if($order_data['user_id'] != $token_res['id']){
                $error = 201;
                $msg = '没有操作权限';
            }else if($order_data['status'] != 2){
                $error = 201;
                $msg = '订单无法确认完成';
            }else{
                $Order->where('id='.$id)->setField('status',3);
                $error = 0;
                $msg = '订单已确认完成';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }
    //生成团队订单
    public function createTeamorder(){
        $Team = M('team');
        $Order = M('order');
        $Teamorder = M('teamorder');

        $token = I('post.token');
        $team_id = I('post.team_id');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($team_id ==''){
            $error = 101;
            $msg ='请选择团队';
        }else{
            //添加个人order
            $add_order['user_id'] = $token_res['id'];
            $add_order['type'] = 2;
            $add_order['amount'] = 0;
            $add_order['price'] = 0;
            $order_id = $Order->add($add_order);
            if($order_id>0){
                //添加订单与商品的关系
                $link_res = $this->orderlink($order_id,$token_res['id']);
                $update['amount'] = $link_res['amount'];
                $update['price']=$link_res['price'];
                $update_res = $Order->where('id='.$order_id)->save($update);
                if($update_res > 0){
                    //添加到团队订单
                    $search['team_id'] = $team_id;
                    $search['status'] = 0;
                    $teamorder = $Teamorder->where($search)->find();
                    if($teamorder){
                        //团队订单已存在，则订单直接加入该团队订单
                        $update_torder['amount'] = $teamorder['amount']+$link_res['amount'];
                        $update_torder['price'] = $teamorder['price']+$link_res['price'];
                        $update_torder['id'] = $teamorder['id'];
                        $update_torder_res = $Teamorder->save($update_torder);
                        if($update_torder_res>0){
                            $Order->where('id='.$order_id)->setField('teamorder_id',$teamorder['id']);
                            $error = 0;
                            $msg = '团队订单加入成功';
                        }else{
                            $error = 105;
                            $msg = '团队订单加入失败';
                        }
                    }else{
                        //团队订单不存在，则先生成团队订单
                        $add_torder['team_id'] = $team_id;
                        $add_torder['amount'] = $link_res['amount'];
                        $add_torder['price'] = $link_res['price'];
                        $teamorder_id = $Teamorder->add($add_torder);
                        if($teamorder_id>0){
                            $Order->where('id='.$order_id)->setField('teamorder_id',$teamorder_id);
                            $error = 0;
                            $msg = '团队订单创建成功';
                        }else{
                            $error = 105;
                            $msg = '团队订单创建失败';
                        }
                    }
                }else{
                    $error = 105;
                    $msg = '订单关系添加失败';
                }
            }else{
                $error = 105;
                $msg = '订单添加失败';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }
    //获取团队订单列表
    public function getTeamorder(){
        $Teamorder = M('teamorder');
        $Team = M('team');
        $token = I('get.token');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else{
            $team_data = $Team->where('leader_id='.$token_res['id'])->select();
            $arr=array(); 
            for($i=0;$i<count($team_data);$i++){
                $arr[] = $team_data[$i]['id'];
            }
            $search['team_id'] = array('in',$arr);

            $data = $Teamorder->where($search)->order('id desc')->select();
            for($i=0;$i<count($data);$i++){
                $data[$i]['name'] = $Team->where('id='.$data[$i]['team_id'])->getField('name');
            }

            $error = 0;
            $msg = '个人订单获取成功';
            $res = $data;
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    //获取团队订单详情
    public function teamorderDetail(){
        $Order = M('order');
        $Teamorder = M('teamorder');
        $token = I('get.token');
        $User=M('user');
        
        $id = I('get.id');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else{
            $error = 0;
            $msg = '订单详情获取成功';
            $res = $Teamorder->where('id='.$id)->find();
            $order = $Order->where('teamorder_id='.$id)->select();
            // $arr = array();
            for($i=0;$i<count($order);$i++){
                $order[$i]['username']=$User->where('id='.$order[$i]['user_id'])->getField('name');
                $detail = $this->detail($order[$i]['id']);
                $order[$i]['goods_info'] = $detail;
                
            }
            //优化arr
            
            // $res['goodslist'] = $goodslist;
            $res = $order;
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    // public function teamorderDetail(){
    //     $Order = M('order');
    //     $Teamorder = M('teamorder');
    //     $token = I('get.token');
        
    //     $id = I('get.id');

    //     $token_res = verifyToken($token);
    //     if(!$token_res['status']){
    //         $error = 999;
    //     }else{
    //         $error = 0;
    //         $msg = '订单详情获取成功';
    //         $res = $Teamorder->where('id='.$id)->find();
    //         $order = $Order->where('teamorder_id='.$id)->select();
    //         $arr = array();
    //         for($i=0;$i<count($order);$i++){
    //             $detail = $this->detail($order[$i]['id']);
    //             for($j=0;$j<count($detail);$j++){
    //                 $arr[] = $detail[$j];
    //             }
    //         }
    //         //优化arr
    //         $goodslist = array();
    //         for($i=0;$i<count($arr);$i++){
    //             $flag = 0;
    //             for($j=0;$j<count($goodslist);$j++){
    //                 if($arr[$i]['info']['id'] == $goodslist[$j]['info']['id']){
    //                     $goodslist[$j]['amount']+=$arr[$i]['amount'];
    //                     $goodslist[$j]['price']+=$arr[$i]['price'];
    //                     $flag = 1;
    //                 }
    //             }
    //             if($flag == 0){
    //                 $goodslist[] = $arr[$i];
    //             }
    //         }
    //         $res['goodslist'] = $goodslist;
    //     }

    //     $result = combineResult($error,$msg,$res);
    //     $this->ajaxReturn($result);  
    // }

    //取消团队订单
    public function cancelTeamorder(){
        $Teamorder = M('teamorder');
        $Team = M('team');
        $token = I('post.token');
        $id = I('post.id');
        $type = I('post.type');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
            $error = 101;
            $msg ='订单号不能为空';
        }else if($type != 2){
            $error = 103;
            $msg = '订单类型错误';
        }else{
            $order_data = $Teamorder->where('id='.$id)->find();
            $team_data = $Team->where('id='.$order_data['team_id'])->find();
            if($team_data['leader_id'] != $token_res['id']){
                $error = 201;
                $msg = '没有操作权限';
            }else if($order_data['status'] != 0){
                $error = 201;
                $msg = '订单无法取消';
            }else{
                $Teamorder->where('id='.$id)->setField('status',-1);
                $error = 0;
                $msg = '订单已取消';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }
    //支付团队订单
    public function payTeamorder(){
        $Teamorder = M('teamorder');
        $Team = M('team');
        $User = M('user');
        $token = I('post.token');
        $id = I('post.id');
        $type = I('post.type');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
            $error = 101;
            $msg ='订单号不能为空';
        }else if($type != 2){
            $error = 103;
            $msg = '订单类型错误';
        }else{
            $order_data = $Teamorder->where('id='.$id)->find();
            $team_data = $Team->where('id='.$order_data['team_id'])->find();
            if($team_data['leader_id'] != $token_res['id']){
                $error = 201;
                $msg = '没有操作权限';
            }else if($order_data['status'] != 0){
                $error = 201;
                $msg = '团队订单无法支付';
            }else{
                $user_data = $User->where('id='.$token_res['id'])->find();
                if($order_data['price']>$user_data['balance']){
                    $error = 201;
                    $msg = '账户余额不足';
                }else{
                    $balance = $user_data['balance']-$order_data['price'];
                    $User->where('id='.$token_res['id'])->setField('balance',$balance);
                    $Teamorder->where('id='.$id)->setField('status',1);
                    $error = 0;
                    $msg = '团队订单支付成功';
                }
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }
    //完成团队订单
    public function finishTeamorder(){
        $Teamorder = M('teamorder');
        $Team = M('team');
        $token = I('post.token');
        $id = I('post.id');
        $type = I('post.type');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
            $error = 101;
            $msg ='订单号不能为空';
        }else if($type != 2){
            $error = 103;
            $msg = '订单类型错误';
        }else{
            $order_data = $Teamorder->where('id='.$id)->find();
            $team_data = $Team->where('id='.$order_data['team_id'])->find();
            if($team_data['leader_id'] != $token_res['id']){
                $error = 201;
                $msg = '没有操作权限';
            }else if($order_data['status'] != 2){
                $error = 201;
                $msg = '团队订单无法确认完成';
            }else{
                $Teamorder->where('id='.$id)->setField('status',3);
                $error = 0;
                $msg = '团队订单已确认完成';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result); 
    }


}




