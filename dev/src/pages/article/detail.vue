<template lang="html">
<div class="p2222" style="height:100%">
  <div class="p2020 m0020 bor-bottom">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/article' }">文章列表</el-breadcrumb-item>
      <el-breadcrumb-item >文章详情</el-breadcrumb-item>
    </el-breadcrumb>
  </div>
  <div id="article" style="height:100%">
    <!-- <iframe :src="detail.url" style="width:100%;height:100%;border:0;"></iframe> -->
    <div v-html="detail.content"></div>
  </div>
</div>

  
</template>
<script>
export default {
  data() {
    return {
      displayType: {

      },
      articleType: {
        0: '未分类',
        1: '公司新闻',
        2: '品牌活动',
        3: '每周学生营养餐菜单',
        4: '对外招标信息'
      },
      detail: [],
      total: 0
    }
  },
  computed: {},
  mounted() {
    this.getArticle()
  },
  attached() {},
  methods: {
    getArticle() {
      /* eslint-disable */
      var id = this.$route.params.id
       this.$rqt.post('/article/get_article_by_id', {
        id:id
       }).success((res) => {
          this.detail = res.data.detail;
          // this.total = res.data.total;
          console.log(this.detail.content)
          var imgarr = $('#article img')

          for(var i=0;i<imgarr.length;i++){
            var url = imgarr.eq(i).attr('data-src');
            imgarr.eq(i).attr('src',url)
          }
          // this.getDetail(this.detail.url)
      })
    },
    getDetail (url){
      var that = this
      $.ajax({
         type: "GET",
         url: url,
         headers: { 'Access-Control-Allow-Origin': '*' },
         data: {},
         dataType: "json",
         success: function(data){
           console.log(data)
        }
      });
    },
    handleEdit(index, row) {
      console.log(index, row);
    },
    handleDelete(index, row) {
      console.log(index, row);
    }
  },
  components: {}
}
</script>

<style lang="css">
</style>
