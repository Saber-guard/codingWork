<template>
  <div class="blog-common-signin">
    <el-dialog title="注册"
               :visible.sync="show_signin"
               width="350px"
               :close-on-press-escape="false"
               :close-on-click-modal="false">
      <el-form :model="signin_param" class="signin-form">
        <el-form-item >
          <el-input v-model="signin_param.u_account"></el-input>
        </el-form-item>
        <el-form-item >
          <el-input type="password" v-model="signin_param.u_pwd"></el-input>
        </el-form-item>

        <el-button type="primary" @click="signin" class="signin-btn">注册</el-button>
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
    name: 'signin',
    data:function(){
      return {
        show_signin:false,
        signin_param:{
          u_account:'',
          u_pwd:'',
        },
      }
    },
    methods:{
      showBox:showBox,
      signin:signin,
    },
  }
  //显示注册框
  function showBox(status){
    this.show_signin = status
  }
  //注册
  function signin() {
    this.$axios({
      method:"post",
      url:'user/user',
      data:this.signin_param,
    }).then(function(response){
      if (response.data.errno == 0) {
        this.$message({
          message: response.data.info,
          type: 'success'
        });
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
  .blog-common-signin {
    form.signin-form{
      padding: 0px 35px;
      .signin-btn{width:100%;}
    }
  }

</style>

