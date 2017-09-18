/**
 * 异步请求处理
 * 支持防止重复请求
 * 支持身份验证
 * 支持错误统一捕获
 */
// import fetch from 'whatwg-fetch'
import Auth from './auth'

/* eslint-disable */
//const base = 'http://localhost/CZTQT/index.php'
const base = SITE_URL
function rqt(url, data, type) {
  this.url = base + url
  this.data = data || {}
  this.type = type || 'get'
  this.successCallback = function(){}//eslint-disable-line
  this.errorCallback = function(){}//eslint-disable-line
  const that = this

  this.success = function(callback){
    this.successCallback = callback
    return this
  }

  this.error = function(callback){
    this.errorCallback = callback
    return this
  }

  if(!data.token)
    data.token = Auth.getData('token')

  $.ajax({
    url: this.url,
    type: this.type,
    data: data,
    success: function(data){//eslint-disable-line
      that.successCallback(data)
    },
    error: function(data){//eslint-disable-line
      that.errorCallback(data)
    }
  })
}

export default {
  error : function(){},
  post (url, data){
    return new rqt(url, data, 'post').error(this.error)
  },
  get (url, data){
    return new rqt(url, data, 'get').error(this.error)
  }
}
