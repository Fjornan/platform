<template lang="html">
<div class="">
  <div class="ad-layout-header ad-header-fixed">
    <mainheader />
  </div>
  <div class="ad-layout-sidebar ad-sidebar-fixed">
    <sidebar />
  </div>

  <div class="ad-layout-content">
    <router-view />
  </div>
</div>

</template>

<script>
import sidebar from './sidebar'
import mainheader from './header'

export default {
  data() {
    return {}
  },
  computed: {},
  mounted() {
    this.judge()
  },
  attached() {},
  methods: {
    judge() {
      const token = this.$auth.getData('token')
      if (token == null || token === '' || token === undefined) {
        this.$message.info('登录失效，请重新登录')
        this.$router.push('/passport/login')
      }
    }
  },
  components: {
    sidebar,
    mainheader
  }
}
</script>
