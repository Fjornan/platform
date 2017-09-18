<template lang="html">
<div class="p3333">
  <table border="1px" cellpadding="0" cellspacing="0" class="price-table" v-html="data.table">
      
  </table>
  
</div>
</template>
<script>
export default {
  data() {
    return {
      data: []
    }
  },
  computed: {},
  mounted() {
    this.getDetail()
  },
  attached() {},
  methods: {
    getDetail() {
      const that = this
      /* eslint-disable */
      this.$rqt.post('/hzzs/get_by_id', {
        id:this.$route.params.id
      }).success((res) => {
        that.data = res.data.hzzs
        console.log(that.data.table)
      })
    }
  },
  components: {}
}
</script>

<style lang="css">
.price-table{
  border-collapse:collapse;
}
.price-table caption{
  font-size: 22px;
}
.price-table td{
  padding:10px 5px;
  border:1px solid #e1e1e1;
}
.price-table tr:nth-child(odd){
  background-color: #f7f7f7
}
</style>
