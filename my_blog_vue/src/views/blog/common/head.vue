<template>
<header class="blog-common-head">
	<nav id="nav">
		<ul>
			<li class="module"><router-link :to="'/blog/category'" id="nav_current">首页</router-link></li>
			<li class="module"><router-link :to="'/blog/category'">分类列表</router-link></li>
			<li class="module"><router-link :to="'/blog/article/0'"  v-if="common_data.user_info.u_id==1">发表博客</router-link></li>
      <li class="user" v-if="!common_data.user_info.u_id"><span @click="showSignin">注册</span></li>
      <li class="user" v-if="!common_data.user_info.u_id"><span @click="showLogin">登录</span></li>
      <li class="user" v-if="common_data.user_info.u_id"><span @click="logOut">退出</span></li>
		</ul>
	</nav>
  <login ref="login"></login>
  <signin ref="signin"></signin>
</header>
</template>
<script>
/*
@ type: component
@ 引用处:
@   view:blog
 */
import common from '@/components/common'
import login from '@/views/blog/common/login'
import signin from '@/views/blog/common/signin'

export default {
	extends:common,
	name: 'headhead',
  data:function(){
	  return {
      show_login:false,
      show_signin:false,
    }
  },
	methods:{
    showLogin:showLogin,
    showSignin:showSignin,
    logOut:logOut,
	},
  components:{
    login:login,
    signin:signin,
  },
}

//显示登陆框
function showLogin() {
  this.$refs.login.showBox(true)
}
//显示注册框
function showSignin() {
  this.$refs.signin.showBox(true)
}

function logOut() {
  //清除cookie
  this.$cookie.delCookie('user_info')
  //清除store的user_info
  this.$store.commit('logout')
}


</script>
<style lang="scss" scoped>
.blog-common-head {
  min-width: 1100px;
  width: 100%;
  height: 43px;
  background: -webkit-gradient(linear, 78% 100%, 78% 41%, from(#EFEEEC), to(#fff));
  box-shadow: #aaa 2px 3px 6px;
  position: relative;
  nav {
    margin: 0 auto;
    /*width: 85%;*/
    padding-left:10%;
    text-align: center;
    ul{
      li.module{
        line-height: 43px;
        display: block;
        a { float: left; padding: 0 15px; margin-right: 2px;font-size: 13px;font-weight: bold;color:#775F4F;}
        a:hover, #nav_current { color: #fff; background: #8E6D56; transform: skew(-20deg); -webkit-transform: skew(-20deg); -moz-transform: skew(-20deg); -o-transform: skew(-20deg);box-shadow: #aaa 5px 5px 6px;}
      }
      li.user{
        line-height: 43px;
        display: block;
        span { color: #a0a0a0; float: right; padding: 0 3px; margin-right: 2px;font-size: 13px;font-weight: bold;cursor:pointer;}
        span:hover{color:#775F4F;text-decoration: underline;}
      }
    }
  }
}

</style>

