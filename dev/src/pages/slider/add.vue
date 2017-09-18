<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/slider' }">幻灯片列表</el-breadcrumb-item>
      <el-breadcrumb-item>添加幻灯片</el-breadcrumb-item>
    </el-breadcrumb>
  </div>
  
  <div>
  <el-row>
    <el-col :span="12">
      <el-form ref="form" :model="form" label-width="80px">
        <el-form-item label="幻灯片">
          <el-upload class="upload-demo" drag
            :action="upload_url+'/up/up_pic'"
            name = "Filedata"
            :show-file-list="false"
            :data="{
              'path':'product/pic'
            }"
            :on-progress="onAvatarUpload"
            :before-upload="beforeAvatarUpload"
            :on-success="handleAvatarScucess"
            mutiple>
            <i v-if="upload_status" class="el-icon-loading avatar-uploader-icon"></i>
            <img v-if="slider_url" :src="slider_url" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
        </el-form-item>
        <el-form-item label="首页显示">
          <el-switch on-text="是" off-text="否" v-model="form.display"></el-switch>
        </el-form-item>
        <el-form-item label="排序值">
          <el-input-number v-model="form.sort" :min="0"></el-input-number>
          <span class="p0002 color-light">排序值越大，幻灯片显示在越前面</span>
        </el-form-item>
        <el-form-item label="链接地址">
          <el-input v-model="form.link"></el-input>
        </el-form-item>
        <el-form-item label="备注">
          <el-input v-model="form.note"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存</el-button>
          <el-button>取消</el-button>
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
        display: 0,
        pic: '',
        sort: 0,
        link: '',
        note: ''
      },
      upload_url: '',
      upload_status: false
    }
  },
  computed: {},
  created() {

  },
  mounted() {
    /* eslint-disable */
    this.upload_url = this.$apiurl
  },
  attached() {},
  methods: {
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
      this.slider_url = `http://pic02.keyinong.com/${res}`
      this.form.pic = res
    },
    onSubmit() {
      const update = {}
      update.note = this.form.note
      update.display = (this.form.display === true ? 1 : 0)
      update.pic = this.form.pic
      update.link = this.form.link
      update.sort = this.form.sort
      // console.log(this.form)
      this.$rqt.post('/slider/save', update).success((res) => {
        this.$message({
          message: res.msg,
          type: 'success'
        })
      })
    }
  },
  components: {}
}
</script>

<style lang="css">
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #20a0ff;
  }
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
