<?php
namespace Customer\Controller;

class FavorController extends ComController {
	public function index(){
		$Favor = M('favor');
		$Goods = M('goods');
		$token = I('get.token');

		$token_res = verifyToken($token);
		if(!$token_res['status']){
			$error = 999;
		}else{
			$search['user_id'] = $token_res['id'];
			$data = $Favor->where($search)->order('id desc')->select();
			if($data){
				$error = 0;
				$msg = '获取收藏成功';
				for($i=0;$i<count($data);$i++){
					$data[$i]['info'] = $Goods->where('id='.$data[$i]['goods_id'])->find();
				}
				$res = $data;
			}else{
				$error = 105;
				$msg = '获取收藏失败';
			}
		}
		

		$result = combineResult($error,$msg,$res);
		$this->ajaxReturn($result);  
	}

	//添加收藏
    public function addOrCancel(){
        $Favor = M('favor');
        $Goods = M('goods');
        $token = I('post.token');
		$add['goods_id'] = I('post.goods_id');
		$token_res = verifyToken($token);
		$add['user_id'] = $token_res['id'];

		if(!$token_res['status']){
			$error = 999;
		}else{

			$data = $Favor->where($add)->find();
			if($data){
				$add_res = $Favor->delete($data['id']);
				if($add_res >0){
					$error = 0;
					$msg = '取消收藏成功';
				}else{
					$error = 105;
					$msg = '取消收藏失败';
				}
			}else{
				$delete_res = $Favor->add($add);
				if($delete_res >0){
					$error = 0;
					$msg = '收藏成功';
				}else{
					$error = 105;
					$msg = '收藏失败';
				}
			}
		}
		$res = M('favor')->where('user_id='.$add['user_id'])->order('id desc')->select();
		for($i=0;$i<count($res);$i++){
			$res[$i]['info'] = $Goods->where('id='.$res[$i]['goods_id'])->find();
		}
		$result = combineResult($error,$msg,$res);
		$this->ajaxReturn($result); 

    }
}