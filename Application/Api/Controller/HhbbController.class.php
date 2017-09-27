<?php
namespace Api\Controller;

class HhbbController extends ComController {
    public function getOrder(){

    }
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

}






