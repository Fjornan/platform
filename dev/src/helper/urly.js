/* eslint-disable */

var urly = function(href){
	this.href = '';//完整路径
	this.href2 = '';//根路径
	this.paramsString = '';
	this.params = {};



	this.setHref = function(){

	}

	this.getHref = function(){
		return this.href;
	}

	this.setParams = function(params){
		var key;
		for(key in params){
			//if(this.params[key] != undefined){
			if(key != '' && key != undefined && params[key] != '' && params[key] != undefined)
			this.params[key] = params[key];
			if(this.params[key] != undefined && params[key] == '' || params[key] == undefined)
				delete this.params[key];
		}
		var p = '';
		var i = 0;
		for(key in this.params){
			if(key != '' && key != undefined){
				if(i==0){
					p = p + key + '=' + this.params[key];
				} else {
					p = p + '&' + key + '=' + this.params[key];
				}
				i++;
			}
		}
		this.paramsString = p;
		this.href = this.href2 + '?' + this.paramsString;
	}

	this.init = function(href){

		this.href = href;
		if(this.href.indexOf('?')>=0){
			this.paramsString = this.href.split('?')[1];
			this.href2 = this.href.split('?')[0];
		} else {
			this.href2 = href;
		}
		this.parseParams();
	}

	//return array
	this.parseParams = function(){
		var par = this.paramsString.split('&');
		var size = par.length;

		while(size--){
			//console.log(size);
			var p = par[size];
			//console.log(p)
			p = p.split('=');
			this.params[p[0]] = p[1]?p[1]:'';
		}

	}

	this.getParams = function(){
		return this.params;
	}

	this.init(href);

}

module.exports = urly;
