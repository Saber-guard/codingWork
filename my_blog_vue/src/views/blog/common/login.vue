<template>
  <div class="blog-common-login">
    <el-dialog title="账号登陆"
               :visible.sync="show_login"
               width="350px"
               :close-on-press-escape="false"
               :close-on-click-modal="false">
      <el-form :model="login_param" class="login-form">
        <el-form-item >
          <el-input v-model="login_param.account"></el-input>
        </el-form-item>
        <el-form-item >
        <el-input type="password" v-model="login_param.pwd"></el-input>
      </el-form-item>

        <el-button type="primary" @click="login" class="login-btn">登陆</el-button>
      </el-form>
      <div slot="footer" class="dialog-footer">

      </div>
    </el-dialog>
  </div>
</template>
<script>
  /*
  @ type: component
  @ 引用处:
  @   view:blog
   */
  import common from '@/components/common'

  export default {
    extends:common,
    name: 'login',
    data:function(){
      return {
        show_login:false,
        login_param:{
          account:'',
          pwd:'',
        },
      }
    },
    methods:{
      showBox:showBox,
      login:login,
    },
  }
  //显示登陆框
  function showBox(status){
    this.show_login = status
  }

  // 登录
  function login()
  {
    this.$axios({
      method:"post",
      url:'user/access',
      data:this.login_param,
    }).then(function(response){
      if (response.data.errno == 0) {
        //保存用户信息
        this.$cookie.setCookie('user_info',response.data.data)
        //也存到store里
        this.$store.commit('login')
        //关闭窗口
        this.showBox(false)

      } else {
        this.$message({
          message: response.data.info,
          type: 'warning'
        });

      }



    }.bind(this))
  }

</script>
<style lang="scss" scoped>
  .blog-common-login {
    form.login-form{
      padding: 0px 35px;
      .login-btn{width:100%;}
    }
  }

</style>

