<template>
<div class="blog-common-leftAside">
    <section class="topspaceinfo">
        <h1>coding工坊</h1>
        <p>php是世界上最好的编程语言，没有之一！</p>
    </section>
    <div class="userinfo">
        <p class="q-fans"> 在线人数：<a href="javascript:void(0);" v-text="visitor_num"></a></p>
        <p class="btns">
          <a href="javascript:void(0);" target="_blank" >私信</a>
          <router-link :to="'/blog/category'" >所有博客</router-link>
          </p>
    </div>
    <section class="taglist">
        <h2>个人格言</h2>
        <ul>
            <li><a href="javascript:void(0);">任何没有走心的努力，都只是看起来很努力</a></li>
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
  created: function(){
    //获取当前在线人数
    this.getClientCount()
    //订阅/public/online频道
    this.$Mqtt.subscribe('/public/online',{},this.public_online_callback);
  },
  data:function(){
      return {
        visitor_num:0
      }
  },
	methods:{
      public_online_callback:public_online_callback,
      getClientCount:getClientCount,
	},
}

function public_online_callback(topic,msg,packet){
        msg = parseInt(msg.toString());
        this.visitor_num = typeof msg == 'number' ? msg : 0;
}

function getClientCount()
{
  this.$axios({
    method:"get",
    url:'system/mqtt_client_count',
    params:{}
  }).then(function (response) {
    if (response.data.errno == 0) {
      this.visitor_num = response.data.data.count
    }
  }.bind(this))

}



</script>
<style lang="scss" scoped>
.blog-common-leftAside{
  width: 270px;
  height:100%;
  float:right;
  background: #FDFDFD;
  box-shadow: #aaa 3px 0px 6px;
  .avatar {
    margin: 20px auto;
    width: 160px;
    height: 160px;
    border-radius: 160px;
    -moz-border-radius: 160px;
    -webkit-border-radius: 160px;
    overflow: hidden;
    a {
      display: block;
      padding-top: 97px;
      width: 160px;
      height: 63px;
      background: url(/static/images/photo.jpg) no-repeat;
      background-size: 160px 160px;
      span { display: block; margin-top: 63px; padding-top: 8px; width: 160px; height: 55px; text-align: center; font-size: 16px; line-height: 20px; color: #fff; background: rgba(0, 0, 0, .5); -webkit-transition: margin-top .2s ease-in-out; -moz-transition: margin-top .2s ease-in-out; -o-transition: margin-top .2s ease-in-out; transition: margin-top .2s ease-in-out; }
    }
    a:hover span { display: block; margin-top: 0; }
  }

  .topspaceinfo {
    background: #8E6D56;
    padding: 40px 20px;
    color: #fff;
    h1 { font-size: 16px; line-height: 40px }
  }

  .userinfo {
    padding: 20px 30px 30px;
    font-size: 14px;
    line-height: 28px;
    color: #666;
    a { color: #8E6D56; }
    a:hover { color: #000 }
  }

  .q-fans{
    padding: 0 10px;
    a { font-weight: bold; }
  }

  .btns{
    a { padding: 0 10px;border-right: #dad9d5 1px solid; }
  }

  section {
    display: block;
    overflow: hidden;
    h2 { background: #8E6D56; color: #FFF; padding-left: 30px; height: 30px; line-height: 30px; font-size: 14px; }
  }

  .newpic{
    ul{
      padding: 20px 30px; overflow: hidden;
      li {
        display: inline;
        width: 48px;
        height: 48px;
        img { width: 48px; height: 48px; border: 0; display: block; float: left; border: 1px solid transparent; }
        img:hover { opacity: 0.5 }
      }
    }
  }

  .taglist{
    ul{
      padding: 20px 30px; overflow: hidden;
      li{
        a { padding: 2px 5px; display: inline-block; float: left; margin-right: 5px; color: #454545; }
        a:hover { background: #8E6D56; color: #fff; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px }
      }
    }
  }

}

</style>

