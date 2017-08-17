<?php
namespace Api\Controller;

class PassportController extends ComController {
    
    //生成token
    private function createToken($phone){
        $time = strtotime('now');
        $rule = 'fjnmadeit';
        $combine = $time.'&'.$phone.'&'.$rule;
        $token = base64_encode($combine);
        return $token;
    }
    
    //登陆更新token
    private function updateToken($phone){
        $User  = M('user');
        $search['phone'] = $phone;
        $newToken = $this->createToken($phone);    
        $res = $User->where($search)->setField('token',$newToken);
        if($res>0){
            return $newToken;
        }else{
            return false;
        }
    }

    //登录功能
    /*
        101:手机号为空|密码为空
        103:账号不存在
        104:密码错误
    */
    public function login(){
        //实例化数据库
        $User = M('user');
        //获取post中的字段
        $phone = I('post.phone');
        $psd = I('post.password');
        $search['phone'] = $phone;
        $data = $User->where($search)->find();
        //判断
        if($phone == ''){
            $error = 101;
            $msg = '手机号不能为空';
        }else if($psd == ''){
            $error = 101;
            $msg = '密码不能为空';
        }else if($data == null){
            $error = 103;
            $msg = '该账号不存在';
        }else if(md5($psd) != $data['password']){
            $error = 104;
            $msg = '密码错误';
        }else if(md5($psd) == $data['password']){
            $update_res = $this->updateToken($phone);
            if($update_res){
                $error = 0;
                $msg = '登录成功';
                $res['token'] = $update_res;
            }else{
                $error = 998;
                $msg = '网络繁忙,请稍后重试';
            }
        }
        //结果返回
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //注册功能
    /*
        101:手机号为空|验证码为空|密码为空
        102:手机号格式错误|手机号已存在
        103:手机号已存在
        104:验证码过期|验证码错误
    */
    public function register(){
        $User = M('user');
        $Code = M('code');

        $phone = I('post.phone');
        $psd = I('post.password');
        $code = I('post.code');
        $name = I('post.name');
        //查找某个手机号在用户表和验证码表中的数据
        $search['phone'] = $phone;
        $u_data = $User->where($search)->find();
        $c_data = $Code->where($search)->find();

        if($phone == ''){
            $error = 101;
            $msg = '手机号不能为空';
        }else if($code == ''){
            $error = 101;
            $msg = '验证码不能为空';
        }else if($psd == ''){
            $error = 101;
            $msg = '密码不能为空';
        }else if(!verifyMobile($phone)){
            $error = 102;
            $msg = '手机号格式错误';
        }else if($u_data != null){
            $error = 103;
            $msg = '该手机号已存在';
        }else if($c_data['number'] != $code || $c_data['type'] != '1' || $c_data['status'] != '1'){
            $error = 104;
            $msg = '验证码错误';
        }else if(strtotime('now')-strtotime($c_data['create_time']) > 1800){
            $error = 104;
            $msg = '验证码已过期，请重新获取';
        }else{
            $insert['phone'] = $phone;
            $insert['password'] = md5($psd);
            $insert['name'] = $name;
            $token = $this->createToken($phone);
            $insert['token'] = $token;
            $add_id = $User->add($insert);
            if($add_id>0){
                $error = 0;
                $res['token'] = $token;
                $msg = '用户注册成功';
            }else{
                $error = 998;
                $msg = '系统繁忙，请稍后尝试';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //忘记密码
    /*
        101:手机号为空|验证码为空|密码为空
        102:手机号格式错误|手机号不存在
        103:手机号不存在
        104:验证码过期|验证码错误
        105:密码没有发生变化
    */
    public function forgetPassword(){
        $User = M('user');
        $Code = M('code');

        $phone = I('post.phone');
        $psd = I('post.password');
        $code = I('post.code');
        //查找某个手机号在用户表和验证码表中的数据
        $search['phone'] = $phone;
        $u_data = $User->where($search)->find();
        $c_data = $Code->where($search)->find();

        if($phone == ''){
            $error = 101;
            $msg = '手机号不能为空';
        }else if($code == ''){
            $error = 101;
            $msg = '验证码不能为空';
        }else if($psd == ''){
            $error = 101;
            $msg = '密码不能为空';
        }else if(!verifyMobile($phone)){
            $error = 102;
            $msg = '手机号格式错误';
        }else if($u_data == null){
            $error = 103;
            $msg = '该手机号未注册';
        }else if($c_data['number'] != $code || $c_data['type'] != '2' || $c_data['status'] != '1'){
            $error = 104;
            $msg = '验证码错误';
        }else if(strtotime('now')-strtotime($c_data['create_time']) > 1800){
            $error = 104;
            $msg = '验证码已过期，请重新获取';
        }else{
            $res = $User->where($search)->setField('password',md5($psd));
            if($res == 0){
                $error = 105;
                $msg = '密码没有发生变化';
            }else if($res>0){
                $error = 0;
                $msg = '密码修改成功';
            }else{
                $error = 998;
                $msg = '系统繁忙，请稍后尝试';
            }
        }
        $result = combineResult($error,$msg);
        $this->ajaxReturn($result);
    }
}





