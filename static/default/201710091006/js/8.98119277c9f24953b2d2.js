webpackJsonp([8,20],{42:function(t,e,a){a(79);var s=a(1)(a(187),a(146),null,null);t.exports=s.exports},57:function(t,e,a){e=t.exports=a(3)(),e.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"hasgoods.vue",sourceRoot:"webpack://"}])},79:function(t,e,a){var s=a(57);"string"==typeof s&&(s=[[t.id,s,""]]);a(4)(s,{});s.locals&&(t.exports=s.locals)},146:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"p2222"},[a("div",{staticClass:"p2020 m0020 bor-bottom pos-re"},[a("el-breadcrumb",{attrs:{separator:"/"}},[a("el-breadcrumb-item",{attrs:{to:{path:"/union/hasgoods"}}},[t._v("我有好货源")])],1)],1),t._v(" "),a("el-select",{staticClass:"m0020",staticStyle:{width:"200px"},attrs:{size:"small",placeholder:"请选择分类"},on:{change:t.handleChangeGetStatus},model:{value:t.status,callback:function(e){t.status=e},expression:"status"}},t._l(t.orderStatus,function(t,e){return a("el-option",{attrs:{label:t,value:e}})})),t._v(" "),a("el-table",{staticStyle:{width:"100%","text-align":"left"},attrs:{data:t.tableData,stripe:""}},[a("el-table-column",{attrs:{prop:"company",label:"公司名称"}}),t._v(" "),a("el-table-column",{attrs:{prop:"username",label:"联系人姓名"}}),t._v(" "),a("el-table-column",{attrs:{prop:"phone",label:"联系人电话"}}),t._v(" "),a("el-table-column",{attrs:{prop:"product",label:"供应产品"}}),t._v(" "),a("el-table-column",{attrs:{prop:"address",label:"工厂地址"}}),t._v(" "),a("el-table-column",{attrs:{prop:"advantage",label:"优势备注"}}),t._v(" "),a("el-table-column",{attrs:{prop:"create_time",label:"提交时间"}}),t._v(" "),a("el-table-column",{attrs:{label:"操作",width:"100"},scopedSlots:t._u([{key:"default",fn:function(e){return[0==e.row.status?a("el-button",{attrs:{type:"danger",size:"small"},on:{click:function(a){t.handleFinish(e.$index,e.row)}}},[t._v("确认处理")]):a("el-button",{attrs:{type:"primary",size:"small"}},[t._v("已完成")])]}}])})],1)],1)},staticRenderFns:[]}},187:function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{orderStatus:{"-1":"全部",0:"未处理",1:"已处理"},status:"0",tableData:[]}},computed:{},mounted:function(){this.getData()},attached:function(){},methods:{getData:function(){var t=this;this.$rqt.post("/union/getHasGoods",{status:this.status}).success(function(e){t.tableData=e.data})},handleChangeGetStatus:function(t){this.status=t,this.getData()},handleFinish:function(t,e){var a=this;this.$confirm("确认已经处理完该订单?","提示",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){a.finishSubmit(e.id)}).catch(function(t){console.log(t)})},finishSubmit:function(t){var e=this;this.$rqt.post("/union/finishHasGoods",{id:t}).success(function(t,a){0==t.error?(e.getData(),e.$message({message:t.msg,type:"success"})):e.$message({message:t.msg,type:"info"})})}},components:{}}}});
//# sourceMappingURL=8.98119277c9f24953b2d2.js.map