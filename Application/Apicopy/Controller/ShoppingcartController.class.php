<?php
namespace Api\Controller;

class ShoppingcartController extends ComController {
	//用户：获取购物车信息
	public function index(){
		$Cart = M('shoppingcart');
		$Goods = M('goods');
		$token = I('get.token');

		$token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else{
        	$search['user_id']=$token_res['id'];
        	$error = 0;
            $msg = '购物车信息获取成功';
            $res = $Cart->where($search)->select();
            for($i=0;$i<count($res);$i++){
				$res[$i]['info'] = $Goods->where('id='.$res[$i]['goods_id'])->find();
			}
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
	}
	//用户：商品添加到购物车
    public function add(){
        $Cart = M('shoppingcart');
        $Goods = M('goods');

        $token = I('post.token');
        $add['goods_id'] = I('post.goods_id');

		$token_res = verifyToken($token);
		if(!$token_res['status']){
			$error = 999;
		}else if($add['goods_id'] == ''){
			$error = 101;
			$msg = '商品id不能为空';
		}else{
			$add['user_id'] = $token_res['id'];
			if($Cart->where($add)->find()){
				$error = 105;
				$msg = '购物车已存在该商品';
			}else{
				$add['amount'] = 1;
				$add_res = $Cart->add($add);
				if($add_res > 0){
					$error = 0;
					$msg = '成功添加到购物车';
				}else{
					$error = 105;
					$msg = '添加到购物车失败';
				}
			}
		}
		
		$res = $Cart->where('user_id='.$token_res['id'])->select();
		for($i=0;$i<count($res);$i++){
			$res[$i]['info'] = $Goods->where('id='.$res[$i]['goods_id'])->find();
		}
		$result = combineResult($error,$msg,$res);
		$this->ajaxReturn($result);  
    }
    //用户：购物车数量+1
    public function plus(){
    	$Cart = M('shoppingcart');
    	$Goods = M('goods');

    	$token = I('post.token');
    	$id = I('post.id');

    	$token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
        	$error = 101;
        	$msg='购物车id不能为空';
        }else{
            $amount = $Cart->where('id='.$id)->getField('amount');
            $plus_res = $Cart->where('id='.$id)->setField('amount',$amount+1);
            if($plus_res>0){
            	$error = 0;
            	$msg = '添加成功';
            }else{
            	$error = 105;
            	$msg = '添加失败';
            }
        }
        $res = $Cart->where('user_id='.$token_res['id'])->select();
		for($i=0;$i<count($res);$i++){
			$res[$i]['info'] = $Goods->where('id='.$res[$i]['goods_id'])->find();
		}
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //用户：购物车数量-1
    public function minus(){
    	$Cart = M('shoppingcart');
    	$Goods = M('goods');

    	$token = I('post.token');
    	$id = I('post.id');

    	$token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
        	$error = 101;
        	$msg='购物车id不能为空';
        }else{
            $amount = $Cart->where('id='.$id)->getField('amount');
            if($amount == 1){
            	$error = 0;
            	$msg = '数量无法再减少';
            }else{
            	$amount--;
            	$plus_res = $Cart->where('id='.$id)->setField('amount',$amount);
	            if($plus_res>0){
	            	$error = 0;
	            	$msg = '数量删减成功';
	            }else{
	            	$error = 105;
	            	$msg = '数量删减失败';
	            }
            }
            
        }
        $res = $Cart->where('user_id='.$token_res['id'])->select();
		for($i=0;$i<count($res);$i++){
			$res[$i]['info'] = $Goods->where('id='.$res[$i]['goods_id'])->find();
		}
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //用户：删除购物车中的某件商品
    public function delete(){
    	$Cart = M('shoppingcart');
    	$Goods = M('goods');

    	$token = I('get.token');
    	$id = I('get.id');

    	$token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else if($id == ''){
        	$error = 101;
        	$msg='购物车id不能为空';
        }else{
        	$delete_res = $Cart->delete($id);
            if($delete_res>0){
            	$error = 0;
            	$msg = '删除成功';
            }else{
            	$error = 105;
            	$msg = '删除失败';
            }
        }
        $res = $Cart->where('user_id='.$token_res['id'])->select();
		for($i=0;$i<count($res);$i++){
			$res[$i]['info'] = $Goods->where('id='.$res[$i]['goods_id'])->find();
		}
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //用户：清空购物车
    public function empty(){
    	$Cart = M('shoppingcart');
    	$Goods = M('goods');

    	$token = I('get.token');

    	$token_res = verifyToken($token);
    	$user_id = $token_res['id'];
        if(!$token_res['status']){
            $error = 999;
        }else{
        	$delete_res = $Cart->where('user_id='.$user_id)->delete();
            if($delete_res>0){
            	$error = 0;
            	$msg = '购物车清空成功';
            }else{
            	$error = 105;
            	$msg = '购物车删除失败';
            }
        }
        $res = $Cart->where('user_id='.$token_res['id'])->select();
		for($i=0;$i<count($res);$i++){
			$res[$i]['info'] = $Goods->where('id='.$res[$i]['goods_id'])->find();
		}
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }

}