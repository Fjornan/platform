<?php
namespace Api\Controller;

class UserController extends ComController {
    public function getUser(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $db_user = M('user');
            $condition['is_member'] = 1; 
            // $db_user->where($condition)->select();
            $res = $db_user->where($condition)->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

}






