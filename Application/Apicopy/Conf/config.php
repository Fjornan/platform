<?php
//后台
return array(
	//'配置项'=>'配置值'
	//路由重定向
	'URL_ROUTE_RULES'=>array(
		//分类
		'sort/update/:id\d'			=>	'sort/update',	
		'sort/delete/:id\d'			=>	'sort/delete',
		//商品
	    'goods/:id\d'               => 	'goods/detail',
	    'goods/update/:id\d'		=>	'goods/update',
	    'goods/delete/:id\d'		=>	'goods/delete',
	    'goods/uploadPic/:id\d'		=>	'goods/uploadPic',
	    //购物车
	    'shoppingcart/delete/:id\d'	=>	'shoppingcart/delete',
	    //订单
	    'order/orderDetail/:id\d'	=>	'order/orderDetail',
	    'order/teamOrderDetail/:id\d'	=>	'order/teamOrderDetail',
	    //用户
	    'user/:id\d'				=> 	'user/detail',
	    'user/adminUpdate/:id\d'	=> 	'user/adminUpdate',
	    'user/delete/:id\d'			=> 	'user/delete',
	),
	//七牛云上传配置
	'UPLOAD_SITEIMG_QINIU' => array ( 
        'maxSize' => 5 * 1024 * 1024,//文件大小
        'rootPath' => './',
        'saveName' => array ('uniqid', ''),
        'driver' => 'Qiniu',
        'driverConfig' => [
        	'secretKey' => '_LLHYrU0FbTQHeCjzoiEhr9VA3RRg6DKw3Av7PSw', 
	        'accessKey' => 'GH8bb392NIeHChDiARCHRviVuSEST5lNWDDcZbza',
	        'domain' => 'ols5d86pb.bkt.clouddn.com',
	        'bucket' => 'fjornan', 
        ],
	        
    )
);