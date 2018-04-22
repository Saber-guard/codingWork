<template>
<div class="blog-article">
	<edit :mode="mode" :article="article"
        :render_text="render_text"
			  @switch-mode="switchMode"
			  @text-change="textChange"></edit>
	<show :mode="mode" :article="article" :render_text="render_text" @switch-mode="switchMode"></show>
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

  created:function(){
    //关闭动画
    this.$parent.openAnimation(false)
    //初始化article
    this.initArticle()
  },

  watch:{
	  '$route' (to,from){
      //初始化article
      this.initArticle()
    }
  },

	mounted:function(){
		//edit与show保持同高
		this.heightEQ()
	},
	data:function(){
		return {
			'mode':0,//模式：0 查看 1 编辑
			'article':{},
      'render_text':'',
		}
	},
	methods:{
		initArticle:initArticle,
		switchMode:switchMode,
		textChange:textChange,
		heightEQ:heightEQ,
	},
	components:{
		show:show,
		edit:edit,
	}
}

//初始化article
function initArticle()
{
  //id为0则为发表新文章
  if (this.$route.params.id == 0) {
    this.switchMode(1)
    this.$Vue.set(this,'article',{})
    return
  }

  this.switchMode(0)
  this.$axios({
    method:"get",
    url:'cms/article',
    params:{
      "id":this.$route.params.id,
      "select":"title,text,id,datetime,describe,u_id,clicks",
    }
  }).then(function(response){
    if (response.data.errno == 0) {
      this.article = response.data.data
    }
  }.bind(this))
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
	this.article.a_text = param.value
	this.render_text = param.render
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

