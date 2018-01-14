<template>
<div class="blog-list-article"
     @mouseenter="showStatus(article)"
     @mouseleave="hiddenStatus(article)">
    <div class="content">
        <div class="pic">
            <img draggable="false" v-bind:src="article.pic">
        </div>
        <div class="describe">&nbsp;&nbsp;<a href="#" v-text="article.describe"></a></div>
        <div class="title"><a href="#" v-text="article.title"></a></div>
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
<style>
.blog-list-article{width:600px; background: #fff;margin-bottom:20px;box-shadow: #999 3px 4px 6px;position:relative;border-radius:1px;background-image:url(/static/images/fangge.jpg);transition: left 0.5s,bottom 0.5s,box-shadow 0.5s;-webkit-transition: left 0.5s,bottom 0.5s,box-shadow 0.5s;left:0px;bottom:0px;}
.blog-list-article:hover{left:5px;bottom:5px;box-shadow: #777 8px 9px 6px;}
.blog-list-article .content{height:290px;}
.blog-list-article .content .pic{width:596px;height:210px;overflow:hidden;border:#fff 2px solid;border-radius:1px;}
.blog-list-article .content .describe{width:560px;height:66px;padding:2px 20px;overflow: hidden;}
.blog-list-article .content .describe a{font-size: 13px;line-height:23px;color:#3F3E3C;}
.blog-list-article .content .describe a:hover{color:#000;}
.blog-list-article .content .title{width:560px;padding:2px 20px;position:relative;top:-106px;}
.blog-list-article .content .title a{font-size: 18px;font-weight:bold;color:#fff;line-height:23px;}
.blog-list-article .content .title a:hover{color:#000;text-shadow: 0px 0px 6px #fff;}
.blog-list-article .status{height:0px;background:#3C3C3C;border-top:solid 3px #8E6D56;border-bottom:solid 1px #ddd;transition: height 0.5s;-webkit-transition: height 0.5s;overflow:hidden;}
.blog-list-article .status.on{height:26px;}
.blog-list-article .status li{float:right;height:26px;padding: 0px 10px;}
.blog-list-article .status li a{font-weight:bold;font-size:13px;color:#8E6D56;line-height:24px;}
.blog-list-article .status li a:hover{color:#bbb;}
.blog-list-article .status li i{color:#bbb;margin:0px 6px;font-size:14px;line-height:24px;}
</style>

