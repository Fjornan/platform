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

    public function export_user(){
        $db_user = M('user');
        $condition['is_member'] = 1; 
        $data = $db_user->where($condition)->field('name,member_num,phone,email,company,product,create_time')->select();
        $head = ['姓名','卡号','手机号','邮箱','公司','主营产品','注册时间'];
        array_unshift($data, $head);
        create_xls($data,'vip.xls');
    }

    

}






