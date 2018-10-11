<template>
  <div class="admin-common-head">
    <el-menu class="head-menu">

    </el-menu>
  </div>
</template>
<script>
  /*
  @ type: component
  @ 引用处:
  @   view:admin
   */
  import common from '@/components/common'


  export default {
    extends:common,
    name: 'headhead',
    data:function(){
      return {
        show_login:false,
        show_signin:false,
      }
    },
    methods:{
      showLogin:showLogin,
      logOut:logOut,
    },
    components:{

    },
  }

  //显示登陆框
  function showLogin() {

  }


  function logOut() {

  }


</script>
<style lang="scss" scoped>
  .admin-common-head{
    .head-menu{
      height: 60px;
      background: white;
      border-bottom: 2px solid #e6e6e6;
    }
  }
</style>

