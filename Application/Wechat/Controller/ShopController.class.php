<?php
namespace Wechat\Controller;

class ShopController extends ComController {
    public function index(){
        $this->display();
    }
    public function amazonReg(){
    	$this->display();
    }
    public function apiAmazonReg(){
    	
    }
    public function submitAmazonReg(){
        if(session('id') == null){
            $error = 201;
        }else{
            $db = M('amazon_res');
            $data['user_id'] = session('id');
            $data['company'] = I('post.company');
            $data['username'] = I('post.username');
            $data['phone'] = I('post.phone');
            $data['email'] = I('post.email');
            $data['province'] = I('post.province');
            $data['product'] = I('post.product');
            $data['com_property'] = I('post.com_property');
            $data['year_sell'] = I('post.year_sell');
            $data['has_shop'] = I('post.has_shop');
            $data['purpose_site'] = I('post.purpose_site');
            $data['web_site'] = I('post.web_site');
            $data['interet'] = I('post.interet');

            $add_res = $db->add($data);
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