<template>
<div class="blog-category">
<div class="left">
    <leftAside></leftAside>
    <div class="clear"></div>
</div>
<div class="right">
    <div class="shutiao"></div>
    <headLine></headLine>
    <div class="cates">
		<el-row>
			<el-col :span="8" v-for="cate in cates" :key="cate.id">
				<dir :info="cate"></dir>
			</el-col>
		</el-row>
    </div>
</div>
<div class="clear"></div>
</div>
</template>
<script>
import common from '@/components/common'
import headLine from '../common/headLine'
import leftAside from '../common/leftAside'
import dir from './dir'

export default {
	extends:common,
	name: 'category',
	mounted:function()
    {
        this.initStyle();
    },
	methods:{
        //初始化一些样式
        initStyle:function initStyle(){
            $('.blog-category > .left').css('height',$('.blog-category > .right').css('height'));
            $('.right > div.shutiao').css('height',$('html').css('height'));
        },
	},
	data:function(){
		return {
			cates:[
				{
					id:1,
					name:'PHP程序设计',
					desc:'世界上最好的编程语言',
					memo:'Hypertext Preprocessor',
					list:[
						'PHP判断布尔值的一些常见方法',
						'布尔值在PHP里的更多特性',
						'TCP keepalive概述',
						'jQuery获取radio选中项checked',
						'TCP keepalive概述',
					],
				},
				{
					id:2,
					name:'PHP程序设计',
					desc:'世界上最好的编程语言',
					memo:'Hypertext Preprocessor',
					list:[
						'PHP判断布尔值的一些常见方法',
						'布尔值在PHP里的更多特性',
						'TCP keepalive概述',
						'jQuery获取radio选中项checked',
						'TCP keepalive概述',
					],
				},
				{
					id:3,
					name:'PHP程序设计',
					desc:'世界上最好的编程语言',
					memo:'Hypertext Preprocessor',
					list:[
						'PHP判断布尔值的一些常见方法',
						'布尔值在PHP里的更多特性',
						'TCP keepalive概述',
						'jQuery获取radio选中项checked',
						'TCP keepalive概述',
					],
				},
				{
					id:4,
					name:'PHP程序设计',
					desc:'世界上最好的编程语言',
					memo:'Hypertext Preprocessor',
					list:[
						'PHP判断布尔值的一些常见方法',
						'布尔值在PHP里的更多特性',
						'TCP keepalive概述',
						'jQuery获取radio选中项checked',
						'TCP keepalive概述',
					],
				},
			]
		}
	},
	components:{
        headLine:headLine,
        leftAside:leftAside,
        'dir':dir,
    }
}

</script>
<style lang="scss" scoped>
.blog-category {
  min-width: 1100px;
  background: #DDD6CC;
  width: 100%;
  margin: 20px auto 0px;
  >.left{min-width: 270px;width:33%;float:left;position:relative;height:100%;}
  >.right{
    min-width: 730px;
    width:66%;
    min-height:800px;
    float:right;
    position:relative;
    >div.shutiao{height:120%;width:8px;background:#bababa;position:absolute;left:90%;top:-63px;}
    .cates {min-width: 660px;width:85%;margin-top: 60px;}
  }
}


</style>

