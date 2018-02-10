<template>
<div class="blog-article-edit" :class="{show:mode==0}">
	<div class="edit-list" :class="{hidden:mode==0}">
		<div>
			<markdowm 	:content="article.text"
						@text-change="textChange"></markdowm>
		</div>
		<div>
			<el-button type="primary" @click="show">关闭</el-button>
		</div>
	</div>
</div>
</template>
<script>
/*
@ type: component
@ 引用处:
@   view:blog-article
 */
import common from '@/components/common'
import markdowm from './markdowm'

export default {
	extends:common,
	name: 'edit',
	props:['mode','article'],
    data:function(){
        return {

        }
    },
	methods:{
		show:show,
		textChange:textChange,
	},
	components:{
		markdowm:markdowm,
	}
}

//切换到显示模式
function show()
{
	this.$emit('switch-mode',0)
}

//内容改变时
function textChange(param)
{
	this.$emit('text-change',param)
}

</script>
<style lang="scss" scoped>
.blog-article-edit{
  width:40%;
  min-height:800px;
  float:left;
  transition: width 0.1s,opacity 0.1s;
  -webkit-transition: width 0.1s,opacity 0.1s;
  background-color:#fff;
  opacity:1;
  overflow:auto;
  .edit-list.hidden{display: none;}
  .edit-list>div{padding:5px;}
}
.blog-article-edit.show{
  width:26%;
  opacity:0;
}
</style>

