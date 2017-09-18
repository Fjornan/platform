<template lang="html">
<div class="p2222">
  <el-row>
    <el-col :span="20">
      <div class="tc p3000" v-if="detail==null">暂无数据</div>
      <table v-else border="1px" cellpadding="0" cellspacing="0" class="price-table" v-html="detail.table">
      </table>
    </el-col>
    <el-col class="p3000" :span="3" :offset="1">
      <el-table class="m0030" :data="priceList" style="width: 100%;text-align:left">
        <el-table-column prop="title" label="近期数据">
          <template scope="scope">
            <a class="cursor-pointer" @click="handleChoose(scope.row)">{{scope.row.date}}</a>
              
          </template>
        </el-table-column>
      </el-table>
      <div class="p0010">选择其他日期</div>
      <el-date-picker
        v-model="date"
        type="date"
        placeholder="选择日期"
        :picker-options="pickerOptions0" style="width:100%"
        @change="handlePicker"
        >
      </el-date-picker>
    </el-col>
  </el-row>
  

</div>
</template>
<script>
export default {
  data() {
    return {
      pickerOptions0: {
        disabledDate(time) {
          return time.getTime() > Date.now()
        }
      },
      priceList: [],
      detail: [],
      date: ''

    }
  },
  computed: {},
  mounted() {
    this.getLatest()
    this.getPrice()
  },
  attached() {},
  methods: {
    getPrice(refresh) {
      /* eslint-disable */
      if(refresh){
        this.offset = 0
      }
      this.$rqt.post('/hzzs/get_hzzs_list', {
        date:this.date,
      }).success((res) => {
        this.priceList = res.data.list
      })
    },
    getLatest() {
      this.$rqt.post('/hzzs/get_latest_hzzs', {
        
      }).success((res) => {
        this.detail = res.data.hzzs
      })
    },
    handleChoose (row){
      console.log(row)
      this.date = row.date
      this.getDetail()
    },
    handlePicker(val){
      this.date = val
      this.getDetail()
    },
    getDetail(){
      this.$rqt.post('/hzzs/get_by_date', {
        date:this.date
      }).success((res) => {
        this.detail = res.data.hzzs
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
  font-size: 20px;

}
.price-table td{
  padding:10px 5px;
  border:1px solid #e1e1e1;
}
.price-table tr:nth-child(odd){
  background-color: #f7f7f7
}
</style>
