webpackJsonp([15,20],{45:function(t,e,s){s(69);var o=s(1)(s(190),s(134),null,null);t.exports=o.exports},49:function(t,e,s){e=t.exports=s(3)(),e.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"seekgoods.vue",sourceRoot:"webpack://"}])},69:function(t,e,s){var o=s(49);"string"==typeof o&&(o=[[t.id,o,""]]);s(4)(o,{});o.locals&&(t.exports=o.locals)},134:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"p2222"},[s("div",{staticClass:"p2020 m0020 bor-bottom pos-re"},[s("el-breadcrumb",{attrs:{separator:"/"}},[s("el-breadcrumb-item",{attrs:{to:{path:"/union/seekgoods"}}},[t._v("我要找货源")])],1)],1),t._v(" "),s("el-select",{staticClass:"m0020",staticStyle:{width:"200px"},attrs:{size:"small",placeholder:"请选择分类"},on:{change:t.handleChangeGetStatus},model:{value:t.status,callback:function(e){t.status=e},expression:"status"}},t._l(t.seekGoodsStatus,function(t,e){return s("el-option",{attrs:{label:t,value:e}})})),t._v(" "),s("el-table",{staticStyle:{width:"100%","text-align":"left"},attrs:{data:t.seekgoods,stripe:""}},[s("el-table-column",{attrs:{prop:"company",label:"公司名称"}}),t._v(" "),s("el-table-column",{attrs:{prop:"username",label:"联系人姓名"}}),t._v(" "),s("el-table-column",{attrs:{prop:"phone",label:"联系人电话"}}),t._v(" "),s("el-table-column",{attrs:{prop:"product",label:"意向货源产品"}}),t._v(" "),s("el-table-column",{attrs:{prop:"advantage",label:"优势备注"}}),t._v(" "),s("el-table-column",{attrs:{prop:"create_time",label:"提交时间"}}),t._v(" "),s("el-table-column",{attrs:{label:"操作",width:"100"},scopedSlots:t._u([{key:"default",fn:function(e){return[0==e.row.status?s("el-button",{attrs:{type:"danger",size:"small"},on:{click:function(s){t.handleFinish(e.$index,e.row)}}},[t._v("确认处理")]):s("el-button",{attrs:{type:"primary",size:"small"}},[t._v("已完成")])]}}])})],1)],1)},staticRenderFns:[]}},190:function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{seekGoodsStatus:{"-1":"全部",0:"未处理",1:"已处理"},status:"0",seekgoods:[]}},computed:{},mounted:function(){this.getSeekGoods()},attached:function(){},methods:{getSeekGoods:function(){var t=this;this.$rqt.post("/union/getSeekGoods",{status:this.status}).success(function(e){t.seekgoods=e.data})},handleChangeGetStatus:function(t){this.status=t,this.getSeekGoods()},handleFinish:function(t,e){var s=this;this.$confirm("确认已经处理完该订单?","提示",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){s.finishSubmit(e.id)}).catch(function(t){console.log(t)})},finishSubmit:function(t){var e=this;this.$rqt.post("/union/finishSeekGoods",{id:t}).success(function(t,s){0==t.error?(e.getSeekGoods(),e.$message({message:t.msg,type:"success"})):e.$message({message:t.msg,type:"info"})})}},components:{}}}});
//# sourceMappingURL=15.ce85bf83636da1d7a54e.js.map