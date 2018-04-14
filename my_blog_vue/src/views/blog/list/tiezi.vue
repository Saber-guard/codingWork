<template>
<div class="blog-list-article"
     @mouseenter="showStatus(article)"
     @mouseleave="hiddenStatus(article)">
    <div class="content">
        <div class="pic">
            <img draggable="false" v-bind:src="article.a_pic">
        </div>
      <div class="describe">&nbsp;&nbsp;<router-link :to="'/blog/article/'+article.a_id" v-text="article.a_describe"></router-link></div>
        <div class="title"><router-link :to="'/blog/article/'+article.a_id" v-text="article.a_title"></router-link></div>
    </div>
    <ul class="status" v-bind:class="{on:article.select}">
        <li><a href="#"><i class="fa fa-thumbs-o-down"></i>123</a></li>
        <li><a href="#"><i class="fa fa-thumbs-o-up"></i>123</a></li>
        <li><a href="#"><i class="fa fa-eye"></i>123</a></li>
    </ul>
</div>
</template>
<script>
/*
@ type: component
@ 引用处:
@   view:blog-list
 */
import common from '@/components/common'

export default {
	extends:common,
	name: 'tiezi',
    props: ['article'],
    data:function(){
        return {

        }
    },
	methods:{
        showStatus:function shouStatus(article){
            this.$Vue.set(article,'select',true);
        },
        hiddenStatus:function hiddenStatus(article){
            this.$Vue.set(article,'select',false);
        }
	},
}

</script>
<style lang="scss" scoped>
.blog-list-article{
  width:600px;
  background: #fff;
  margin-bottom:20px;
  box-shadow: #999 3px 4px 6px;
  position:relative;
  border-radius:1px;
  background-image:url(/static/images/fangge.jpg);
  transition:box-shadow 0.5s;
  -webkit-transition:box-shadow 0.5s;
  .content{
    height:290px;
    .pic{width:596px;height:210px;overflow:hidden;border:#fff 2px solid;border-radius:1px;}
    .describe{
      width:560px;
      height:66px;
      padding:2px 20px;
      overflow: hidden;
      a{font-size: 13px;line-height:23px;color:#3F3E3C;}
      a:hover{color:#000;}
    }
    .title{
      width:560px;
      padding:2px 20px;
      position:relative;
      top:-106px;
      a{font-size: 18px;font-weight:bold;color:#fff;line-height:23px;}
      a:hover{color:#000;text-shadow: 0px 0px 6px #fff;}
    }
  }

  .status{
    height:0px;
    background:#3C3C3C;
    border-top:solid 3px #8E6D56;
    border-bottom:solid 1px #ddd;
    transition: height 0.5s;
    -webkit-transition: height 0.5s;
    overflow:hidden;
    li{
      float:right;
      height:26px;
      padding: 0px 10px;
      a{font-weight:bold;font-size:13px;color:#8E6D56;line-height:24px;}
      a:hover{color:#bbb;}
      i{color:#bbb;margin:0px 6px;font-size:14px;line-height:24px;}
    }
  }
  .status.on{height:26px;}
}
.blog-list-article:hover{box-shadow: #777 8px 9px 6px;}


</style>

