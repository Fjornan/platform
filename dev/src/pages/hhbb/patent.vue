<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom pos-re">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/hhbb/patent' }">专利及项目申报</el-breadcrumb-item>
    </el-breadcrumb>
    <!-- <div class="bread-btn">
      <router-link :to="{path: '/user/add'}" >
      <el-button icon="plus" type="primary" size="small">添加</el-button>
      </router-link>
    </div> -->
  </div>

  <el-select class="m0020" style="width:200px" v-model="status" size="small" placeholder="请选择分类" @change="handleChangeGetStatus">
    <el-option
      v-for="(item,key) in orderStatus"
      :label="item"
      :value="key">
    </el-option>
  </el-select>

  <el-table :data="tableData" stripe style="width: 100%;text-align:left">
    <el-table-column prop="name" label="会员姓名" width="120"></el-table-column>
    <el-table-column prop="note" label="申报说明"></el-table-column>
    <el-table-column prop="phone" label="联系方式" width="120"></el-table-column>
    <el-table-column prop="create_time" label="提交时间" width="120"></el-table-column>
    <el-table-column label="操作" width="100">
      <template scope="scope">
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
       this.$rqt.post('/hhbb/getPatent', {
        status:this.status
       }).success((res) => {
          this.tableData = res.data;
      })
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
      this.$rqt.post('/hhbb/finishPatent', {
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
