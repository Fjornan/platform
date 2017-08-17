<?php
namespace Customer\Controller;
import('Org.sms.top.TopClient');
import('Org.sms.top.request.AlibabaAliqinFcSmsNumSendRequest');
import('Org.sms.top.ResultSet');
import('Org.sms.top.RequestCheckUtil');
import('Org.sms.top.TopLogger');


class NotifyController extends ComController {
    //验证码类型
    const CODE_TYPE_REGISTER = '1';//注册验证码
    const CODE_TYPE_FORGET = '2';//忘记密码验证码
    //验证码状态
    const CODE_STATUS_SUCCESS = '1';//验证码成功
    const CODE_STATUS_FAIL = '2';//验证码失败

    //发送阿里大鱼验证码
    private function sendCode($phone,$param){
        $c = new TopClient;
        $c ->appkey = '23644224' ;
        $c ->secretKey = 'bb98851b47e3f0de635d8ab15e530efb' ;
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req ->setExtend( "" );
        $req ->setSmsType( "normal" );
        $req ->setSmsFreeSignName( "企业订餐" );
        // $req ->setSmsParam( "{number:'123456'}" );
        // $req ->setRecNum( "15168365220" );
        $req ->setSmsParam( $param );
        $req ->setRecNum( $phone );
        $req ->setSmsTemplateCode( "SMS_48070170" );
        $resp = $c ->execute( $req );
        return $resp;
    }
    //生成六位验证码
    private function createNumber(){
        $i=0;
        while($i<6){
            $number = $number.rand(0,9);
            $i++;
        }
        return $number;
    }

    private function saveCode($phone,$number,$type,$status){
        $Mcode = M('code');

        $search['phone'] = $phone;
        $new['phone'] = $phone;
        $new['number'] = $number;
        $new['type'] = $type;
        $new['status'] = $status;

        $data = $Mcode->where($search)->find();
        if($data == null){
            //不存在该手机号，新增
            $res = $Mcode->add($new);
        }else{
            //已存在该手机号，覆盖
            $new['id'] = $data['id'];
            $res = $Mcode->save($new);
        }
        return $res;
    }
    //发送验证码
    /*
        101:手机号不能为空
        102:手机号格式错误
        103:手机号已被注册|未注册
    */
    public function register(){
        $User = M('user');
        $phone = I('get.phone');

        $search['phone'] = $phone;
        $data = $User->where($search)->find();
        if($phone == ''){
            $error = 101;
            $msg = '手机号不能为空';
        }else if(!verifyMobile($phone)){
            $error = 102;
            $msg = '手机号格式错误';
        }else if($data != null){
            $error = 103;
            $msg = '该手机号已被注册';
        }else{
            $number = $this->createNumber();
            $param['number'] = $number;
            $res = $this->sendCode($phone,json_encode($param));
            if($res->{'result'}->{'err_code'} == '0'){
                $error = 0;
                $msg = '验证码发送成功';
                $this->saveCode($phone,$number,self::CODE_TYPE_REGISTER,self::CODE_STATUS_SUCCESS);
            }else{
                $error = 998;
                $msg = '验证码发送失败，请稍后再试';
                $this->saveCode($phone,$number,self::CODE_TYPE_REGISTER,self::CODE_STATUS_FAIL);
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }

    public function forget(){
        $User = M('user');
        $phone = I('get.phone');

        $search['phone'] = $phone;
        $data = $User->where($search)->find();
        if($phone == ''){
            $error = 101;
            $msg = '手机号不能为空';
        }else if(!verifyMobile($phone)){
            $error = 102;
            $msg = '手机号格式错误';
        }else if($data == null){
            $error = 103;
            $msg = '该手机号还未注册';
        }else{
            $number = $this->createNumber();
            $param['number'] = $number;
            $res = $this->sendCode($phone,json_encode($param));
            if($res->{'result'}->{'err_code'} == '0'){
                $error = 0;
                $msg = '验证码发送成功';
                $this->saveCode($phone,$number,self::CODE_TYPE_FORGET,self::CODE_STATUS_SUCCESS);
            }else{
                $error = 998;
                $msg = '验证码发送失败，请稍后再试';
                $this->saveCode($phone,$number,self::CODE_TYPE_FORGET,self::CODE_STATUS_FAIL);
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
}