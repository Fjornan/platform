webpackJsonp([5,20],{30:function(t,e,s){s(84);var o=s(1)(s(180),s(152),null,null);t.exports=o.exports},61:function(t,e,s){e=t.exports=s(3)(),e.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"product.vue",sourceRoot:"webpack://"}])},84:function(t,e,s){var o=s(61);"string"==typeof o&&(o=[[t.id,o,""]]);s(4)(o,{});o.locals&&(t.exports=o.locals)},152:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"p2222"},[s("div",{staticClass:"p2020 m0020 bor-bottom pos-re"},[s("el-breadcrumb",{attrs:{separator:"/"}},[s("el-breadcrumb-item",{attrs:{to:{path:"/hhbb/product"}}},[t._v("产品列表")])],1)],1),t._v(" "),s("el-select",{staticClass:"m0020",staticStyle:{width:"200px"},attrs:{size:"small",placeholder:"请选择分类"},on:{change:t.handleChangeGetType},model:{value:t.type,callback:function(e){t.type=e},expression:"type"}},t._l(t.productType,function(t,e){return s("el-option",{attrs:{label:t,value:e}})})),t._v(" "),s("el-table",{staticStyle:{width:"100%","text-align":"left"},attrs:{data:t.product,stripe:""}},[s("el-table-column",{attrs:{prop:"name",label:"名称"}}),t._v(" "),s("el-table-column",{attrs:{prop:"sub_name",label:"备注"}}),t._v(" "),s("el-table-column",{attrs:{prop:"price",label:"价格"}}),t._v(" "),s("el-table-column",{attrs:{prop:"unit",label:"单位"}}),t._v(" "),s("el-table-column",{attrs:{label:"操作",width:"100"},scopedSlots:t._u([{key:"default",fn:function(e){return[s("router-link",{attrs:{to:{path:"/hhbb/proedit/"+e.row.id}}},[s("el-button",{attrs:{size:"small"}},[t._v("编辑")])],1)]}}])})],1)],1)},staticRenderFns:[]}},180:function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{displayType:{0:"不显示",1:"显示"},productType:{gszc:"跨境电商产品评测",zscq:"海外商标及专利申请",upc:"UPC",vat:"VAT",kjsk:"跨境收款工具",tpps:"专业跨境产品拍图",kjfy:"专业跨境翻译服务",ppjz:"品牌建站",yyzc:"跨境运营支持"},type:"gszc",product:[]}},computed:{},mounted:function(){this.getProduct()},attached:function(){},methods:{getProduct:function(){var t=this;this.$rqt.post("/hhbb/getProduct",{type:this.type}).success(function(e){t.product=e.data})},handleChangeGetType:function(t){this.type=t,this.getProduct()},handleDelete:function(t,e){var s=this;this.$confirm("此操作将永久删除该用户, 是否继续?","提示",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){s.deleteSubmit(e.id)}).catch(function(t){console.log(t)})},deleteSubmit:function(t){var e=this;this.$rqt.post("/recruit/delete",{id:t}).success(function(t,s){t.code?(e.getUser(),e.$message({message:t.msg,type:"success"})):e.$message({message:t.msg,type:"info"})})}},components:{}}}});
//# sourceMappingURL=5.f1db5fbb2a464e278f0f.js.map