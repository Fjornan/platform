<?php
namespace Api\Controller;

class UnionController extends ComController {
	//我要找货源
    public function getSeekGoods(){
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
            $db_seek = M('seekgoods');
            $res = $db_seek->where($condition)->order('id desc')->limit($offset,$page)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function finishSeekGoods(){
        if(!isAdmin()){
            $error = 101;
        }else{
        	$id = I('post.id');
            $db_seek = M('seekgoods');
            $condition['id'] = $id;
            $res = $db_seek->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //我有好货源
    public function getHasGoods(){
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
            $db = M('hasgoods');
            $res = $db->where($condition)->order('id desc')->limit($offset,$page)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function finishHasGoods(){
        if(!isAdmin()){
            $error = 101;
        }else{
        	$id = I('post.id');
            $db = M('hasgoods');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    //自荐
    public function getApply(){
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
            $db = M('apply');
            $res = $db->where($condition)->order('id desc')->limit($offset,$page)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function finishApply(){
        if(!isAdmin()){
            $error = 101;
        }else{
        	$id = I('post.id');
            $db = M('apply');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    //求才
    public function getRecruit(){
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
            $db = M('recruit');
            $res = $db->where($condition)->order('id desc')->limit($offset,$page)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function finishRecruit(){
        if(!isAdmin()){
            $error = 101;
        }else{
        	$id = I('post.id');
            $db = M('recruit');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    //活动报名
    public function getActivity(){
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
            $db = M('activity_join');
            $res = $db->where($condition)->order('id desc')->limit($offset,$page)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function finishActivity(){
        if(!isAdmin()){
            $error = 101;
        }else{
        	$id = I('post.id');
            $db = M('activity_join');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    //联合运营
    public function getOperate(){
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
            $db = M('operate');
            $res = $db->where($condition)->order('id desc')->limit($offset,$page)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function finishOperate(){
        if(!isAdmin()){
            $error = 101;
        }else{
        	$id = I('post.id');
            $db = M('operate');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
}





