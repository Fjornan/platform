<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom pos-re">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/shop/amazon' }">亚马逊全球开店</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="bread-btn">
      <a :href="exportExcel">
      <el-button icon="upload2" type="primary" size="small">导出列表</el-button>
      </a>
    </div>
  </div>

  <el-select class="m0020" style="width:200px" v-model="status" size="small" placeholder="请选择分类" @change="handleChangeGetStatus">
    <el-option
      v-for="(item,key) in orderStatus"
      :label="item"
      :value="key">
    </el-option>
  </el-select>

  <el-table :data="tableData" stripe style="width: 100%;text-align:left">
    <el-table-column prop="company" label="公司名称"></el-table-column>
    <el-table-column prop="username" label="联系人姓名"></el-table-column>
    <el-table-column prop="phone" label="联系人电话"></el-table-column>
    <el-table-column prop="email" label="联系人邮箱"></el-table-column>
    <el-table-column prop="province" label="省份"></el-table-column>
    <el-table-column prop="product" label="主营产品"></el-table-column>
    <!-- <el-table-column prop="com_property" label="公司性质"></el-table-column>
    <el-table-column prop="year_sell" label="年销售额"></el-table-column> -->
    <el-table-column prop="create_time" label="提交时间"></el-table-column>
    <el-table-column label="操作" width="180">
      <template scope="scope">
        <router-link :to="{path: '/shop/amazonDetail/'+scope.row.id}">
          <el-button size="small">详情</el-button>
        </router-link>
        <el-button v-if="scope.row.status == 0" type="danger" size="small" @click="handleFinish(scope.$index, scope.row)">确认处理</el-button>
        <el-button v-else type="primary" size="small">已完成</el-button>
      </template>
    </el-table-column>
  </el-table>
</div>
  
</template>
<script>
export default {
  data() {
    return {
      orderStatus: {
        '-1': '全部',
        0: '未处理',
        1: '已处理'
      },
      status: '0',
      tableData: [],
      exportExcel: ''
    }
  },
  computed: {

  },
  watch: {
    status() {
      this.changeExportUrl()
    }
  },
  mounted() {
    this.getData()
  },
  attached() {},
  methods: {
    getData() {
      /* eslint-disable */
       this.$rqt.post('/shop/getAmazonApply', {
        status:this.status
       }).success((res) => {
          this.tableData = res.data;
      })
       this.exportExcel = `${SITE_URL}/shop/exportAmazonRes?status=${this.status}`
    },
    changeExportUrl(){
      this.exportExcel = `${SITE_URL}shop/exportAmazonRes?status=${this.status}`
    },
    handleChangeGetStatus(res){
      this.status = res;
      this.getData();
    },
    handleFinish(index,row){
      var that = this;
      this.$confirm('确认已经处理完该订单?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        that.finishSubmit(row.id)
      }).catch((res) => {
        console.log(res)   
      });
    },
    finishSubmit(id){
      this.$rqt.post('/shop/finishAmazonApply', {
        id:id
      }).success((res,xhr) => {
        if(res.error == 0){
          this.getData();
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
</style>
