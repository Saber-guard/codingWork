<template>
<header class="blog-common-head">
	<nav id="nav">
		<ul>
			<li><router-link :to="'/blog/category'" id="nav_current">首页</router-link></li>
			<li><router-link :to="'/blog/category'">分类列表</router-link></li>
			<li><router-link :to="'/blog/article/0'">发表博客</router-link></li>
		</ul>
	</nav>
</header>
</template>
<script>
/*
@ type: component
@ 引用处:
@   view:blog
 */
import common from '@/components/common'

export default {
	extends:common,
	name: 'headhead',
	methods:{

	},
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
    width: 980px;
    text-align: center;
    ul{
      li{
        line-height: 43px;
        display: block;
        a { color: #484848; float: left; padding: 0 15px; margin-right: 2px;font-size: 13px;font-weight: bold;color:#775F4F;}
        a:hover, #nav_current { color: #fff; background: #8E6D56; transform: skew(-20deg); -webkit-transform: skew(-20deg); -moz-transform: skew(-20deg); -o-transform: skew(-20deg);box-shadow: #aaa 5px 5px 6px;}
      }
    }
  }
}

</style>

