<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/recruit' }">岗位列表</el-breadcrumb-item>
      <el-breadcrumb-item>编辑岗位</el-breadcrumb-item>
    </el-breadcrumb>
  </div>
  
  <div>
  <el-row>
    <el-col :span="12">
      <el-form ref="form" :model="form" label-width="80px">
        <el-form-item label="Logo">
          <el-upload class="avatar-uploader" drag
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
            <img v-if="slider_url" :src="slider_url" class="recruit-pic">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
        </el-form-item>
        <el-form-item label="岗位名称">
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="首页显示">
          <el-switch on-text="是" off-text="否" v-model="form.display"></el-switch>
        </el-form-item>
        <el-form-item label="排序值">
          <el-input-number v-model="form.sort" :min="0"></el-input-number>
          <span class="p0002 color-light">排序值越大，显示在越前面</span>
        </el-form-item>
        
        <el-form-item label="岗位需求">
          <el-input type="textarea" v-model="form.require" placeholder="请用$将每一条需求分隔开"></el-input>
        </el-form-item>
        <el-form-item label="岗位待遇">
          <el-input type="textarea" v-model="form.treatment" placeholder="请用$将每一条待遇分隔开"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存</el-button>
          <!-- <el-button>取消</el-button> -->
        </el-form-item>
      </el-form>
    </el-col>
  </el-row>
    
    
  </div>
</div>
  
</template>
<script>
export default {
  data() {
    return {
      detail: [],
      total: 0,
      slider_url: null,
      form: {
        display: 0

      },
      upload_url: '',
      upload_status: false
    }
  },
  computed: {},
  mounted() {
    this.getDetail()
    this.upload_url = this.$apiurl
  },
  attached() {},
  methods: {
    getDetail() {
      /* eslint-disable */
       var that = this
       this.$rqt.post('/recruit/get_detail_by_id', {
        id:this.$route.params.id
       }).success((res) => {
          that.form = res.data.detail;
          that.slider_url = 'http://pic02.keyinong.com/'+res.data.detail.logo;
          that.form.display = (res.data.detail.display == 1? true:false)
      })
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
    handleAvatarScucess(res, file) {
      this.upload_status = false
      this.slider_url = 'http://pic02.keyinong.com/'+res;
      this.form.logo = res
    },
    onSubmit () {
      var update = {};
      update.id = this.form.id;
      update.name = this.form.name;
      update.require = this.form.require;
      update.treatment = this.form.treatment;
      update.display = (this.form.display == true?1:0);
      update.logo = this.form.logo;
      update.sort = this.form.sort;
      console.log(this.form)    
      this.$rqt.post('/recruit/save', update).success((res) => {
          this.$message({
            message: res.msg,
            type: 'success'
          });
      })
      
    }
  },
  components: {}
}
</script>

<style lang="css">
  .avatar-uploader .el-upload-dragger{
    width: 178px;
    height: 178px;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .recruit-pic {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>
