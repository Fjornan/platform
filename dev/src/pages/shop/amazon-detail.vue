<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/shop/amazon' }">开店申请列表</el-breadcrumb-item>
      <el-breadcrumb-item>申请详情</el-breadcrumb-item>
    </el-breadcrumb>
  </div>
  
  <div>
  <el-row>
    <el-col :span="12">
      <el-form ref="form" :model="form" label-width="80px">
        <el-form-item label="公司名称">
          <el-input v-model="form.company"></el-input>
        </el-form-item>
        <el-form-item label="联系人">
          <el-input v-model="form.username"></el-input>
        </el-form-item>
        <el-form-item label="联系电话">
          <el-input v-model="form.phone"></el-input>
        </el-form-item>
        <el-form-item label="邮箱">
          <el-input v-model="form.email"></el-input>
        </el-form-item>

        <el-form-item label="公司省份">
          <el-input v-model="form.province"></el-input>
        </el-form-item>
        <el-form-item label="主营产品">
          <el-input v-model="form.product"></el-input>
        </el-form-item>
        <el-form-item label="公司性质">
          <el-input v-model="form.com_property"></el-input>
        </el-form-item>
        <el-form-item label="年销售额">
          <el-input v-model="form.year_sell"></el-input>
        </el-form-item>
        <el-form-item label="是否开店">
          <el-input v-model="form.has_shop"></el-input>
        </el-form-item>
        <el-form-item label="意向站点">
          <el-input v-model="form.purpose_site"></el-input>
        </el-form-item>
        <el-form-item label="公司网址">
          <el-input v-model="form.web_site"></el-input>
        </el-form-item>
        <el-form-item label="感兴趣项">
          <el-input type="textarea" :rows="3" v-model="form.interet"></el-input>
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
      upload_status: false,

      hasShopType: {
        0: '已开店',
        1: '未开店'
      }
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
       this.$rqt.post('/shop/getAmazonApplyDetail', {
        id:this.$route.params.id
       }).success((res) => {
          that.form = res.data;
          that.form.has_shop = that.hasShopType[res.data.has_shop]
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
