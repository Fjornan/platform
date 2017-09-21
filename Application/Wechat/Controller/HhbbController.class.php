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

}