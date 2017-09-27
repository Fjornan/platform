<template>
  <div class="login-contain">
    <div class="login-logo">
      <!-- <img src="../assets/image/logo.png"> -->
      <span>鲸航跨境</span>
    </div>
    <div class="login-main">
      <div class="login-input">
        <input v-model="username" type="text" name="" placeholder="Username">
        <input v-model="password" type="password" name="" placeholder="Password">
        <a class="login-button" @click="loginSubmit">登 录</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: '',
      password: ''
    }
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
    loginSubmit () {
      this.$rqt.post('/passport/login', {
          username:this.username,
          password:this.password
       }).success((res) => {
          if(res.error == 0){
            console.log(res.data)
            this.$auth.login({
              token: res.data
            })
            this.$router.push('/user')
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
html{
  height: 100%
}
body{
  height: 100%
}
.login-contain{
  height: 100%;
  width: 100%;
  background-size: cover;
  background-image: url(../../../static/img/bg.jpg);
  text-align: center;
  -webkit-transition: all ease-in-out 0.4s !important;
  transition: all ease-in-out 0.4s !important;
}
.login-back{
  z-index: -1;
  width: 100%;
  height: 100%;
  left: 0;
  right: 0;
  position: absolute;
}
.login-content{
  position: absolute;
  left: 0;
  right: 0;
}
.login-logo{
  padding-top: 8%;
  padding-bottom: 20px;
}
.login-logo span{
  color: #fff;
  font-size: 24px;
}
.login-logo img{
  width: 100px;
  position: relative;
  top: 3px;
}
.login-main{
  margin: auto;
  width: 400px;
  border-radius: 5px;
  background-color: #fff;
  box-shadow: 0px 0px 8px #444;
  padding:10px;
}
.login-input{
  padding: 5px 30px 10px;
}
.login-main input{
  width: 100%;
  height: 30px;
  margin-top: 30px;
  border:none;
  border-bottom: 1px #ccc solid;
  color: #666;
  font-size: 14px;
}
.login-main input:focus{
  outline: none;
  border-bottom-color:#20a0ff;
}
.login-prompt{
  position: absolute;
  font-size: 10px;
  color: #ff4949
}
.get-code-button{
  font-size: 14px;
  width: 250px;
  padding: 7px 5px 5px;
  margin-top: 10px;
  background-color: #20a0ff;
  color: #fff;
  border-radius: 20px;
}
.login-button{
  padding: 10px 50px;
  background-color: #1fb5fc;
  border-radius: 20px;
  color: #fff;
  display: block;
  margin: 40px 20px 20px;
}
.login-button:hover{
  background-color: #0ba1e8;
  cursor: pointer;
}
.login-bottom a{
  color: #1fb5fc !important;
  font-size: 14px;
}
.login-bottom a:hover{
  color: #0ba1e8 !important;
}
</style>
