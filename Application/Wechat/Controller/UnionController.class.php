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
    public function submitHasGoods(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_has = M('hasgoods');
            $data['user_id'] = session('id');
            $data['company'] = I('post.company');
            $data['username'] = I('post.username');
            $data['phone'] = I('post.phone');
            $data['product'] = I('post.product');
            $data['address'] = I('post.address');
            $data['advantage'] = I('post.advantage');
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
   	//自荐、求职
    public function apply(){
    	$this->display();
    }
    public function submitApply(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_apply = M('apply');
            $data['user_id'] = session('id');
            $data['name'] = I('post.name');
            $data['phone'] = I('post.phone');
            $data['job'] = I('post.job');
            $data['introduce'] = I('post.introduce');
            $add_res = $db_apply->add($data);
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
    //求才、招聘
    public function recruit(){
    	$this->display();
    }
    public function submitRecruit(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_recruit = M('recruit');
            $data['user_id'] = session('id');
            $data['company'] = I('post.company');
            $data['username'] = I('post.username');
            $data['phone'] = I('post.phone');
            $data['job'] = I('post.job');
            $data['introduce'] = I('post.introduce');
            $add_res = $db_recruit->add($data);
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
    //当期活动
    public function activity(){
        $this->display();
    }
    public function submitActivity(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_activity = M('activity_join');
            $data['user_id'] = session('id');
            $data['name'] = I('post.name');
            $data['phone'] = I('post.phone');
            $data['join_people'] = I('post.join_people');
            $add_res = $db_activity->add($data);
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
    //联合运营
    public function operate(){
        $this->display();
    }
    public function submitOperate(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db_operate = M('operate');
            $data['user_id'] = session('id');
            $data['company'] = I('post.company');
            $data['username'] = I('post.username');
            $data['phone'] = I('post.phone');
            $data['product'] = I('post.product');
            $data['introduce'] = I('post.introduce');
            $add_res = $db_operate->add($data);
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



