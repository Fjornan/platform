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
            $res = $db_user->where($condition)->order('update_time desc,create_time desc')->select();
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function export_user(){
        $db_user = M('user');
        $condition['is_member'] = 1; 
        $data = $db_user->where($condition)->field('name,member_num,member_product,phone,email,company,product,update_time')->select();
        $head = ['姓名','卡号','所购服务','手机号','邮箱','公司','主营产品','最新付费时间'];
        array_unshift($data, $head);
        create_xls($data,'vip.xls');
    }

    // public function move_date(){
    //     $db_user = M('user');
    //     $user = $db_user->select();
    //     for ($i=0; $i < count($user); $i++) { 
    //         $c_date = $user[$i]['create_time'];
    //         $db_user->where('id='.$user[$i]['id'])->setField('update_time',$c_date);
    //     }
    // }
    

}






