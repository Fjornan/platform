<?php
namespace Api\Controller;

class UserController extends ComController {
    //用户类型
    const USER_TYPE_MANAGER = 1;//管理员
    const USER_TYPE_REGULAR = 2;//普通用户
    //验证码状态
    const USER_STATUS_NORMAL = 0;//验证码成功
    const USER_STATUS_FROZEN = 1;//验证码失败

    //返回所有用户信息
    public function index(){
        $User = M('user');

        $token = I('get.token');
        $token_res = verifyToken($token);
        $search['phone'] = $token_res['phone'];
        if(!$token_res['status']){
            $error = 999;
        }else if($User->where($search)->getField('type')!=self::USER_TYPE_MANAGER){
            $error = 201;
        }else{
            $error = 0;
            $data = $User->where('del = 0')->field('id,phone,name,type,status,balance,point,create_time')->select();
        }
        
        $result = combineResult($error,$msg,$data);
        $this->ajaxReturn($result);
    }
    //返回单个用户信息
    public function detail(){
        $User = M('user');
        
        //验证token
        $token = I('get.token');
        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if(I('get.id') == ''){
            $search['phone'] = $token_res['phone'];
            $error = 0;
        }else{
            $search['id'] = I('get.id');
            $error = 0;
        }
        $res = $User->where($search)->field('id,phone,name,type,status,balance,point,create_time')->find();
        

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //修改用户密码
    public function changePassword(){
        $User = M('user');

        $token = I('get.token');
        $old = I('post.old_password');
        $new = I('post.new_password');

        $token_res = verifyToken($token);
        $search['phone'] = $token_res['phone'];
        $psd = $User->where($search)->getField('password');

        if(!$token_res['status']){
            $error = 999;
        }else if($old == ''){
            $error = 101;
            $msg = '旧密码不能为空';
        }else if($new == ''){
            $error = 101;
            $msg = '新密码不能为空';
        }else if(md5($old) != $psd){
            $error = 104;
            $msg = '旧密码输入错误';
        }else{
            $res = $User->where($search)->setField('password',md5($new));
            if($res == 0){
                $error = 105;
                $msg = '密码修改失败';
            }else if($res > 0){
                $error = 0;
                $msg = '密码修改成功';
            }else{
                $error = 998;
                $msg = '系统繁忙，请稍后尝试';
            }
        }

        $result = combineResult($error,$msg,null);
        $this->ajaxReturn($result);
    }
    //用户端：修改用户昵称
    public function updateName(){
        $User = M('user');

        $token = I('post.token');
        $name = I('post.name');

        $token_res = verifyToken($token);
        $search['phone'] = $token_res['phone'];

        if(!$token_res['status']){
            $error = 999;
        }else if($name == ''){
            $error = 101;
            $msg = '用户名称不能为空';
        }else{
            $res = $User->where($search)->setField('name',$name);
            if($res == 0){
                $error = 105;
                $msg = '用户名修改失败';
            }else if($res > 0){
                $error = 0;
                $msg = '用户名修改成功';
            }else{
                $error = 998;
                $msg = '系统繁忙，请稍后尝试';
            }
        }

        $result = combineResult($error,$msg,null);
        $this->ajaxReturn($result);
    }
    //后台：修改用户信息
    public function adminUpdate(){
        $User = M('user');

        $token = I('get.token');
        if(I('post.name')){
            $update['name'] = I('post.name');
        }
        if(I('post.balance')){
            $update['balance'] = I('post.balance');
        }
        if(I('post.point')){
            $update['point'] = I('post.point');
        }
        if(I('post.type')){
            $update['type'] = I('post.type');
        }
        if(I('post.status')){
            $update['status'] = I('post.status');
        }

        $token_res = verifyToken($token);
        $search['phone'] = $token_res['phone'];
        $data = $User->where($search)->find();
        $update['id'] = I('get.id');

        if(!$token_res['status']){
            $error = 999;
        }else if($data['type'] != self::USER_TYPE_MANAGER){
            $error = 201;
        }else if($update['type'] != self::USER_TYPE_MANAGER && $update['type'] != self::USER_TYPE_REGULAR){
            $error = 102;
            $msg = '无法将用户更改为此类型';
        }else if($update['status'] != self::USER_STATUS_NORMAL && $data['status'] != self::USER_STATUS_FROZEN ){
            $error = 102;
            $msg = '无法将用户更改为此状态';
        }else{
            $update_res = $User->save($update);
            if($update_res == 0){
                $error = 105;
                $msg = '修改失败';
            }else if($update_res > 0){
                $error = 0;
                $msg = '修改成功';
                $res = $User->where('id='.$update['id'])->field('id,phone,name,type,status,balance,point,create_time')->find();
            }else{
                $error = 998;
                $msg = '系统繁忙，请稍后尝试';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //后台：删除用户
    public function delete(){
        $User = M('user');

        $id = I('post.id');
        $token = I('get.token');

        $token_res = verifyToken($token);
        $search['phone'] = $token_res['phone'];
        $type = $User->where($search)->getField('type');
        if(!$token_res['status']){
            $error = 999;
        }else if($type != self::USER_TYPE_MANAGER){
            $error = 201;
        }else{
            $res = $User->delete($id);
            if($res == 0){
                $error = 105;
                $msg = '删除失败';
            }else if($res > 0){
                $error = 0;
                $msg = '删除成功';
                $res = $User->field('id,phone,name,type,status,balance,point,create_time')->select();
            }else{
                $error = 998;
                $msg = '系统繁忙，请稍后尝试';
            }
        }
        
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }

}






