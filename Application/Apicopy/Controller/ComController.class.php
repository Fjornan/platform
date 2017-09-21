<?php

namespace Api\Controller;

use Think\Controller;

class ComController extends Controller{
	public function _initialize(){
		$this->make_cors();
	}
	private function make_cors($origin = '*') {
 
	    $request_method = $_SERVER['REQUEST_METHOD'];
	 
	    if ($request_method === 'OPTIONS') {
	 		header('Access-Control-Allow-Headers:Authorization,Content-Type');
	 		header('Access-Control-Allow-Methods:GET, POST, OPTIONS, DELETE');
	        header('Access-Control-Allow-Origin:'.$origin);
	        header('Access-Control-Expose-Headers:Authorization'); 
	        
	 
	        // header('Access-Control-Max-Age:1728000');
	        // header('Content-Type:text/html charset=UTF-8');
	        // header('Content-Length: 0',true);
	 
	        // header('status: 204');
	        // header('HTTP/1.0 204 No Content');
	 
	    }
	 
	    if ($request_method === 'POST') {
	 
	        header('Access-Control-Allow-Origin:'.$origin);
	        header('Access-Control-Allow-Credentials:true');
	        header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
	 
	    }
	 
	    if ($request_method === 'GET') {
	 
	        header('Access-Control-Allow-Origin:'.$origin);
	        header('Access-Control-Allow-Credentials:true');
	        header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
	 
	    }
	 
	}
	

}