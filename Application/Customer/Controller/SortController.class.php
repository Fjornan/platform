<?php
namespace Customer\Controller;

class SortController extends ComController {
    //获取分类
    public function index(){
        $Sort = M('sort');
        $res = $Sort->select();
        $result = combineResult(0,'获取成功',$res);
        $this->ajaxReturn($result);
    }
    //后台：添加分类
    public function add(){
        $Sort = M('sort');

        $add['name'] = I('post.name');
        $token = I('post.token');
        $token_res = verifyManager($token);

        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $add_res = $Sort->add($add);
            if($add_res > 0){
                $error = 0;
                $msg = '分类添加成功';
                $res = $Sort->select();
            }else{
                $error = 105;
                $msg = '分类添加失败';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);

    }
    //后台：更新分类名
    public function update(){
        $Sort = M('sort');
        
        $update['id'] = I('get.id');
        $update['name'] = I('post.name');
        $token = I('post.token');
        $token_res = verifyManager($token);

        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else if($update['name'] == ''){
            $error = 101;
            $msg = '分类名称不能为空';
        }else{
            $update_res = $Sort->save($update);
            if($update_res > 0){
                $error = 0;
                $msg = '分类修改成功';
                $res = $Sort->select();
            }else{
                $error = 105;
                $msg = '分类修改失败';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
    //后台：删除分类
    public function delete(){
        $Sort = M('sort');

        $id = I('get.id');
        $token = I('get.token');
        $token_res = verifyManager($token);

        if($token_res['status'] == 1){
            $error = 999;
        }else if($token_res['status'] == 2){
            $error = 201;
        }else{
            $delete_res = $Sort->delete($id);
            if($delete_res > 0){
                $error = 0;
                $msg = '分类删除成功';
                $res = $Sort->select();
            }else{
                $error = 105;
                $msg = '分类删除失败';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);
    }
}