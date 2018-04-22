<template>
 <div class="blog-list">
<div class="left">
    <leftAside></leftAside>
    <div class="clear"></div>
</div>
<div class="right">
    <div class="shutiao"></div>
    <headLine></headLine>
    <div class="blogitems">
        <tiezi v-for="article in articles"
               :article="article"
               :key="article.id"></tiezi>
    </div>
</div>
<div class="clear"></div>
 </div>
</template>
<script>
/*
@ type: view
 */
import common from '@/components/common'
import tiezi from './tiezi'
import headLine from '../common/headLine'
import leftAside from '../common/leftAside'

export default {
	  extends:common,
	  name: 'list',
    created:function() {
      //打开动画
      this.$parent.openAnimation(true)
      //获取栏目信息
      this.$axios({
        method:"get",
        url:'cms/article_list',
        params:{
          "c_id":this.$route.params['id'],
          "select":"title,id,describe,pic,clicks",
          "size":10,
        }
      }).then(function (response) {
        this.articles = response.data.data
      }.bind(this))
    },
    mounted:function()
    {
        this.initStyle();
    },
    data:function(){
        return {
            articles:[],
        }
    },
    methods:{
          //初始化一些样式
          initStyle:function initStyle(){
              $('.blog-list > .left').css('height',$('.blog-list > .right').css('height'));
              $('.right > div.shutiao').css('height',$('html').css('height'));
          },
    },
    components:{
        tiezi:tiezi,
        headLine:headLine,
        leftAside:leftAside,
    }
}

</script>
<style lang="scss" scoped>
.blog-list {
  min-width: 1100px;
  background: #DDD6CC;
  width: 100%;
  margin: 20px auto 0px;
  >.left{min-width: 270px;width:33%;float:left;position:relative;height:100%;}
  >.right{
    min-width: 730px;
    width:66%;
    min-height:800px;
    float:right;
    position:relative;
    >div.shutiao{height:120%;width:8px;background:#bababa;position:absolute;left:90%;top:-63px;}
    .blogitems { width: 730px;margin-top: 60px;}
  }
}




</style>

