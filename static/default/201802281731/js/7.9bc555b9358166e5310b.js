webpackJsonp([7,20],{31:function(t,e,s){s(82);var a=s(1)(s(181),s(150),null,null);t.exports=a.exports},59:function(t,e,s){e=t.exports=s(3)(),e.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"amazon.vue",sourceRoot:"webpack://"}])},82:function(t,e,s){var a=s(59);"string"==typeof a&&(a=[[t.id,a,""]]);s(4)(a,{});a.locals&&(t.exports=a.locals)},150:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"p2222"},[s("div",{staticClass:"p2020 m0020 bor-bottom pos-re"},[s("el-breadcrumb",{attrs:{separator:"/"}},[s("el-breadcrumb-item",{attrs:{to:{path:"/logistics/amazon"}}},[t._v("亚马逊FBA头程物流")])],1)],1),t._v(" "),s("el-select",{staticClass:"m0020",staticStyle:{width:"200px"},attrs:{size:"small",placeholder:"请选择分类"},on:{change:t.handleChangeGetStatus},model:{value:t.status,callback:function(e){t.status=e},expression:"status"}},t._l(t.orderStatus,function(t,e){return s("el-option",{attrs:{label:t,value:e}})})),t._v(" "),s("el-table",{staticStyle:{width:"100%","text-align":"left"},attrs:{data:t.tableData,stripe:""}},[s("el-table-column",{attrs:{prop:"company",label:"公司名称"}}),t._v(" "),s("el-table-column",{attrs:{prop:"username",label:"发货联系人"}}),t._v(" "),s("el-table-column",{attrs:{prop:"phone",label:"发货联系人电话"}}),t._v(" "),s("el-table-column",{attrs:{prop:"product",label:"所发产品"}}),t._v(" "),s("el-table-column",{attrs:{prop:"weight",label:"发货重量（KG）"}}),t._v(" "),s("el-table-column",{attrs:{prop:"address_from",label:"发货/取货地址"}}),t._v(" "),s("el-table-column",{attrs:{prop:"address_to",label:"发货目的亚马逊站点"}}),t._v(" "),s("el-table-column",{attrs:{prop:"create_time",label:"提交时间"}}),t._v(" "),s("el-table-column",{attrs:{label:"操作",width:"100"},scopedSlots:t._u([{key:"default",fn:function(e){return[0==e.row.status?s("el-button",{attrs:{type:"danger",size:"small"},on:{click:function(s){t.handleFinish(e.$index,e.row)}}},[t._v("确认处理")]):s("el-button",{attrs:{type:"primary",size:"small"}},[t._v("已完成")])]}}])})],1)],1)},staticRenderFns:[]}},181:function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{orderStatus:{"-1":"全部",0:"未处理",1:"已处理"},status:"-1",tableData:[]}},computed:{},mounted:function(){this.getData()},attached:function(){},methods:{getData:function(){var t=this;this.$rqt.post("/logistics/getLogistics",{status:this.status}).success(function(e){t.tableData=e.data})},handleChangeGetStatus:function(t){this.status=t,this.getData()},handleFinish:function(t,e){var s=this;this.$confirm("确认已经处理完该订单?","提示",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){s.finishSubmit(e.id)}).catch(function(t){console.log(t)})},finishSubmit:function(t){var e=this;this.$rqt.post("/logistics/finishLogistics",{id:t}).success(function(t,s){0==t.error?(e.getData(),e.$message({message:t.msg,type:"success"})):e.$message({message:t.msg,type:"info"})})}},components:{}}}});
//# sourceMappingURL=7.9bc555b9358166e5310b.js.map