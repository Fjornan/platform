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
    //登录功能
    public function login(){
        //实例化数据库
        $Admin = M('admin');
        //获取post中的字段
        $username = I('post.username');
        $password = I('post.password');
        $search['username'] = $username;
        $data = $Admin->where($search)->find();
        //判断
        if($username == ''){
            $error = 1;
            $msg = '账号不能为空';
        }else if($password == ''){
            $error = 1;
            $msg = '密码不能为空';
        }else if($data == null){
            $error = 1;
            $msg = '该账号不存在';
        }else if($password != $data['password']){
            $error = 1;
            $msg = '账号或密码错误';
        }else if($password == $data['password']){
            $error = 0;
            $msg = '登录成功';
            if($data['token'] == ''){
                $token = $this->tokenCreate($username,$password);
                $Admin->where($search)->setField('token',$token);
                $res = $token;
            }else{
                $res = $data['token'];
            }
            
        }
        //结果返回
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    private function tokenCreate($username,$password){
        $key = 'jfkj';
        $token = md5($username.$password.$key);
        return $token;
    }
}





