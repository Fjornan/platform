<?php
namespace Wechat\Controller;

class LogisticsController extends ComController {
    public function index(){
        $this->display();
    }
    public function submitLogistics(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_logistics = M('logistics');
            $data['user_id'] = session('id');
            $data['company'] = I('post.company');
            $data['username'] = I('post.username');
            $data['phone'] = I('post.phone');
            $data['product'] = I('post.product');
            $data['weight'] = I('post.weight');
            $data['address_from'] = I('post.address_from');
            $data['address_to'] = I('post.address_to');
            $add_res = $db_logistics->add($data);
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
    public function submitWare(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_ware = M('warehouse');
            $data['user_id'] = session('id');
            $data['country'] = I('post.country');
            $add_res = $db_ware->add($data);
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
}