<template>
  <div class="admin">
    <el-container class="box">
      <el-header>
        <headhead v-if="hasHead"></headhead>
      </el-header>
      <el-container class="body">
        <el-aside width="200px">
          <navnav></navnav>
        </el-aside>
        <el-main>
          <router-view />
        </el-main>
      </el-container>
    </el-container>
  </div>
</template>
<script>
  /*
  @ type: view
   */
  import common from '@/components/common'
  import head from '@/views/admin/common/head'
  import nav from '@/views/admin/common/nav'

  export default {
    extends:common,
    name: 'admin',
    data:function(){
      return {
        hasHead:true,
      }
    },
    methods:{

    },
    components:{
      headhead:head,
      navnav:nav,

    },
  }

</script>
<style lang="scss" scoped>
.admin{
  .box{
    .el-header{
      padding:0px;
    }
    .body{
    }
  }
}
</style>

