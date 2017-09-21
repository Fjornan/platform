<template lang="html">
  <div id="main-header">
    <div id="logo">
      鲸航跨境
    </div>
    <div id="main-menu" >
      <el-menu style="float:right" theme="dark"  class="el-menu-demo" mode="horizontal" @select="handleSelect">

        <el-submenu index="2">
          <template slot="title">我的工作台</template>
          <el-menu-item index="2-1" @click="logout">退出登录</el-menu-item>
        </el-submenu>
      </el-menu>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {

    }
  },
  computed: {},
  ready() {},
  attached() {},
  methods: {
    handleSelect(key, keyPath) {
      /* eslint-disable */
      console.log(key, keyPath)
    },
    logout() {
      this.$auth.logout()
      this.$router.push('/passport/login')
      // this.$rqt.post('/index_admin/login', {}).success((res) => {
      //   if (res.code === '0') {
      //     this.$router.push('/passport/login')
      //   }
      // })
    }
  },
  components: {}
}
</script>
<style type="less">
#main-header{
  position: relative;
  padding-left: 180px;
}
#logo{
  width: 180px;
  position: absolute;
  top:0;
  left:0;
  height: 60px;
  color:#fff;
  background-color:#1F2D3D;
  line-height: 60px;
  text-align: center;
}
#main-menu{

}
.el-menu{
  border-radius: 0px !important;
}
</style>
