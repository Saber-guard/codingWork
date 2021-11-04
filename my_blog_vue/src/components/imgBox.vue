<template>
  <img :src="final_src"/>
</template>
<script>
import common from '@/components/common'

/*
* 图片包装组件，配合mqtt长连接对图片访问进行控制
* 对外接口：
* src:图片地址，连接mqtt后展示
* default_src:默认图片地址，连接mqtt前展示
* */
export default {
  extends:common,
  name: 'imgBox',
  created: function(){
  },
  props:{
    src:{
      default:'',
    },
    default_src:{
      default:'',
    }
  },
  data:function(){
    return {
    }
  },
  computed:{
    final_src:function(){
      return this.src;
    },
  },
}

</script>
<style lang="scss" scoped>

</style>

