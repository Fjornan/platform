<?php
namespace Api\Controller;

class SchoolController extends ComController {

    //专利申请
    public function getAmazonNewApply(){
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
            $db_patent = M('amazon_new');
            // $db_user = M('user');
            $getData = $db_patent->where($condition)->order('id desc')->limit($offset,$page)->select();
            for($i=0;$i<count($getData);$i++){
                // $search['id'] = $getData[$i]['user_id'];
                if($getData[$i]['type'] == 1){
                    $userinfo = getUserInfo($getData[$i]['user_id']);
                    $getData[$i]['name'] = $userinfo['name'];
                    $getData[$i]['phone'] = $userinfo['phone'];
                }
                
            }
            $res = $getData;
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //专利申请
    public function finishAmazonNewApply(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $id = I('post.id');
            $db = M('amazon_new');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function getAmazonQa(){
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
            $db_patent = M('amazon_qa');

            $getData = $db_patent->where($condition)->order('id desc')->limit($offset,$page)->select();
            for($i=0;$i<count($getData);$i++){
                
                $userinfo = getUserInfo($getData[$i]['user_id']);
                $getData[$i]['name'] = $userinfo['name'];
                $getData[$i]['phone'] = $userinfo['phone'];

                
            }
            $res = $getData;
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //专利申请
    public function finishAmazonQa(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $id = I('post.id');
            $db = M('amazon_qa');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }


}






