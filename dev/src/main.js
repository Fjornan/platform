// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
import VueEditor from 'vue2-editor'
// import Vuex from 'vuex'
// import boneStore from 'bone-store'
import boneApi from 'bone-api'
import Rqt from './helper/rqt'
import Auth from './helper/auth'
import '../static/css/layouts.css'
import store from './store'
import router from './router'
import App from './App'


/* eslint-disable */
boneApi.config({
  base: 'http://localhost/supaihome/index.php',
  filterData: function(data, config){
    // 如果是token访问在此处全局添加token
    // if(boneStore.get('token'))
    //  data.token = boneStore.get('token')
    // return data
  },
  filterConfig: function(config){
    if(config.headers){
      config.headers.auth = 'your token here'
    } else {
      config.headers ={
        'Access-Control-Allow-Headers': null
      }
    }
    return config
  },
  route: function(res){
    // 全局回调处理
    if(res.code == 0){
      // call success function when return true
      return true
      console.log(res)
    } else {
      // call error function when return false
      return false
      console.log(res)
    }
  },
  error: function(){ // eslint-disable-line
    alert('网络错误') // eslint-disable-line
  }
})


// 创建根实例
Vue.use(ElementUI)
// Vue.prototype.$rqt = boneApi
Rqt.error = function(res){
  Vue.prototype.$message({
    type: 'info',
    message: res.msg || '服务器开小差了'
  });
}

Vue.use(VueEditor)
Vue.prototype.$rqt = Rqt
Vue.prototype.$auth = Auth
// Vue.prototype.$auth = boneStore
// console.log(SITE_URL)
Vue.prototype.$apiurl = SITE_URL

new Vue({
  store,
  router,
  el: '#app',
  template: '<App/>',
  components: { App }
})
