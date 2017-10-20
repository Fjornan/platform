<?php
namespace Api\Controller;

class ShopController extends ComController {

    //亚马逊申请
    public function getAmazonApply(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $page = I('post.page');
            $offset = I('post.offset');
            $status = I('post.status');
            if($offset == null || $offset == ''){
                $offset = 0;
            }
            
            if($status == null || $status == '' || $status == '-1'){
                
            }else{
                $condition['status'] = $status;
            }
            $db_patent = M('amazon_res');
            // $db_user = M('user');
            $getData = $db_patent->where($condition)->order('id desc')->limit($offset,$page)->select();
            
            $res = $getData;
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    public function exportAmazonRes(){
        $db_patent = M('amazon_res');
        if(I('get.status') == -1){

        }else{
            $condition['status'] = I('get.status');
        }
        $data = $db_patent->where($condition)->field('company,username,phone,email,province,product,com_property,year_sell,has_shop,purpose_site,web_site,interet,create_time')->order('id desc')->select();
        $hasShopType = ['已开店','未开店'];
        for($i=0;$i<count($hasShopType);$i++){
            $data[$i]['has_shop'] = $hasShopType[$data[$i]['has_shop']];
        }
        $head = ['公司名称','联系人','联系电话','邮箱','公司省份','主营产品','公司性质','年销售额','是否开店','意向站点','公司网址','感兴趣项','提交时间'];
        array_unshift($data, $head);
        create_xls($data,'amazon.xls');
    }
    public function getAmazonApplyDetail(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $condition['id'] = I('post.id');
            $db_patent = M('amazon_res');
            // $db_user = M('user');
            $getData = $db_patent->where($condition)->find();
            
            $res = $getData;
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //完成亚马逊申请
    public function finishAmazonApply(){
        if(!isAdmin()){
            $error = 101;
        }else{
            $id = I('post.id');
            $db = M('amazon_res');
            $condition['id'] = $id;
            $res = $db->where($condition)->setField('status',1);
            $error = 0;
        }
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }




}






