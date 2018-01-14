<template>
<div class="blog-common-leftAside">
    <section class="topspaceinfo">
        <h1>博客</h1>
        <p>php是世界上最好的编程语言，没有之一！</p>
    </section>
    <div class="userinfo">
        <p class="q-fans"> 访客：<a href="#">167</a></p>
        <p class="btns"><a href="#" target="_blank" >私信</a><a href="#" target="_blank">所有博客</a></p>
    </div>
    <section class="taglist">
        <h2>个人格言</h2>
        <ul>
            <li><a href="#">今夕何夕，君已陌路</a></li>
        </ul>
    </section>
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
	name: 'leftAside',
    data:function(){
        return {

        }
    },
	methods:{

	},
}

</script>
<style>
.blog-common-leftAside{width: 270px;height:100%;float:right;background: #E8E5DD;box-shadow: #aaa 3px 0px 6px;}
.blog-common-leftAside .avatar { margin: 20px auto; width: 160px; height: 160px; border-radius: 160px; -moz-border-radius: 160px; -webkit-border-radius: 160px; overflow: hidden; }
.blog-common-leftAside .avatar a { display: block; padding-top: 97px; width: 160px; height: 63px; background: url(/static/images/photo.jpg) no-repeat; background-size: 160px 160px }
.blog-common-leftAside .avatar a span { display: block; margin-top: 63px; padding-top: 8px; width: 160px; height: 55px; text-align: center; font-size: 16px; line-height: 20px; color: #fff; background: rgba(0, 0, 0, .5); -webkit-transition: margin-top .2s ease-in-out; -moz-transition: margin-top .2s ease-in-out; -o-transition: margin-top .2s ease-in-out; transition: margin-top .2s ease-in-out; }
.blog-common-leftAside .avatar a:hover span { display: block; margin-top: 0; }
.blog-common-leftAside .topspaceinfo { background: #8E6D56; padding: 40px 20px; color: #fff }
.blog-common-leftAside .topspaceinfo h1 { font-size: 16px; line-height: 40px }
.blog-common-leftAside .userinfo { padding: 20px 30px 30px; font-size: 14px; line-height: 28px; color: #666; }
.blog-common-leftAside .userinfo a { color: #8E6D56; }
.blog-common-leftAside .userinfo a:hover { color: #000 }
.blog-common-leftAside .q-fans, .btns a { padding: 0 10px }
.blog-common-leftAside .q-fans a { font-weight: bold; }
.blog-common-leftAside .btns a { border-right: #dad9d5 1px solid; }
.blog-common-leftAside section { display: block; overflow: hidden }
.blog-common-leftAside section h2 { background: #8E6D56; color: #FFF; padding-left: 30px; height: 30px; line-height: 30px; font-size: 14px; }
.blog-common-leftAside .newpic ul, .taglist ul { padding: 20px 30px; overflow: hidden }
.blog-common-leftAside .newpic ul li { display: inline; width: 48px; height: 48px; }
.blog-common-leftAside .newpic ul li img { width: 48px; height: 48px; border: 0; display: block; float: left; border: 1px solid transparent; }
.blog-common-leftAside .newpic ul li img:hover { opacity: 0.5 }
.blog-common-leftAside .taglist ul li a { padding: 2px 5px; display: inline-block; float: left; margin-right: 5px; color: #454545; }
.blog-common-leftAside .taglist ul li a:hover { background: #8E6D56; color: #fff; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px }
</style>

