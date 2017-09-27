<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom pos-re">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/recruit' }">岗位列表</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="bread-btn">
      <router-link :to="{path: '/recruit/add'}" >
      <el-button icon="plus" type="primary" size="small">添加</el-button>
      </router-link>
    </div>
  </div>

  <el-table :data="recruit" stripe style="width: 100%;text-align:left">
    <el-table-column prop="name" label="岗位名称" width="150"></el-table-column>
    <el-table-column prop="require" label="岗位需求"></el-table-column>
    <el-table-column prop="treatment" label="岗位待遇"></el-table-column>
    <el-table-column prop="display" label="官网显示" width="100">
      <template scope="scope">
        <span>{{ displayType[scope.row.display] }}</span>
      </template>
    </el-table-column>
    <el-table-column label="操作" width="180">
      <template scope="scope">
        <router-link :to="{path: '/recruit/edit/'+scope.row.id}">
          <el-button size="small">编辑</el-button>
        </router-link>
        <el-button type="danger" size="small" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
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
      recruit: []

    }
  },
  computed: {},
  mounted() {
    this.getRecruit()
  },
  attached() {},
  methods: {
    getRecruit() {
      /* eslint-disable */
       this.$rqt.post('/recruit/get_list', {
         
       }).success((res) => {
          this.recruit = res.data.list;
      })
    },
    handleDelete(index,row){
      var that = this;
      this.$confirm('此操作将永久删除该岗位, 是否继续?', '提示', {
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
          this.getRecruit();
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
