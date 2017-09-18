<template lang="html">
  <el-menu :default-active="this.$route.path" class="el-menu-vertical-demo" :router="true">
    <el-menu-item index="/slider"><i class="el-icon-picture"></i>幻灯片管理</el-menu-item>
    <el-menu-item index="/article"><i class="el-icon-document"></i>文章管理</el-menu-item>
    <el-menu-item index="/recruit"><i class="el-icon-view"></i>招聘管理</el-menu-item>
    <el-menu-item index="/price"><i class="el-icon-date"></i>菜价管理</el-menu-item>
    
    
  </el-menu>
</template>

<script>
export default {
  data() {
    return {}
  },
  computed: {},
  ready() {},
  attached() {},
  methods: {},
  components: {}
}
</script>
<style>
  
  .el-menu{
    text-align: left;
  }
</style>
