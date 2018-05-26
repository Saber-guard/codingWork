<template>
<div class="blog-article-show" :class="{edit:mode==1}">
	<div class="nav">
		<div class="dir-line">
			<a href="#">首页</a>
			<i class="fa fa-angle-right"></i>
		</div>
		<div class="dir-line">
			<a href="#">PHP</a>
			<i class="fa fa-angle-right"></i>
		</div>
	</div>
	<div class="title">
		<span class="text" v-text="article.a_title"></span>
		<sub class="fa fa-edit" v-if="article.a_u_id && article.a_u_id==common_data.user_info.u_id"><a href="javascript:void(0);" @click="edit">编辑</a></sub>
	</div>
	<div class="status">
		<div v-text="article.a_datetime"></div>
		<!--<div v-text="'0赞'"></div>-->
		<div v-if="article.a_clicks" v-text="article.a_clicks+'查看'"></div>
	</div>
	<div class="show-markdown" v-html="render_text">
	</div>
</div>
</template>
<script>
/*
@ type: component
@ 引用处:
@   view:blog-article
 */
import common from '@/components/common'
import '@/assets/css/markdown.css'

export default {
	extends:common,
	name: 'show',
	props:['mode','article','render_text'],
    data:function(){
	      // console.log(this.render_text)
        return {

        }
    },
	methods:{
		edit:edit,
	},
}

//切换到编辑模式
function edit()
{
	this.$emit('switch-mode',1);
}

</script>
<style lang="scss" scoped>
.blog-article-show{
  width:70%;
  min-width:650px;
  min-height:800px;
  background:url(/static/images/fengelan.png) repeat-y #fff;
  border-right:4px solid #333;
  box-shadow: #444 2px 3px 6px;
  float:left;
  transition: width 0.1s;
  -webkit-transition: width 0.1s;
  .nav{
    height:30px;
    border-bottom:1.5px solid #555;
    margin:0px 20px;
    .dir-line{
      display:inline-block;
      font-family:微软雅黑;
      font-weight: bold;
      font-size:14px;
      line-height:35px;
      padding-left:5px;
    }
  }
  .dir-line{
    a{padding-right:5px;color:#8E6D56;}
    a:hover{text-decoration:underline;}
  }

  .title{
    /*max-width:1000px;*/
    margin:0px 60px;
    padding:16px 20px 5px;
    .text{font-family:幼圆;font-weight: bolder;font-size:35px;letter-spacing:2px;}
    sub{font-size:11px;font-weight: bold;color:#8E6D56;margin:0px 8px;}
  }

  .status{
    /*max-width:1000px;*/
    margin:0px 60px;
    padding:4px 20px;
    border-bottom:1px dotted #444;
    div{display:inline-block;color:#8E6D56;font-weight: bold;font-size:16px;}
  }

  .show-markdown{max-width:1000px;margin:0px 60px 300px 60px;padding:20px 20px;}
}
.blog-article-show.edit{
  width:55%;
}/*#show的编辑模式*/

</style>

