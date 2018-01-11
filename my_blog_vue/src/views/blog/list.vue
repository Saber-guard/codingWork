<template>
 <div class="mainContent">
<div class="left">
    <div class="aside">
        <section class="topspaceinfo">
            <h1>Daiski的代码工坊</h1>
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
    <div class="clear"></div>
</div>
<div class="right">
    <div class="shutiao"></div>
    <div class="top">
        <div class="zhedie"></div>
    </div>
    <div class="blogitems">
<!--         <article>
        <h2 class="title"><a href="#">Centos下编译安装lamp环境</a></h2>
        <div class="text">
          <div class="textimg">
          	<img src="../../assets/image/2b2b.jpg">
          </div>
        </div>
        <div class="textfoot">
          <a href="#">阅读全文</a><a href="#">评论</a><a href="#">转载</a>
        </div>
        </article> -->

        <div class="item">
            <div class="content"></div>
            <div class="status"></div>
        </div>
        <div class="item">
            <div class="content"></div>
        </div>
        <div class="item">
            <div class="content"></div>
        </div>

        <!-- <div class="pages"><span>1</span><a href="#" hidefocus="">2</a><a href="#" hidefocus="">3</a><a href="#" class="next">下一页&gt;&gt;</a></div> -->
    </div>




</div>
<div class="clear"></div>
 </div>
</template>
<script>
import common from '@/components/common'

export default {
	extends:common,
	name: 'list',
  data:function(){
      return {
      }
  },
	methods:{

	},
}

</script>
<style>
.mainContent { background: #DDD6CC; width: 100%; margin: 20px auto;}
.mainContent > .left{min-width: 270px;width:33%;float:left;position:relative;height:100%;}
.left div.aside {width: 270px; float:right;background: #E8E5DD;box-shadow: #aaa 3px 7px 6px;}
.avatar { margin: 20px auto; width: 160px; height: 160px; border-radius: 160px; -moz-border-radius: 160px; -webkit-border-radius: 160px; overflow: hidden; }
.avatar a { display: block; padding-top: 97px; width: 160px; height: 63px; background: url(../../assets/image/photo.jpg) no-repeat; background-size: 160px 160px }
.avatar a span { display: block; margin-top: 63px; padding-top: 8px; width: 160px; height: 55px; text-align: center; font-size: 16px; line-height: 20px; color: #fff; background: rgba(0, 0, 0, .5); -webkit-transition: margin-top .2s ease-in-out; -moz-transition: margin-top .2s ease-in-out; -o-transition: margin-top .2s ease-in-out; transition: margin-top .2s ease-in-out; }
.avatar a:hover span { display: block; margin-top: 0; }
.topspaceinfo { background: #8E6D56; padding: 40px 20px; color: #fff }
.topspaceinfo h1 { font-size: 16px; line-height: 40px }
.userinfo { padding: 20px 30px 30px; font-size: 14px; line-height: 28px; color: #666; }
.userinfo a { color: #8E6D56; }
.userinfo a:hover { color: #000 }
.q-fans, .btns a { padding: 0 10px }
.q-fans a { font-weight: bold; }
.btns a { border-right: #dad9d5 1px solid; }
.left div.aside section { display: block; overflow: hidden }
.left div.aside section h2 { background: #8E6D56; color: #FFF; padding-left: 30px; height: 30px; line-height: 30px; font-size: 14px; }
.newpic ul, .taglist ul { padding: 20px 30px; overflow: hidden }
.newpic ul li { display: inline; width: 48px; height: 48px; }
.newpic ul li img { width: 48px; height: 48px; border: 0; display: block; float: left; border: 1px solid transparent; }
.newpic ul li img:hover { opacity: 0.5 }
.taglist ul li a { padding: 2px 5px; display: inline-block; float: left; margin-right: 5px; color: #454545; }
.taglist ul li a:hover { background: #8E6D56; color: #fff; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px }


.mainContent > .right{min-width: 270px;width:66%;float:right;position:relative;}

/*.blogitems article { border-bottom: #F4F3EF 40px solid; }
.title { background: url(../../assets/image/titlebg.png) no-repeat 5% 80%; font-size: 20px; line-height: 28px; display: inline-block; padding: 38px 60px 8px 80px; border-bottom: 1px solid #e2e2e2; width: 100%; }
.title a { color: #454545; }
.title a:hover { padding: 20px }
.text { font-size: 14px; padding: 20px 40px; }
.text p { line-height: 24px; margin-bottom: 10px }
.textimg { text-align: center }
.textimg img { max-width: 500px; width:expression(document.body.clientWidth > 500? "500px": "auto" );}
.textfoot { padding: 20px 60px; border-top: 1px solid #dddcdb; text-align: right; box-shadow: #999 2px 2px 3px }
.textfoot a { margin-left: 10px; }
.pages { padding: 0 60px 25px; background: #F4F3EF; text-align: right }
.pages span { background: #8E6D56; color: #fff; }
.pages a { background: #fff; color: #454545; padding: 5px 8px; border: none; margin: 0 0 0 5px; }
.pages span { padding: 5px 8px; border: none; margin: 0 0 0 5px; }
.pages a:hover { background: #CCC }*/

.right > div.top { height:40px;min-width:850px;width:93%;background:#fff;position:absolute;left:-35px;top:8px;box-shadow: #877 5px 5px 5px;}
.right > div.top .zhedie{background:#ddd;width:40px;height:40px;}
.right > div.shutiao{height:120%;width:8px;background:#bababa;position:absolute;left:90%;top:-63px;}

.right .blogitems { width: 730px;margin-top: 60px;}
.blogitems .item{width:560px; background: #fff;margin-bottom:20px;box-shadow: #999 3px 4px 6px;position:relative;}
.item .content{height:210px;}
.item .status{height:17px;background:#3C3C3C;border-top:solid 3px #8E6D56;display:none;}

</style>

