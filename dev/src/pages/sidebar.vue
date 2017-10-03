<template lang="html">
  <!-- <el-menu :default-active="this.$route.path" class="el-menu-vertical-demo" :router="true">
    <el-menu-item index="/slider"><i class="el-icon-picture"></i>幻灯片管理</el-menu-item>
    <el-menu-item index="/article"><i class="el-icon-document"></i>文章管理</el-menu-item>
    <el-menu-item index="/recruit"><i class="el-icon-view"></i>招聘管理</el-menu-item>
    <el-menu-item index="/price"><i class="el-icon-date"></i>菜价管理</el-menu-item>
    
    
  </el-menu> -->
  <el-menu default-active="this.$route.path" class="el-menu-vertical-demo" :router="true">
    <el-menu-item index="/user"><i class="el-icon-star-on"></i>鲸航Vip</el-menu-item>
    <el-submenu index="1">
      <template slot="title"><i class="el-icon-upload"></i>开店通道</template>
        <el-menu-item index="/shop/amazon">亚马逊</el-menu-item>
    </el-submenu>
    <el-submenu index="2">
      <template slot="title"><i class="el-icon-upload"></i>海航必备</template>
        <el-menu-item index="/hhbb/order">客户订单</el-menu-item>
        <el-menu-item index="/hhbb/patent">专利申请</el-menu-item>
        <el-menu-item index="/hhbb/product">产品设置</el-menu-item>
    </el-submenu>
    <el-submenu index="3">
      <template slot="title"><i class="el-icon-share"></i>跨境物流</template>
        <el-menu-item index="/logistics/amazon">亚马逊FBA</el-menu-item>
        <el-menu-item index="/logistics/warehouse">海外仓</el-menu-item>
    </el-submenu>
    <el-submenu index="4">
      <template slot="title"><i class="el-icon-message"></i>鲸航联盟</template>
        <el-menu-item index="/union/seekgoods">我要找货源</el-menu-item>
        <el-menu-item index="/union/hasgoods">我有好货源</el-menu-item>
        <el-menu-item index="/union/apply">自荐</el-menu-item>
        <el-menu-item index="/union/recruit">求才</el-menu-item>
        <el-menu-item index="/union/activity">活动报名</el-menu-item>
        <el-menu-item index="/union/operate">联合运营</el-menu-item>
    </el-submenu>
    <el-submenu index="5">
      <template slot="title"><i class="el-icon-picture"></i>鲸航学院</template>
        <el-menu-item index="/school/amaqa">亚马逊答疑</el-menu-item>
        <el-menu-item index="/school/amanewapply">AMZ开店指导</el-menu-item>
    </el-submenu>
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
