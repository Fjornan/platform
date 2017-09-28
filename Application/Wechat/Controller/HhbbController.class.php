<?php
namespace Wechat\Controller;

class HhbbController extends ComController {
	//主页
    public function index(){
    	// $name = 'hello';
    	// $this->assign('name',$name);
        $this->display();
    }
    //公司注册
    public function gszc(){
        $db_pro = M('product');
        $condition['service_sign'] = 'gszc';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
        $this->display();
    }
    //知识产权
    public function zscq(){
        $db_pro = M('product');
        $condition['service_sign'] = 'zscq';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }

    public function submitPatent(){
        if(session('id') == null){
            $error = 201;
        }else if(session('member') == 0){
            $error = 202;
        }else{
            $db = M('patent');
            $data['user_id'] = session('id');
            $data['note'] = I('post.note');
            $add_res = $db->add($data);
            if($add_res>0){
                $error = 0;
                $msg = '提交成功，请等待客服联系';
            }else{
                $msg = 1;
                $msg = '提交失败，请稍后再试';
            }
            $res = $add_res;
        }

        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //VAT
    public function vat(){
        $db_pro = M('product');
        $condition['service_sign'] = 'vat';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //跨境收款
    public function kjsk(){
        $db_pro = M('product');
        $condition['service_sign'] = 'kjsk';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //UPC
    public function upc(){
        $db_pro = M('product');
        $condition['service_sign'] = 'upc';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //跨境翻译
    public function kjfy(){
        $db_pro = M('product');
        $condition['service_sign'] = 'kjfy';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //图片拍摄
    public function tpps(){
        $db_pro = M('product');
        $condition['service_sign'] = 'tpps';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //运营工具
    public function yygj(){
        $db_pro = M('product');
        $condition['service_sign'] = 'yygj';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //海外评测
    public function hwpc(){
        $db_pro = M('product');
        $condition['service_sign'] = 'hwpc';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //VPS
    public function vps(){
        $db_pro = M('product');
        $condition['service_sign'] = 'vps';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //品牌建站
    public function ppjz(){
        $db_pro = M('product');
        $condition['service_sign'] = 'ppjz';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
    	$this->display();
    }
    //运营支持
    public function yyzc(){
        $db_pro = M('product');
        $condition['service_sign'] = 'yyzc';
        $condition['use'] = '0';
        $condition['_logic'] = 'AND';
        $data = $db_pro->where($condition)->select();
        $this->assign('product',$data);
        $this->display();
    }

}