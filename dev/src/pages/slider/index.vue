<template lang="html">
<div class="p2222">
  <div class="row p2020 m0020 bor-bottom pos-re"> 
      <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/slider' }">幻灯片列表</el-breadcrumb-item>
    </el-breadcrumb>
    
    <div class="bread-btn">
      <router-link :to="{path: '/slider/add'}" >
      <el-button icon="plus" type="primary" size="small">添加</el-button>
      </router-link>
    </div>
      
  </div>
  <div class="p0020">
    <el-col class="p2222" :span="8" v-for="item in sliderList">
      <el-card>
        <img class="p0010" style="width:100%" :src="'http://pic02.keyinong.com/'+item.pic">
        <div class="row bor-top p2000">
          <div class="fl">
            <el-switch
              v-model="item.display"
              on-color="#13ce66"
              off-color="#ff4949"
              @change="handleSwitch(item)"
              >
            </el-switch>
            <!-- <el-select style="width:100px" size="small" v-model="item.display" placeholder="请选择" :change="handleSwitch(item)">

              <el-option
                v-for="(item,key) in displayType"
                :label="item"
                :value="key">
              </el-option>
            </el-select> -->
          </div>
          <div class="fr tr">
            <router-link :to="{path: '/slider/edit/'+item.id}">
              <el-button size="small">编辑</el-button>
            </router-link>
            
            <el-button size="small" type="danger" @click="deleteConfirm(item.id)">删除</el-button>
          </div>
        </div>
        
      </el-card>
    </el-col>
  </div> 
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
      sliderList: [],
      value2: true,
      currentID: null
    }
  },
  computed: {},
  mounted() {
    this.getSlider()
  },
  attached() {},
  methods: {
    getSlider() {
      /* eslint-disable */
      var that = this
      this.$rqt.post('/slider/get_list', {
        
      }).success((res,xhr) => {
        var arr = res.data.slider
        arr.forEach((item)=>{
          item.display = (item.display == 1?true:false);
          that.sliderList.push(item)
        })
        that.sliderList = arr
      })
    },
    handleSwitch(item){
      var update = item
      update.display = item.display===true?0:1;
      this.$rqt.post('/slider/save', update).success((res) => {
          this.$message({
            message: res.msg,
            type: 'success'
          });
      })
    },
    deleteConfirm(id){
      var that = this;
      this.currentID = id;
      this.$confirm('此操作将永久删除该幻灯片, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        that.deleteSubmit(id)
      }).catch((res) => {
        console.log(res)   
      });
    },
    deleteSubmit(id){
      this.$rqt.post('/slider/delete', {
        id:id
      }).success((res,xhr) => {
        this.getSlider();
        this.$message({
            message: res.msg,
            type: 'success'
        });
      })
    }
  },
  components: {}
}
</script>

<style lang="css">
</style>
