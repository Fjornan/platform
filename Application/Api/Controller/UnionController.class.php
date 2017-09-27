<?php
namespace Api\Controller;

class UnionController extends ComController {
    public function getSeekGoods(){
        $db_seek = M('seekgoods');
        //结果返回
        $page = I('post.page');
        $offset = I('post.offset');
        $db_seek->select();
        $result = return_json($error,$msg,$res);
        $this->ajaxReturn($result);
    }
}





