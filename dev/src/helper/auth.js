/*
 * 登录验证模块
 * 检查是否登录
 * 登录后将token信息写入localstorage
 * 注销登录清楚token
 */

 /* eslint-disable */
module.exports =  {
	//批量插入
	addData: function(data){
		var key;
		if(this._check()){
			for(key in data){
				localStorage[key] = data[key];
			}
		}
	},
	//单个查询
	getData: function(key){
		if(this._check()){
			return localStorage[key];
		} else {
			return false;
		}
	},
	login: function(data){
		data.expire = new Date().getTime()
		data.login = true
		var key;
		if(this._check()){
			for(key in data){
				localStorage[key] = data[key];
			}
		}
	},
	logout: function(){
		if(this._check()){
			localStorage.token = '';
			localStorage.login = '';
		} else {
			return false;
		}
	},
	checkLogin: function(){
		if(this._check()){
			if(localStorage['login'] == '' || localStorage['login'] == undefined){
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	},
	_check: function(){
		if(window.localStorage){
			return true;
		} else {
			console.log('localStorage unsupported');
			return false;
		}
	}
}
