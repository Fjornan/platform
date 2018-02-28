<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom pos-re">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/hhbb/product' }">产品列表</el-breadcrumb-item>
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

  <el-table :data="product" stripe style="width: 100%;text-align:left">
    <el-table-column prop="name" label="名称"></el-table-column>
    <el-table-column prop="sub_name" label="备注"></el-table-column>
    <el-table-column prop="price" label="价格"></el-table-column>
    <el-table-column prop="unit" label="单位"></el-table-column>
<!--     <el-table-column prop="display" label="" width="100">
      <template scope="scope">
        <span>{{ displayType[scope.row.display] }}</span>
      </template>
    </el-table-column> -->
    <el-table-column label="操作" width="100">
      <template scope="scope">
        <router-link :to="{path: '/hhbb/proedit/'+scope.row.id}">
          <el-button size="small">编辑</el-button>
        </router-link>
        <!-- <el-button type="danger" size="small" @click="handleDelete(scope.$index, scope.row)">删除</el-button> -->
      </template>
    </el-table-column>
  </el-table>
</div>
  
</template>
<script>
export default {
  data() {
    return {
      displayType: {
        0: '不显示',
        1: '显示'
      },
      productType: {
        gszc: '跨境电商产品评测',
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
      type: 'gszc',
      product: []


    }
  },
  computed: {},
  mounted() {
    this.getProduct()
  },
  attached() {},
  methods: {
    getProduct() {
      /* eslint-disable */
       this.$rqt.post('/hhbb/getProduct', {
        type:this.type
       }).success((res) => {
          this.product = res.data;
      })
    },
    handleChangeGetType(res){
      this.type = res;
      this.getProduct();
    },
    handleDelete(index,row){
      var that = this;
      this.$confirm('此操作将永久删除该用户, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        that.deleteSubmit(row.id)
      }).catch((res) => {
        console.log(res)   
      });
    },
    deleteSubmit(id){
      this.$rqt.post('/recruit/delete', {
        id:id
      }).success((res,xhr) => {
        if(res.code){
          this.getUser();
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
