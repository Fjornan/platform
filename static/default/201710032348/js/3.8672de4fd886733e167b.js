webpackJsonp([3,20],{29:function(e,t,r){r(84);var o=r(1)(r(176),r(151),null,null);e.exports=o.exports},62:function(e,t,r){t=e.exports=r(3)(),t.push([e.id,".avatar-uploader-icon,.avatar-uploader .el-upload-dragger{width:178px;height:178px}.avatar-uploader-icon{font-size:28px;color:#8c939d;line-height:178px;text-align:center}.recruit-pic{width:178px;height:178px;display:block}","",{version:3,sources:["/./src/pages/hhbb/product-edit.vue"],names:[],mappings:"AAKA,0DAHE,YAAa,AACb,YAAc,CASf,AAPD,sBACE,eAAgB,AAChB,cAAe,AAGf,kBAAmB,AACnB,iBAAmB,CACpB,AACD,aACE,YAAa,AACb,aAAc,AACd,aAAe,CAChB",file:"product-edit.vue",sourcesContent:["\n.avatar-uploader .el-upload-dragger{\n  width: 178px;\n  height: 178px;\n}\n.avatar-uploader-icon {\n  font-size: 28px;\n  color: #8c939d;\n  width: 178px;\n  height: 178px;\n  line-height: 178px;\n  text-align: center;\n}\n.recruit-pic {\n  width: 178px;\n  height: 178px;\n  display: block;\n}\n"],sourceRoot:"webpack://"}])},84:function(e,t,r){var o=r(62);"string"==typeof o&&(o=[[e.id,o,""]]);r(4)(o,{});o.locals&&(e.exports=o.locals)},151:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"p2222"},[r("div",{staticClass:"p2020 m0020 bor-bottom"},[r("el-breadcrumb",{attrs:{separator:"/"}},[r("el-breadcrumb-item",{attrs:{to:{path:"/hhbb/product"}}},[e._v("产品列表")]),e._v(" "),r("el-breadcrumb-item",[e._v("编辑产品")])],1)],1),e._v(" "),r("div",[r("el-row",[r("el-col",{attrs:{span:12}},[r("el-form",{ref:"form",attrs:{model:e.form,"label-width":"80px"}},[r("el-form-item",{attrs:{label:"产品名称"}},[r("el-input",{model:{value:e.form.name,callback:function(t){e.form.name=t},expression:"form.name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"备注"}},[r("el-input",{model:{value:e.form.sub_name,callback:function(t){e.form.sub_name=t},expression:"form.sub_name"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"价格"}},[r("el-input",{model:{value:e.form.price,callback:function(t){e.form.price=e._n(t)},expression:"form.price"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"单位"}},[r("el-input",{model:{value:e.form.unit,callback:function(t){e.form.unit=t},expression:"form.unit"}})],1),e._v(" "),r("el-form-item",[r("el-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v("保存")])],1)],1)],1)],1)],1)])},staticRenderFns:[]}},176:function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={data:function(){return{detail:[],total:0,slider_url:null,form:{},upload_url:"",upload_status:!1}},computed:{},mounted:function(){this.getDetail(),this.upload_url=this.$apiurl},attached:function(){},methods:{getDetail:function(){var e=this;this.$rqt.post("/hhbb/getProductDetail",{id:this.$route.params.id}).success(function(t){e.form=t.data})},onSubmit:function(){var e=this,t={};t.id=this.form.id,t.name=this.form.name,t.sub_name=this.form.sub_name,t.price=this.form.price,t.unit=this.form.unit,console.log(t),this.$rqt.post("/hhbb/productSave",t).success(function(t){e.$message({message:t.msg,type:"success"})})}},components:{}}}});
//# sourceMappingURL=3.8672de4fd886733e167b.js.map