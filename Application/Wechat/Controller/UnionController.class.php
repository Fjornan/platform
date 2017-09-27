<?php
namespace Wechat\Controller;

class UnionController extends ComController {
	//鲸航联盟主页
    public function index(){
        $this->display();
    }
   	//找货源
    public function seekGoods(){
    	$this->display();
    }
    public function submitSeekGoods(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_seek = M('seekgoods');
            $data['user_id'] = session('id');
            $data['company'] = I('post.company');
            $data['username'] = I('post.username');
            $data['phone'] = I('post.phone');
            $data['product'] = I('post.product');
            $data['advantage'] = I('post.advantage');
            $add_res = $db_seek->add($data);
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
    //有货源
    public function hasGoods(){
    	$this->display();
    }
   	//自荐、求职
    public function apply(){
    	$this->display();
    }
    //求才、招聘
    public function recruit(){
    	$this->display();
    }
    //当期活动
    public function activity(){
        $this->display();
    }
    //联合运营
    public function operate(){
        $this->display();
    }
}