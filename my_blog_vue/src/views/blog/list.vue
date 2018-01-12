<template>
 <div class="mainContent">
<div class="left">
    <div class="aside">
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
    <div class="clear"></div>
</div>
<div class="right">
    <div class="shutiao"></div>
    <div class="top">
        <div class="zhedie"></div>
    </div>
    <div class="blogitems">
        <div v-for="article in articles" class="item" @mouseenter="showStatus(0)" @mouseleave="hiddenStatus(0)">
            <div class="content">
                <div class="pic">
                    <img draggable="false" v-bind:src="article.pic">
                </div>
                <div class="describe">&nbsp;&nbsp;<a href="#" v-text="article.describe"></a></div>
                <div class="title"><a href="#" v-text="article.title"></a></div>
            </div>
            <ul class="status" v-bind:class="{on:isShowStatus[0]}">
                <li><a href="#"><i class="fa fa-thumbs-o-down"></i>123</a></li>
                <li><a href="#"><i class="fa fa-thumbs-o-up"></i>123</a></li>
                <li><a href="#"><i class="fa fa-eye"></i>123</a></li>
            </ul>
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
    mounted:function()
    {
        this.initStyle();
    },
    data:function(){
        return {
            isShowStatus:[],
            articles:[
                {
                    title:'PHP是世界上最好的编程语言，没有之一！',
                    describe:'百度编辑器上传图片到本项目的时候，没有问题，一旦跨域上传图片的时候就会导致图片上传错误，原因是因为百度编辑器使用的编辑区域是IFrame，而父窗口和主窗口的数据不可跨域调用。解决方案：将百度编辑器的图片数据提交到本项目...',
                    pic:'/static/images/2b.jpg',
                },
            ],
        }
    },
	methods:{
        //初始化一些样式
        initStyle:function initStyle(){
            $('.mainContent > .left').css('height',$('.mainContent > .right').css('height'));
            $('.right > div.shutiao').css('height',$('html').css('height'));
        },
        showStatus:function shouStatus(index){
            this.$Vue.set(this.isShowStatus,index,true);
        },
        hiddenStatus:function hiddenStatus(index){
            this.$Vue.set(this.isShowStatus,index,false);
        }
	},
}

</script>
<style>
.mainContent { background: #DDD6CC; width: 100%; margin: 20px auto 0px;}
.mainContent > .left{min-width: 270px;width:33%;float:left;position:relative;height:100%;}
.left div.aside {width: 270px;height:100%;float:right;background: #E8E5DD;box-shadow: #aaa 3px 0px 6px;}
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

.right > div.top { height:40px;min-width:850px;width:96%;background:#fff;position:absolute;left:-35px;top:8px;box-shadow: #877 5px 5px 5px;}
.right > div.top .zhedie{background:#ddd;width:40px;height:40px;}
.right > div.shutiao{height:120%;width:8px;background:#bababa;position:absolute;left:90%;top:-63px;}

.right .blogitems { width: 730px;margin-top: 60px;}
.blogitems .item{width:600px; background: #fff;margin-bottom:20px;box-shadow: #999 3px 4px 6px;position:relative;border-radius:1px;background-image:url(../../assets/image/fangge.jpg);transition: left 0.5s,bottom 0.5s,box-shadow 0.5s;-webkit-transition: left 0.5s,bottom 0.5s,box-shadow 0.5s;left:0px;bottom:0px;}
.blogitems .item:hover{left:5px;bottom:5px;box-shadow: #777 8px 9px 6px;}
.item .content{height:290px;}
.item .content .pic{width:596px;height:210px;overflow:hidden;border:#fff 2px solid;border-radius:1px;}
.item .content .describe{width:560px;height:66px;padding:2px 20px;overflow: hidden;}
.item .content .describe a{font-size: 13px;line-height:23px;color:#3F3E3C;}
.item .content .describe a:hover{color:#000;}
.item .content .title{width:560px;padding:2px 20px;position:relative;top:-106px;}
.item .content .title a{font-size: 18px;font-weight:bold;color:#fff;line-height:23px;}
.item .content .title a:hover{color:#000;text-shadow: 0px 0px 6px #fff;}
.item .status{height:0px;background:#3C3C3C;border-top:solid 3px #8E6D56;border-bottom:solid 1px #ddd;transition: height 0.5s;-webkit-transition: height 0.5s;overflow:hidden;}
.item .status.on{height:26px;}
.item .status li{float:right;height:26px;padding: 0px 10px;}
.item .status li a{font-weight:bold;font-size:13px;color:#8E6D56;line-height:24px;}
.item .status li a:hover{color:#bbb;}
.item .status li i{color:#bbb;margin:0px 6px;font-size:14px;line-height:24px;}

</style>

