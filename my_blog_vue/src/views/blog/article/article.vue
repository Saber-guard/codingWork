<template>
<div class="blog-article">
	<edit 	:mode="mode" :article="article"
			@switch-mode="switchMode"
			@text-change="textChange"></edit>
	<show :mode="mode" :article="article" @switch-mode="switchMode"></show>
	<div class="clear"></div>
</div>
</template>
<script>
/*
@ type: view
 */
import common from '@/components/common'
import show from './show'
import edit from './edit'

export default {
	extends:common,
	name: 'articlearticle',
	mounted:function(){
		//edit与show保持同高
		this.heightEQ()
	},
	data:function(){
		return {
			'mode':0,//模式：0 查看 1 编辑
			'article':{
				'id':1,
				'title':'PHP是世界上最好的语言',
				'datetime':'2017-10-10 12:13:14',
				'zan':123,
				'look':456,
				'text':'&nbsp;&nbsp;这个属性是设置背景相关属性的一种快捷的综合写法， 包括background-color, background-image, background-repeat, backgroundattachment, background-position。这个HTML所用的背景属性表示，网页的背景颜色是翠绿色，背景图片是background.jpg图片，背景图片不重复显示，背景图片不随内容滚动而动，背景图片距离网页最左面40px，距离网页最上面100px。',
				'render':''
			},
		}
	},
	methods:{
		switchMode:switchMode,
		textChange:textChange,
		heightEQ:heightEQ,
	},
	components:{
		show:show,
		edit:edit,
	}
}

//切换模式
function switchMode(mode)
{
	this.heightEQ()
	this.$Vue.set(this,'mode',mode);
}

//内容被编辑时
function textChange(param)
{
	this.article.text = param.value
	this.article.render = param.render
}

//edit与show同高
function heightEQ()
{
	let showObj = $('.blog-article-show')
	let showHeight = showObj.css('height')
	let editObj = $('.blog-article-edit')
	let editHeight = editObj.css('height')

	editObj.css('height',showHeight)

}

</script>
<style lang="scss" scoped>
.blog-article{min-width:1100px;width:100%;height:100%;background:no-repeat;background-image:url(/static/images/2b2bleft.jpg),url(/static/images/2b2bright.jpg);background-position:left top,right top;background-attachment:fixed;background-size:auto 100%;}

</style>

