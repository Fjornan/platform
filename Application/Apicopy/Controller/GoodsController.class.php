<?php
namespace Api\Controller;

class GoodsController extends ComController {
    //按分类获取商品
    public function goodsList(){
        $Goods = M('goods');

        $type = I('get.type');

        if($type ==''){
            $res = $Goods->order('id desc')->select();
        }else{
            $res = $Goods->where('type='.$type)->order('id desc')->select();
        }
        
        $result = combineResult(0,$msg,$res);
        $this->ajaxReturn($result);
    }
    //获取单个商品详情
    public function detail(){
        $Goods = M('goods');

        $id = I('get.id');
        $res = $Goods->where('id='.$id)->find();
        if($res == null){
            $error = 103;
            $msg = '该商品不存在';
        }else{
            $error = 0;
        }
        
        $result = combineResult($error,$msg,$res);
    	$this->ajaxReturn($result);
    }
    //后台：添加商品
    public function add(){
        $Goods = M('goods');
        $token = I('get.token');
        $add['name'] = I('post.name');
        $add['price'] = I('post.price');
        // $add['quantity'] = I('post.quantity');
        $add['type'] = I('post.type');
        $add['des'] = I('post.des');
        $upload_file = $_FILES['pic'];

        $token_res = verifyManager($token);

        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else if($add['name'] == ''){
            $error = 101;
            $msg = '商品名称不能为空';
        }else if($add['price']  == ''){
            $error = 101;
            $msg = '商品价格不能为空';
        }else if($add['type'] == ''){
            $error = 101;
            $msg = '商品类型不能为空';
        }else{
            if($upload_file != null){
                $upload_res = $this->upload($upload_file);
                if($upload_res['error'] == 0){
                    $add['pic'] = $upload_res['data']['url'];
                    $add_res = $Goods->add($add);
                }else{
                    $error = $upload_res['error'];
                    $msg = '图片上传失败';
                }
            }else{
                $add['pic'] = 'http://ols5d86pb.bkt.clouddn.com/default/nopic.jpg';
                $add_res = $Goods->add($add);
            }

            if($add_res > 0){
                $error = 0;
                $msg = '商品添加成功';
            }else {
                $error = 105;
                $msg = '商品添加失败';
            }
        }
        $res = $Goods->where('type='.$add['type'])->order('id desc')->select();

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);

    }
    private function upload($upload_file){
        $upload = new \Think\Upload(C('UPLOAD_SITEIMG_QINIU'));
        $info = $upload->uploadOne($upload_file);
        if(!$info){
            $res['error'] = 106;
            $res['data'] = $upload->getError();
        }else{
            $res['error'] = 0;
            $res['data'] = $info;
        }
        return $res;
    }
    public function uploadPic(){
        $Goods = M('goods');
        $token = I('get.token');
        $id = I('get.id');

        $upload_file = $_FILES['pic'];
        $token_res = verifyManager($token);
        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $upload_res = $this->upload($upload_file);
            if($upload_res['error'] == 0){
                $updatePic = $upload_res['data']['url'];
                $update_res = $Goods->where('id='.$id)->setField('pic',$updatePic);
                if($upload_res>0){
                    $error = 0;
                    $msg = '商品图片添加成功'; 
                    $res = $upload_res['data'];
                }else{
                    $error = 105;
                    $msg = '商品图片添加失败'; 
                }
            }else{
                $error = $upload_res['error'];
                $msg = '图片上传失败';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);


    }
    //后台：更新商品信息
    public function update(){
        $Goods = M('goods');
        $token = I('get.token');
        $update['id'] = I('get.id');
        if(I('post.name')){
            $update['name'] = I('post.name');
        }
        if(I('post.price')){
            $update['price'] = I('post.price');
        }
        if(I('post.quantity')){
            $update['quantity'] = I('post.quantity');
        }
        if(I('post.type')){
            $update['type'] = I('post.type');
        }
        if(I('post.des')){
            $update['des'] = I('post.des');
        }
        $upload_file = $_FILES['pic'];

        $token_res = verifyManager($token);

        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            if($upload_file != null){
                $upload_res = $this->upload($upload_file);
                if($upload_res['error'] == 0){
                    $update['pic'] = $upload_res['data']['url'];
                    $update_res = $Goods->save($update);
                }else{
                    $error = $upload_res['error'];
                    $msg = '图片上传失败';
                }
            }else{
                $update_res = $Goods->save($update);
            }

            if($update_res > 0){
                $error = 0;
                $msg = '商品修改成功';
            }else {
                $error = 105;
                $msg = '商品修改失败';
            }
        }
        // $res = $Goods->where('type='.$update['type'])->order('id desc')->select();

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);

    }
    //后台：删除商品
    public function  delete(){
        $Goods = M('goods');
        $token = I('get.token');
        $id = I('post.id');

        $token_res = verifyManager($token);

        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $search['type'] = $Goods->where('id='.$id)->getField('type');
            $delete_res = $Goods->delete($id);
            if($delete_res > 0){
                $error = 0;
                $msg = '商品删除成功';
                $res = $Goods->where($search)->order('id desc')->select();
            }else{
                $error = 105;
                $msg = '商品删除失败';
            }
        }

        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }

}