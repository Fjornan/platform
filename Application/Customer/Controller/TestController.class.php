<?php
namespace Customer\Controller;

class TestController extends ComController {
    public function index(){

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else{
            
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    public function upload(){
        $upload = new \Think\Upload(C('UPLOAD_SITEIMG_QINIU'));
        $info = $upload->uploadOne($_FILES['file']);
        if(!$info){
            $data = $upload->getError();
            $this->ajaxReturn($data);
        }else{
            // return $info;
            $this->ajaxReturn($info);
        }
    }
}