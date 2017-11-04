<?php
namespace Api\Controller;

class UserController extends ComController {
    public function getUser(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $db_user = M('user');
            $condition['is_member'] = 1; 
            $search = '%'.I('post.search').'%';

            $where['name']  = array('like', $search);
            $where['phone']  = array('like',$search);
            $where['_logic'] = 'or';

            $condition['_complex'] = $where;

            // $db_user->where($condition)->select();
            $res = $db_user->where($condition)->order('id desc')->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function export_user(){
        $db_user = M('user');
        $condition['is_member'] = 1; 
        $data = $db_user->where($condition)->field('name,member_num,member_money,phone,email,company,product,create_time')->select();
        $head = ['姓名','卡号','加入鲸航','手机号','邮箱','公司','主营产品','注册时间'];
        array_unshift($data, $head);
        create_xls($data,'vip.xls');
    }

    

}






