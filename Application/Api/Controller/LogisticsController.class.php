<?php
namespace Api\Controller;

class LogisticsController extends ComController {

    //
    public function getLogistics(){
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
            $db = M('logistics');
            $res = $db->where($condition)->order('id desc')->limit($offset,$page)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function finishLogistics(){
        if(!isAdmin()){
            $error = 101;
        }else{
        	$id = I('post.id');
            $db = M('logistics');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function getWarehouse(){
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
            $db = M('warehouse');
            $res = $db->where($condition)->order('id desc')->limit($offset,$page)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function finishWarehouse(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $id = I('post.id');
            $db = M('warehouse');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
}





