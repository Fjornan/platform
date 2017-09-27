<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/hhbb/product' }">产品列表</el-breadcrumb-item>
      <el-breadcrumb-item>编辑产品</el-breadcrumb-item>
    </el-breadcrumb>
  </div>
  
  <div>
  <el-row>
    <el-col :span="12">
      <el-form ref="form" :model="form" label-width="80px">
        <el-form-item label="产品名称">
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="备注">
          <el-input v-model="form.sub_name"></el-input>
        </el-form-item>
        <el-form-item label="价格">
          <el-input v-model.number="form.price"></el-input>
        </el-form-item>
        <el-form-item label="单位">
          <el-input v-model="form.unit"></el-input>
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
       this.$rqt.post('/hhbb/getProductDetail', {
        id:this.$route.params.id
       }).success((res) => {
          that.form = res.data;
      })
    },
    onSubmit () {
      var update = {};
      update.id = this.form.id;
      update.name = this.form.name;
      update.sub_name = this.form.sub_name;
      update.price = this.form.price;
      update.unit = this.form.unit;
      console.log(update);
      this.$rqt.post('/hhbb/productSave', update).success((res) => {
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
