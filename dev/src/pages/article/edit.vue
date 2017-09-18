<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/article' }">文章列表</el-breadcrumb-item>
      <el-breadcrumb-item>编辑文章</el-breadcrumb-item>
    </el-breadcrumb>
  </div>
  <div>
    <el-form ref="form" :model="form" label-width="80px">
      <div style="width:500px">
        <el-form-item label="封 面">
          <el-upload class="upload-demo" drag
            :action="upload_url+'/up/up_pic'"
            name = "Filedata"
            :show-file-list="false"
            :data="{
              'path':'product/pic'
            }"
            :before-upload="beforeAvatarUpload"
            :on-progress="onAvatarUpload"
            :on-success="handleAvatarScucess"
            mutiple>
            <i v-if="upload_status" class="el-icon-loading avatar-uploader-icon"></i>
            <img v-if="thumb_url" :src="thumb_url" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
        </el-form-item>
        <el-form-item label="标题">
          <el-input v-model="form.title"></el-input>
        </el-form-item>
        <el-form-item label="作者">
          <el-input v-model="form.author"></el-input>
        </el-form-item>
        <el-form-item label="分类">
          <el-select v-model="form.type" placeholder="请选择文章分类">
            <el-option
              v-for="(item,key) in articleType"
              :label="item"
              :value="key">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="摘要">
          <el-input type="textarea" v-model="form.digest"></el-input>
        </el-form-item>
      </div>
      <el-form-item  style="width:900px" label="内 容">
         <div id="editEditor"></div>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">保存</el-button>
      </el-form-item>
    </el-form>
           
  </div>
</div>
  
</template>
<script>
import E from 'wangeditor'

export default {
  data() {
    return {
      displayType: {
        0: '不显示',
        1: '显示'
      },
      articleType: {
        0: '未分类',
        1: '公司新闻',
        2: '品牌活动',
        3: '每周学生营养餐菜单',
        4: '对外招标信息'
      },
      content: '',
      form: {
        title: '',
        author: '',
        digest: '',
        content: '',
        type: '0',
        wangE: ''
      },
      upload_url: '',
      thumb_url: '',
      wangE: '',
      upload_status: false

    }
  },
  computed: {},
  mounted() {
    this.wangEditorInit()
    this.getArticle()
    this.upload_url = this.$apiurl
  },
  attached() {},
  methods: {
    getArticle() {
      /* eslint-disable */
       this.$rqt.post('/article/get_article_by_id', {
        id:this.$route.params.id
       }).success((res) => {
          this.form = res.data.detail;
          this.thumb_url = 'http://pic02.keyinong.com/'+res.data.detail.thumb_url
          this.wangE.txt.html(res.data.detail.content)
          // console.log(this.form)
      })
    },
    wangEditorInit(){
      var that = this
      this.wangE = new E('#editEditor')
      var config = {
        uploadImgServer:this.$apiurl+'/up/up_pic2',
        uploadImgParams:{
          token: this.$auth.getData('token')  
        },
        uploadFileName:'Filedata',
        uploadImgMaxSize:2 * 1024 * 1024,
        uploadImgMaxLength:1,
        uploadImgHooks:{
          success: function (xhr, editor, result) {
              that.addImageToContent(result.key)
          },
          fail: function (xhr, editor, result) {
              console.log(result)
              if(result.error == 0){
                that.addImageToContent(result.key)
              }
              
          },
          error: function (xhr, editor) {
              console.log(xhr)
          }
        },
      }
      this.wangE.customConfig = config;
      this.wangE.customConfig.customAlert = function (info) {
          // info 是需要提示的内容
          // console.log(info)
      }
      this.wangE.create()
    },
    addImageToContent(url){
      var url = 'http://pic02.keyinong.com/'+url
      this.wangE.txt.append('<img style="max-width:100%;" src='+url+'>')
    },
    beforeAvatarUpload(file) {
      const isLt2M = file.size / 1024 / 1024 < 2;
      if (!isLt2M) {
        this.$message.error('亲，上传图片大小不能超过 2MB');
      }
    },
    onAvatarUpload(event, file, fileList){
      this.upload_status = true
    },
    handleAvatarScucess(res) {
      this.upload_status = false
      this.thumb_url = `http://pic02.keyinong.com/${res}`
      this.form.thumb_url = res
    },
    onSubmit(){
      this.form.content = this.wangE.txt.html()
      if(this.form.title==''){
        this.$message({
          message: '请输入文章标题',
          type: 'info'
        })
        return false
      }
      this.$rqt.post('/article/save', this.form).success((res) => {
        if(res.code){
          this.$message({
            message: res.msg,
            type: 'success'
          });
        }else{
          this.$message({
            message: res.msg,
            type: 'info'
          });
        }
      })
    }
  },
  components: {}
}
</script>
<style lang="css">
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 100%;
    height: 100%;
    display: block;
  }
</style>