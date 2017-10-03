<?php
namespace Wechat\Controller;

class MemberController extends ComController {
	//我的鲸卡
    public function index(){
        $id = session('id');
        $user_info = M('user')->where('id='.$id)->find();
        session('member',$user_info['is_member']);
    	if(session('member') == 1){
    		$this->redirect('member/info');
    	}else{
    		$this->display();
    	}
        

    }
    //申领鲸卡
    public function register(){
    	$order['user_id'] =  session('id');
        $order['price'] = 0.01;
        Vendor('Weixinpay.Weixinpay');
        $wxpay=new \Weixinpay;
        // 获取jssdk需要用到的数据
        $data=$wxpay->getParameters($order);
        // 将数据分配到前台页面
        $assign=array(
            'data'=>json_encode($data)
        );
        $this->assign($assign);
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
            $msg = $session('member');
        }else{
            $db_user = M('user');
            // $db_card = M('card');
            $user_id = session('id');

            $name = I('post.name');
            $phone = I('post.phone');
            
            // $card_id = 10010000 + (int)$user_id;
            // $data['user_id'] = $user_id;
            // $data['number'] = $card_id;
            // $add_res = $db_card->add($data);
            $update['id'] = $user_id;
            // $update['is_member'] = 1;
            // $update['member_num'] = $card_id;
            $update['name'] = $name;
            $update['phone'] = $phone;
            $update_res = $db_user->save($update);
            if($update_res>0){
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