<?php
namespace Wechat\Controller;

class SchoolController extends ComController {
	//跨境学院
    public function index(){
        $this->display();
    }
    public function amazon(){
    	$this->display();
    }
    public function amazonVideo(){
        $this->display();
    }
    public function lazada(){
    	$this->display();
    }
    public function shopee(){
    	$this->display();
    }
    public function more(){
        $this->display();
    }
    public function amazonnew(){
        $this->display();
    }
    public function submitAmazonqa(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_has = M('amazon_qa');
            $data['user_id'] = session('id');
            $data['question'] = I('post.question');
           
            $add_res = $db_has->add($data);
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
    public function applyAmazonnew(){
        if(session('id') == null){
            $error = 201;
        }else{
            $db = M('amazon_new');
            $data['user_id'] = session('id');
            $data['phone'] = I('post.phone');
            $data['type'] = I('post.type');
            if($data['type'] == ''){
                $data['type'] =1;
            }
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