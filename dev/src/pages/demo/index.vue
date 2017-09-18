<template lang="html">
<p>hello</p>
</template>

<script>
export default {
  data() {
    return {}
  },
  computed: {},
  mounted() {
    this.test()
  },
  attached() {},
  methods: {
    ajax() {
      /* eslint-disable */
      this.$api.post('/', {}).success(() => {

      })
    },
    test() {
      /* eslint-disable */
      console.log('test')
    }
  },
  components: {}
}
</script>

<style lang="css">
</style>
