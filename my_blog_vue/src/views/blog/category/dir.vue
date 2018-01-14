<template>
<div class="blog-category-dir">
	<div class="pic"></div>
	<div class="title">
		<a href="#" v-text="info.name"></a>
	</div>
	<div class="list">
		<div class="memo" v-text="info.memo"></div>
		<div class="desc" v-text="info.desc"></div>
		<div class="article" v-for="article in info.list">
			<a href="#" v-text="article"></a>
		</div>
	</div>
</div>
</template>
<script>
import common from '@/components/common'

export default {
	extends:common,
	name: 'dir',
	props: ['info'],
	methods:{

	},
	data:function(){
		return {

		}
	},
	components:{
    }
}

</script>
<style>
.blog-category-dir{min-width: 210px;width:95%;background:#fff;position:relative;margin-bottom:10px;box-shadow: #999 3px 4px 6px;transition:box-shadow 0.5s;-webkit-transition:box-shadow 0.5s;}
.blog-category-dir:hover{box-shadow: #777 8px 9px 6px;}
.blog-category-dir .pic{border:3px solid #fff;border-bottom:0px;height:120px;background:url(/static/images/zhende.jpg);}
.blog-category-dir .title{position:absolute;top:98px;padding:0px 10px;}
.blog-category-dir .title a{font-size: 18px;font-weight:bold;color:#fff;line-height:23px;text-shadow: 0px 0px 5px #000;}
.blog-category-dir .title a:hover{color:#000;text-shadow: 0px 0px 6px #fff;}
.blog-category-dir .list{padding:0px 10px 25px;}

.blog-category-dir .list .memo{font-weight:bold;font-size: 14px;}
.blog-category-dir .list .desc{padding-bottom:10px;}

.blog-category-dir .list .article{margin:2px 0px;}
.blog-category-dir .list .article a{font-weight:bold;color:#8E6D56;}
.blog-category-dir .list .article a:hover{text-decoration: underline;}

</style>

