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

  },
  attached() {},
  methods: {
    ajax() {
      /* eslint-disable */
      console.log('test')
      this.$api.post('/', {}).success(() => {

      })
    },
    test() {
      /* eslint-disable */
      console.log('test')
      console.log('hello')
    }
  },
  components: {}
}
</script>

<style lang="css">
</style>
