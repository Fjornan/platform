webpackJsonp([0,20],{34:function(n,o,A){A(77);var t=A(1)(A(183),A(144),null,null);n.exports=t.exports},55:function(n,o,A){o=n.exports=A(3)(),o.push([n.id,"body,html{height:100%}.login-contain{height:100%;width:100%;background-size:cover;background-image:url("+A(66)+");text-align:center;transition:all .4s ease-in-out!important}.login-back{z-index:-1;width:100%;height:100%}.login-back,.login-content{left:0;right:0;position:absolute}.login-logo{padding-top:8%;padding-bottom:20px}.login-logo span{color:#fff;font-size:24px}.login-logo img{width:100px;position:relative;top:3px}.login-main{margin:auto;width:400px;border-radius:5px;background-color:#fff;box-shadow:0 0 8px #444;padding:10px}.login-input{padding:5px 30px 10px}.login-main input{width:100%;height:30px;margin-top:30px;border:none;border-bottom:1px solid #ccc;color:#666;font-size:14px}.login-main input:focus{outline:none;border-bottom-color:#20a0ff}.login-prompt{position:absolute;font-size:10px;color:#ff4949}.get-code-button{font-size:14px;width:250px;padding:7px 5px 5px;margin-top:10px;background-color:#20a0ff;color:#fff;border-radius:20px}.login-button{padding:10px 50px;background-color:#1fb5fc;border-radius:20px;color:#fff;display:block;margin:40px 20px 20px}.login-button:hover{background-color:#0ba1e8;cursor:pointer}.login-bottom a{color:#1fb5fc!important;font-size:14px}.login-bottom a:hover{color:#0ba1e8!important}","",{version:3,sources:["/./src/pages/passport/login.vue"],names:[],mappings:"AAIA,UACE,WAAY,CACb,AACD,eACE,YAAa,AACb,WAAY,AACZ,sBAAuB,AACvB,+CAAkD,AAClD,kBAAmB,AACnB,wCAA4C,CAC7C,AACD,YACE,WAAY,AACZ,WAAY,AACZ,WAAa,CAId,AACD,2BAJE,OAAQ,AACR,QAAS,AACT,iBAAmB,CAMpB,AACD,YACE,eAAgB,AAChB,mBAAqB,CACtB,AACD,iBACE,WAAY,AACZ,cAAgB,CACjB,AACD,gBACE,YAAa,AACb,kBAAmB,AACnB,OAAS,CACV,AACD,YACE,YAAa,AACb,YAAa,AACb,kBAAmB,AACnB,sBAAuB,AACvB,wBAA6B,AAC7B,YAAa,CACd,AACD,aACE,qBAAuB,CACxB,AACD,kBACE,WAAY,AACZ,YAAa,AACb,gBAAiB,AACjB,YAAY,AACZ,6BAA8B,AAC9B,WAAY,AACZ,cAAgB,CACjB,AACD,wBACE,aAAc,AACd,2BAA4B,CAC7B,AACD,cACE,kBAAmB,AACnB,eAAgB,AAChB,aAAc,CACf,AACD,iBACE,eAAgB,AAChB,YAAa,AACb,oBAAqB,AACrB,gBAAiB,AACjB,yBAA0B,AAC1B,WAAY,AACZ,kBAAoB,CACrB,AACD,cACE,kBAAmB,AACnB,yBAA0B,AAC1B,mBAAoB,AACpB,WAAY,AACZ,cAAe,AACf,qBAAuB,CACxB,AACD,oBACE,yBAA0B,AAC1B,cAAgB,CACjB,AACD,gBACE,wBAA0B,AAC1B,cAAgB,CACjB,AACD,sBACE,uBAA0B,CAC3B",file:"login.vue",sourcesContent:["\nhtml{\n  height: 100%\n}\nbody{\n  height: 100%\n}\n.login-contain{\n  height: 100%;\n  width: 100%;\n  background-size: cover;\n  background-image: url(../../../static/img/bg.jpg);\n  text-align: center;\n  transition: all ease-in-out 0.4s !important;\n}\n.login-back{\n  z-index: -1;\n  width: 100%;\n  height: 100%;\n  left: 0;\n  right: 0;\n  position: absolute;\n}\n.login-content{\n  position: absolute;\n  left: 0;\n  right: 0;\n}\n.login-logo{\n  padding-top: 8%;\n  padding-bottom: 20px;\n}\n.login-logo span{\n  color: #fff;\n  font-size: 24px;\n}\n.login-logo img{\n  width: 100px;\n  position: relative;\n  top: 3px;\n}\n.login-main{\n  margin: auto;\n  width: 400px;\n  border-radius: 5px;\n  background-color: #fff;\n  box-shadow: 0px 0px 8px #444;\n  padding:10px;\n}\n.login-input{\n  padding: 5px 30px 10px;\n}\n.login-main input{\n  width: 100%;\n  height: 30px;\n  margin-top: 30px;\n  border:none;\n  border-bottom: 1px #ccc solid;\n  color: #666;\n  font-size: 14px;\n}\n.login-main input:focus{\n  outline: none;\n  border-bottom-color:#20a0ff;\n}\n.login-prompt{\n  position: absolute;\n  font-size: 10px;\n  color: #ff4949\n}\n.get-code-button{\n  font-size: 14px;\n  width: 250px;\n  padding: 7px 5px 5px;\n  margin-top: 10px;\n  background-color: #20a0ff;\n  color: #fff;\n  border-radius: 20px;\n}\n.login-button{\n  padding: 10px 50px;\n  background-color: #1fb5fc;\n  border-radius: 20px;\n  color: #fff;\n  display: block;\n  margin: 40px 20px 20px;\n}\n.login-button:hover{\n  background-color: #0ba1e8;\n  cursor: pointer;\n}\n.login-bottom a{\n  color: #1fb5fc !important;\n  font-size: 14px;\n}\n.login-bottom a:hover{\n  color: #0ba1e8 !important;\n}\n"],sourceRoot:"webpack://"}])},66:function(n,o,A){n.exports=A.p+"static/default/201802281542/img/bg.89fe697.jpg"},77:function(n,o,A){var t=A(55);"string"==typeof t&&(t=[[n.id,t,""]]);A(4)(t,{});t.locals&&(n.exports=t.locals)},144:function(n,o){n.exports={render:function(){var n=this,o=n.$createElement,A=n._self._c||o;return A("div",{staticClass:"login-contain"},[n._m(0),n._v(" "),A("div",{staticClass:"login-main"},[A("div",{staticClass:"login-input"},[A("input",{directives:[{name:"model",rawName:"v-model",value:n.username,expression:"username"}],attrs:{type:"text",name:"",placeholder:"Username"},domProps:{value:n.username},on:{input:function(o){o.target.composing||(n.username=o.target.value)}}}),n._v(" "),A("input",{directives:[{name:"model",rawName:"v-model",value:n.password,expression:"password"}],attrs:{type:"password",name:"",placeholder:"Password"},domProps:{value:n.password},on:{input:function(o){o.target.composing||(n.password=o.target.value)}}}),n._v(" "),A("a",{staticClass:"login-button",on:{click:n.loginSubmit}},[n._v("登 录")])])])])},staticRenderFns:[function(){var n=this,o=n.$createElement,A=n._self._c||o;return A("div",{staticClass:"login-logo"},[A("span",[n._v("鲸航跨境")])])}]}},183:function(n,o){"use strict";Object.defineProperty(o,"__esModule",{value:!0}),o.default={data:function(){return{username:"",password:""}},computed:{},mounted:function(){},attached:function(){},methods:{ajax:function(){console.log("test"),this.$api.post("/",{}).success(function(){})},loginSubmit:function(){var n=this;this.$rqt.post("/passport/login",{username:this.username,password:this.password}).success(function(o){0==o.error?(console.log(o.data),n.$auth.login({token:o.data}),n.$router.push("/user")):n.$message({message:o.msg,type:"info"})})}},components:{}}}});
//# sourceMappingURL=0.a61eac078425db18cbf1.js.map