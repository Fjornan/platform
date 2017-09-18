<template lang="html">
<div class="p2222">
  <div class="p2020 m0020 bor-bottom pos-re">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/article' }">文章列表</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="bread-btn">
      <router-link :to="{path: '/article/add'}" >
      <el-button icon="plus" type="primary" size="small">添加</el-button>
      </router-link>
    </div>
  </div>
  
  <el-select class="m0020" style="width:130px" v-model="type" size="small" placeholder="请选择分类" @change="handleChangeGetType">
    <el-option label="全部分类" value="-1"></el-option>
    <el-option
      v-for="(item,key) in articleType"
      :label="item"
      :value="key">
    </el-option>
  </el-select>

  <el-select class="m0020" style="width:130px" v-model="source" size="small" placeholder="请选择来源" @change="handleChangeGetSource">
    <el-option label="全部来源" value="-1"></el-option>
    <el-option
      v-for="(item,key) in sourceType"
      :label="item"
      :value="key">
    </el-option>
  </el-select>

  <el-select class="m0020" style="width:130px" v-model="display" size="small" placeholder="请选择显示状态" @change="handleChangeGetDisplay">
    <el-option label="全部显示状态" value="-1"></el-option>
    <el-option
      v-for="(item,key) in displayType"
      :label="item"
      :value="key">
    </el-option>
  </el-select>

  <el-table :data="articles" stripe style="width: 100%;text-align:left">
    <el-table-column prop="title" label="标题"></el-table-column>
    <el-table-column prop="digest" label="摘要"></el-table-column>
    <!-- <el-table-column prop="author" label="作者" width="100"></el-table-column> -->
    <el-table-column prop="type" label="分类" width="170">
      <template scope="scope">
        <el-select class="m0020" style="width:150px;display:inline" v-model="scope.row.type" size="small" placeholder="请选择文章分类" @change="handleType(scope.row)">
          <el-option
            v-for="(item,key) in articleType"
            :label="item"
            :value="key">
          </el-option>
        </el-select>
      </template>
    </el-table-column>
    <el-table-column prop="display" label="首页显示" width="100">
      <template scope="scope">
        <el-switch
          v-model="scope.row.display"
          on-color="#13ce66"
          off-color="#ff4949"
          on-text="是"
          off-text="否"
          @change="handleSwitch(scope.row)"
          >
        </el-switch>
        <!-- <span>{{ displayType[scope.row.display] }}</span> -->
      </template>
    </el-table-column>
    
    <el-table-column prop="create_date" label="发布日期" width="170"></el-table-column>
    <el-table-column label="操作" width="150">
      <template scope="scope">
        <router-link v-if="scope.row.source == 1" :to="{path: '/article/edit/'+scope.row.id}" style="margin-right:10px">
          <el-button size="small">编辑</el-button>
        </router-link>
        <el-button v-else size="small" @click="handleDetail(scope.$index, scope.row)">预览</el-button>
        <!-- <el-button type="primary" size="small" @click="handleType(scope.$index, scope.row)">更改分类</el-button> -->
        <!-- <el-button type="primary" size="small" @click="handleDisplay(scope.$index, scope.row)">更改显示</el-button> -->
        <el-button type="danger" size="small" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
      </template>
    </el-table-column>
  </el-table>
  <el-pagination
      layout="prev, pager, next,jumper"
      :total="total" class="m2020"  @current-change="handleCurrentChange"  :current-page="currentpage" :page-size="page">
  </el-pagination>


  <!-- <el-dialog title="更改文章类型" size="tiny" v-model="dialogChangeType">
    <el-form label-width="80px">
      <el-form-item label="文章类型">
        <el-select v-model="typeValue" placeholder="请选择文章类型">
          <el-option
            v-for="(key,item) in articleType"
            :label="key"
            :value="item">
          </el-option>
        </el-select>
      </el-form-item>
    </el-form>
    <div slot="footer" class="dialog-footer">
      <el-button @click="dialogChangeType = false">取 消</el-button>
      <el-button type="primary" @click="changeType">确 定</el-button>
    </div>
  </el-dialog>

  <el-dialog title="更改文章显示" size="tiny" v-model="dialogChangeDisplay">
    <el-form label-width="80px">
      <el-form-item label="首页显示">
        <el-select v-model="displayValue" placeholder="请选择首页是否显示">
          <el-option
            v-for="(key,item) in displayType"
            :label="key"
            :value="item">
          </el-option>
        </el-select>
      </el-form-item>
    </el-form>
    <div slot="footer" class="dialog-footer">
      <el-button @click="dialogChangeDisplay = false">取 消</el-button>
      <el-button type="primary" @click="changeDisplay">确 定</el-button>
    </div>
  </el-dialog> -->
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
      articleType: {
        0: '未分类',
        1: '公司新闻',
        2: '品牌活动',
        3: '每周学生营养餐菜单',
        4: '对外招标信息'
      },
      sourceType: {
        0: '微信',
        1: '站内编写'
      },
      articles: [],
      dialogChangeType: false,
      dialogChangeDisplay: false,
      typeValue: '',
      displayValue: '',
      currentID: '',

      source: '-1',
      type: '-1',
      display: '-1',
      page: 10,
      offset: 0,
      total: 0,
      currentpage: 1,
      changepage: false
    }
  },
  computed: {},
  mounted() {
    this.getArticle(true)
  },
  attached() {},
  methods: {
    getArticle(refresh) {
      /* eslint-disable */
      this.changepage = true
      var that = this
      if(refresh){
        this.offset = 0;
        this.currentpage =1
      }
       this.$rqt.post('/article/get_article_list', {
          page:this.page,
          offset:this.offset,
          type:this.type || -1,
          source:this.source || -1,
          display:this.display || -1,
       }).success((res) => {
          var arr = []
          res.data.articles.forEach((item)=>{
            item.display = (item.display == 1?true:false);
            arr.push(item)
          })
          this.articles = arr;
          this.total = res.data.total;
          setTimeout(function(){
            that.changepage = false
          },300)
          
          // console.log(this.articles)
      })
    },
    handleCurrentChange(val){
      
      this.offset = this.page*(val-1)
      this.getArticle();
      this.currentpage = val
    },
    handleSwitch(item){
      console.log(item)
      this.displayValue = item.display ===true ? '0':'1';
      this.currentID = item.id;
      this.changeDisplay();
    },
    handleChangeGetType(res){
      this.type = res;
      this.getArticle(true);
    },
    handleChangeGetSource(res){
      this.source = res;
      this.getArticle(true);
    },
    handleChangeGetDisplay(res){
      this.display = res;
      this.getArticle(true);
    },
    handleDetail(index, row) {
      console.log(index, row);
      var url = row.url;
      window.open(url)
    },
    handleType(row) {
      if(!this.changepage){
        console.log(row);
        this.typeValue = row.type;
        this.currentID = row.id;
        this.changeType();
      }
      
      
    },
    // handleDisplay(index, row) {
    //   console.log(index, row);
    //   this.displayValue = row.display;
    //   this.currentID = row.id;
    //   this.dialogChangeDisplay = true;
    // },
    handleDelete(index,row){
      var that = this;
      this.$confirm('此操作将永久删除该文章, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        that.deleteSubmit(row.id)
      }).catch((res) => {
        console.log(res)   
      });
    },
    changeType(){
      this.$rqt.post('/article/change_type', {
        type:this.typeValue,
        id:this.currentID
       }).success((res) => {
          this.$message({
            message: res.msg,
            type: 'success'
          });
          // this.dialogChangeType = false
          // this.getArticle()
      })
    },
    changeDisplay(){
      this.$rqt.post('/article/change_display', {
        display:this.displayValue,
        id:this.currentID
       }).success((res) => {
          this.$message({
            message: res.msg,
            type: 'success'
          });
          // this.dialogChangeDisplay = false
          // this.getArticle()
      })
    },
    deleteSubmit(id){
      this.$rqt.post('/article/delete', {
        id:id
      }).success((res,xhr) => {
        if(res.code){
          this.getArticle();
          this.$message({
              message: res.msg,
              type: 'success'
          });
        }else{
          this.$message({
              message: res.msg,
              type: 'info'
          });
        }
        
      })
    }
  },
  components: {}
}
</script>

<style lang="css">
</style>
