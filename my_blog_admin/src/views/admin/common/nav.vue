<template>
  <div class="admin-common-nav">
    <el-menu class="nav-menu"
             @open="group_open"
             @close="group_close"
             @select="item_select"
             v-bind:router="true">
      <el-submenu index="1">
        <template slot="title">菜单一</template>
        <el-menu-item index="1-1" v-bind:route="{ path:'/admin/mqtt/id_list'}">选项1</el-menu-item>
        <el-menu-item index="1-2" v-bind:route="{ path:'/admin/mqtt/active_client'}">选项2</el-menu-item>
      </el-submenu>
      <el-submenu index="2">
        <template slot="title">菜单二</template>
        <el-menu-item index="2-1">选项1</el-menu-item>
        <el-menu-item index="2-2">选项2</el-menu-item>
      </el-submenu>
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
    name: 'navnav',
    data:function(){
      return {

      }
    },
    methods:{
      group_open:group_open,
      group_close:group_close,
      item_select:item_select,
    },
    components:{

    },
  }

//组按钮打开回调
function group_open(index,index_path) {

}

//组关闭打开事件
function group_close(index,index_path) {

}

//item选择事件
function item_select(index,index_path) {

}


</script>
<style lang="scss" scoped>
  .admin-common-nav{
    margin-top: 2px;
    border-right: 2px solid #e6e6e6;
    min-height: 1000px;

    .nav-menu{
      .el-submenu{
        border-bottom: 1px solid #e6e6e6;
      }
      .is-opened{
        background: #e6e6e6;

        .is-active{
          color:white;
          background: #888;
        }
      }
    }
  }
</style>

