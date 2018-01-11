<template>
<header>
	<nav id="nav">
		<ul>
			<li><a href="#" id="nav_current">Daiski的代码工坊</a></li>
			<li><a href="/download/" target="_blank">分类列表</a></li>
			<li><a href="/download/" target="_blank">发表博客</a></li>
		</ul>
	</nav>
</header>
</template>
<script>
import common from '@/components/common'

export default {
	extends:common,
	name: 'headhead',
	methods:{

	},
}

</script>
<style>
header { width: 100%; height: 43px; background: -webkit-gradient(linear, 78% 100%, 78% 41%, from(#EFEEEC), to(#fff)); box-shadow: #aaa 2px 3px 6px; }
header nav { margin: 0 auto; width: 980px; text-align: center }
header nav ul li { line-height: 43px; display: block }
header nav ul li a { color: #484848; float: left; padding: 0 15px; margin-right: 2px;font-size: 13px;font-weight: bold;color:#775F4F;}
header nav ul li a:hover, #nav_current { color: #fff; background: #8E6D56; transform: skew(-20deg); -webkit-transform: skew(-20deg); -moz-transform: skew(-20deg); -o-transform: skew(-20deg);box-shadow: #aaa 5px 5px 6px;}
</style>

