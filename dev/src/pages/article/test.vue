<template>
<div>
  <el-checkbox :indeterminate="isIndeterminate" v-model="checkAll" @change="handleCheckAllChange">全选</el-checkbox>
  <div style="margin: 15px 0;"></div>
  <el-checkbox-group v-model="checkedCities" @change="handleCheckedCitiesChange">
    <el-checkbox v-for="city in cities" :label="city">{{city}}</el-checkbox>
  </el-checkbox-group>
</div>
  
</template>
<script>
  const cityOptions = ['上海', '北京', '广州', '深圳']
  export default {
    data() {
      return {
        checkAll: true,
        checkedCities: ['上海', '北京'],
        cities: ['上海', '北京', '广州', '深圳'],
        isIndeterminate: true
      }
    },
    methods: {
      handleCheckAllChange(event) {
        this.checkedCities = event.target.checked ? cityOptions : []
        console.log(this.checkedCities)
        this.isIndeterminate = false
      },
      handleCheckedCitiesChange(value) {
        const checkedCount = value.length
        this.checkAll = checkedCount === this.cities.length
        this.isIndeterminate = checkedCount > 0 && checkedCount < this.cities.length
      }
    }
  }
</script>
