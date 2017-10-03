<?php
namespace Api\Controller;

class ShopController extends ComController {

    //专利申请
    public function getAmazonApply(){
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
            $db_patent = M('amazon_res');
            // $db_user = M('user');
            $getData = $db_patent->where($condition)->order('id desc')->limit($offset,$page)->select();
            
            $res = $getData;
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //专利申请
    public function finishAmazonApply(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $id = I('post.id');
            $db = M('amazon_res');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }


}






