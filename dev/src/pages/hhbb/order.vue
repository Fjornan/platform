<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom pos-re">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/hhbb/patent' }">海航必备订单</el-breadcrumb-item>
    </el-breadcrumb>
    <!-- <div class="bread-btn">
      <router-link :to="{path: '/user/add'}" >
      <el-button icon="plus" type="primary" size="small">添加</el-button>
      </router-link>
    </div> -->
  </div>

  <el-select class="m0020" style="width:200px" v-model="type" size="small" placeholder="请选择分类" @change="handleChangeGetType">
    <el-option
      v-for="(item,key) in productType"
      :label="item"
      :value="key">
    </el-option>
  </el-select>

  <el-select class="m0020" style="width:200px" v-model="status" size="small" placeholder="请选择分类" @change="handleChangeGetStatus">
    <el-option
      v-for="(item,key) in orderStatus"
      :label="item"
      :value="key">
    </el-option>
  </el-select>

  <el-table :data="tableData" stripe style="width: 100%;text-align:left">
    <el-table-column prop="name" label="会员姓名" width="100"></el-table-column>
    <el-table-column prop="product" label="购买产品"></el-table-column>
    <el-table-column prop="price" label="总价(元)" width="100"></el-table-column>
    <el-table-column v-if="type == 'upc'" prop="amount" label="个数" width="80"></el-table-column>
    <el-table-column prop="phone" label="联系方式" width="130"></el-table-column>
<!--     <el-table-column prop="note" label="备注" width="100"></el-table-column> -->
    <el-table-column v-if="type == 'upc'" prop="email" label="邮箱" width="120"></el-table-column>
    <el-table-column prop="create_time" label="下单时间" width="120"></el-table-column>
    <el-table-column label="操作" width="100">
      <template scope="scope">
        <el-button v-if="scope.row.status == 1" type="danger" size="small" @click="handleFinish(scope.$index, scope.row)">确认处理</el-button>
        <el-button v-if="scope.row.status == 0" type="warning" size="small">待支付</el-button>
        <el-button v-if="scope.row.status == 2" size="small">已完成</el-button>
      </template>
    </el-table-column>
  </el-table>
</div>
  
</template>
<script>
export default {
  data() {
    return {
      productType: {
        gszc: '公司注册及记账报税',
        zscq: '海外商标及专利申请',
        upc: 'UPC',
        vat: 'VAT',
        kjsk: '跨境收款工具',
        tpps: '专业跨境产品拍图',
        kjfy: '专业跨境翻译服务',
        // yygj: '跨境电商运营工具',
        // hwpc: '海外评测资源',
        // vps: 'VPS网络支持',
        ppjz: '品牌建站',
        yyzc: '跨境运营支持'
      },

      orderStatus: {
        '-1': '全部',
        0: '待支付',
        1: '等待处理',
        2: '已处理'
      },
      type: 'gszc',
      status: '1',
      tableData: []


    }
  },
  computed: {},
  mounted() {
    this.getData()
  },
  attached() {},
  methods: {
    getData() {
      /* eslint-disable */
       this.$rqt.post('/hhbb/getOrder', {
        status:this.status,
        type:this.type
       }).success((res) => {
          this.tableData = res.data;
      })
    },
    handleChangeGetType(res){
      this.type = res;
      this.getData();
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
      this.$rqt.post('/hhbb/finishOrder', {
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
