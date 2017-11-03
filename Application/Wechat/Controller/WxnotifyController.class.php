<?php

namespace Wechat\Controller;

use Think\Controller;

class WxnotifyController extends Controller{
	public function _initialize(){
		
		
	}
	public function notify(){
	    // ↓↓↓下面的file_put_contents是用来简单查看异步发过来的数据 
	    // 导入微信支付sdk
	    Vendor('Weixinpay.Weixinpay');
	    $wxpay=new \Weixinpay();
	    $result=$wxpay->notify();
	    if ($result) {
	        // 验证成功 修改数据库的订单状态等 $result['out_trade_no']为订单id
	        if(substr($result['out_trade_no'],0,3) == 'VIP'){
	        	$id = substr($result['out_trade_no'],17);

	        	$db_user = M('user');
	        	if($db_user->where('id='.$id)->getField('is_member') == 1){
	        		$update['id'] = $id;
	        		$update['member_money'] = ((float)$result['total_fee'])/100;
	        		$update_res = $db_user->save($update);
	        	}else{
	        		//向card表中插入数据
		            $db_card = M('card');
		            $card_id = 10010000 + (int)$id;
		            $data['user_id'] = $id;
		            $data['number'] = $card_id;
		            $add_res = $db_card->add($data);

		            //向user表中插入数据
		            
		            $update['id'] = $id;
		            $update['is_member'] = 1;
		            $update['member_money'] = ((float)$result['total_fee'])/100;
		            $update['member_num'] = $card_id;
		            $update_res = $db_user->save($update);
	        	}
	            
	            

	        }else{
	        	$id = substr($result['out_trade_no'],14);
	        	$db = M('order');
	        	$db->where('id='.$id)->setField('status',1);
	        }
	    	

	    }
	}
	
}