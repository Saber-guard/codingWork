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
    mounted:function()
    {
        this.initStyle();
    },
    data:function(){
        return {
            articles:[
                {
                    id:1,
                    title:'PHP是世界上最好的编程语言，没有之一！',
                    describe:'百度编辑器上传图片到本项目的时候，没有问题，一旦跨域上传图片的时候就会导致图片上传错误，原因是因为百度编辑器使用的编辑区域是IFrame，而父窗口和主窗口的数据不可跨域调用。解决方案：将百度编辑器的图片数据提交到本项目...',
                    pic:'/static/images/2b.jpg',
                    select:false,
                },
                {
                    id:2,
                    title:'PHP是世界上最好的编程语言，没有之一！',
                    describe:'百度编辑器上传图片到本项目的时候，没有问题，一旦跨域上传图片的时候就会导致图片上传错误，原因是因为百度编辑器使用的编辑区域是IFrame，而父窗口和主窗口的数据不可跨域调用。解决方案：将百度编辑器的图片数据提交到本项目...',
                    pic:'/static/images/2b.jpg',
                    select:false,
                },
            ],
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
<style>
.blog-list { min-width: 1100px;background: #DDD6CC; width: 100%; margin: 20px auto 0px;}

.blog-list>.left{min-width: 270px;width:33%;float:left;position:relative;height:100%;}

.blog-list>.right{min-width: 730px;width:66%;float:right;position:relative;}
.blog-list .right>div.shutiao{height:120%;width:8px;background:#bababa;position:absolute;left:90%;top:-63px;}
.blog-list .right .blogitems { width: 730px;margin-top: 60px;}


</style>

