<?php
namespace Wechat\Controller;

class MemberController extends ComController {
	//我的鲸卡
    public function index(){
    	if(session('member') == 1){
    		$this->redirect('member/info');
    	}else{
    		$this->display();
    	}
        

    }
    //申领鲸卡
    public function register(){
    	
    	$this->display();
    }
    public function info(){
    	$condition['id'] = session('id');
    	$data = M('user')->where($condition)->find();
    	$this->assign('user',$data);
    	$this->display();
    }
    public function pay(){
    	if(session('id') == null){
            $error = 201;
        }else if(session('member') != 0){
            $error = 1;
            $msg = '已经是会员，无需再开通鲸航Vip卡';
        }else{
            $db_user = M('user');
            $db_card = M('card');
            $user_id = session('id');

            $name = I('post.name');
            $phone = I('post.phone');
            
            $card_id = 10010000 + (int)$user_id;
            $data['user_id'] = $user_id;
            $data['number'] = $card_id;
            $add_res = $db_card->add($data);
            $update['id'] = $user_id;
            $update['is_member'] = 1;
            $update['mameber_num'] = $card_id;
            $update['name'] = $name;
            $update['phone'] = $phone;
            $update_res = $db_user->save($update);
            if($add_res>0 && $update_res>0){
                $error = 0;
                $msg = '申请成功';
                session('member',1);
            }else{
                $msg = 1;
                $msg = '提交失败，请稍后再试';
            }
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function updateInfo(){
        if(session('id') == null){
            $error = 201;
        }else{
            $db = M('user');
            $data['id'] = session('id');
            $data['company'] = I('post.company');
            $data['name'] = I('post.name');
            $data['phone'] = I('post.phone');
            $data['product'] = I('post.product');
            $data['email'] = I('post.email');
            $update_res = $db->save($data);
            if($update_res == 0){
            	$error = 0;
                $msg = '信息未变动';
            }else if($update_res>0){
                $error = 0;
                $msg = '信息修改成功';
            }else{
                $msg = 1;
                $msg = '提交失败，请稍后再试';
            }
            $res = $update_res;
        }

        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
}