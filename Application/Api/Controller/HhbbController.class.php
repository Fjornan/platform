<?php
namespace Api\Controller;

class HhbbController extends ComController {
    public function getProduct(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $db_user = M('product');
            $sign = I('post.type');
            if($sign == ''){
                $condition['service_sign'] = 'gszc';
            }else{
                $condition['service_sign'] = $sign;
            }
            $condition['use'] = '0';
            $condition['_logic'] = 'AND';
            // $db_user->where($condition)->select();
            $res = $db_user->where($condition)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function getProductDetail(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $db_user = M('product');
            $condition['id'] = I('post.id');
            $res = $db_user->where($condition)->find();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function productSave(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $db_user = M('product');
            $data['id'] = I('post.id');
            $data['name'] = I('post.name');
            $data['sub_name'] = I('post.sub_name');
            $data['price'] = I('post.price');
            $data['unit'] = I('post.unit');
            $res = $db_user->save($data);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    //专利申请
    public function getPatent(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $page = I('post.page');
            $offset = I('post.offset');
            $status = I('post.status');
            if($offset == null || $offset == ''){
                $offset = 0;
            }
            
            if($status == null || $status == '' || $status == '-1'){
                
            }else{
                $condition['status'] = $status;
            }
            $db_patent = M('patent');
            // $db_user = M('user');
            $getData = $db_patent->where($condition)->order('id desc')->limit($offset,$page)->select();
            for($i=0;$i<count($getData);$i++){
                // $search['id'] = $getData[$i]['user_id'];
                $userinfo = getUserInfo($getData[$i]['user_id']);
                $getData[$i]['name'] = $userinfo['name'];
                $getData[$i]['phone'] = $userinfo['phone'];
            }
            $res = $getData;
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //专利申请
    public function finishPatent(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $id = I('post.id');
            $db = M('patent');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    //获取订单
    public function getOrder(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $page = I('post.page');
            $offset = I('post.offset');
            $status = I('post.status');
            $sign = I('post.type');
            if($sign == ''){
                $condition['service_sign'] = 'gszc';
            }else{
                $condition['service_sign'] = $sign;
            }
            if($offset == null || $offset == ''){
                $offset = 0;
            }
            
            if($status == null || $status == '' || $status == '-1'){
                
            }else{
                $condition['status'] = $status;
            }
            $condition['del'] = 0;
            $db_order = M('order');
            $db_pro = M('product');
            $getData = $db_order->where($condition)->order('id desc')->limit($offset,$page)->select();
            for($i=0;$i<count($getData);$i++){
                if($getData[$i]['type'] == 2){
                    $getData[$i]['phone'] = $getData[$i]['contact'];
                }else{
                    $userinfo = getUserInfo($getData[$i]['user_id']);
                    $getData[$i]['name'] = $userinfo['name'];
                    $getData[$i]['phone'] = $userinfo['phone'];
                    $getData[$i]['email'] = $userinfo['email'];
                }
                

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
            $res = $getData;
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //专利申请
    public function finishOrder(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $id = I('post.id');
            $db = M('order');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',2);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

}






