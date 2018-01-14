<template>
<div class="blog-article-markdowm">
	<mavon-editor style="height: 100%"
					:toolbars="toolbars"
					:subfield="false"
					:value="content"
					@change="change"></mavon-editor>
</div>
</template>
<script>
/*
@ type: component
@ 引用处:
@   component:blog-article-edit
 */
import common from '@/components/common'
import { mavonEditor } from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'

export default {
	extends:common,
	name: 'markdowm',
	props:['content'],
	mounted:function(){
		//让编辑器里的字小一点
		$('textarea.auto-textarea-input').css('font-size','13px')
	},
    data:function(){
        return {
        	toolbars:{
				bold: true, // 粗体
				italic: true, // 斜体
				header: true, // 标题
				underline: true, // 下划线
				strikethrough: false, // 中划线
				mark: true, // 标记
				superscript: true, // 上角标
				subscript: true, // 下角标
				quote: true, // 引用
				ol: true, // 有序列表
				ul: true, // 无序列表
				link: true, // 链接
				imagelink: true, // 图片链接
				code: true, // code
				table: true, // 表格
				fullscreen: true, // 全屏编辑
				readmodel: true, // 沉浸式阅读
				htmlcode: false, // 展示html源码
				help: false, // 帮助
				/* 1.3.5 */
				undo: false, // 上一步
				redo: false, // 下一步
				trash: false, // 清空
				save: true, // 保存（触发events中的save事件）
				/* 1.4.2 */
				navigation: true, // 导航目录
				/* 2.1.8 */
				alignleft: true, // 左对齐
				aligncenter: false, // 居中
				alignright: false, // 右对齐
				/* 2.2.1 */
				subfield: false, // 单双栏模式
				preview: false, // 预览
  			}
        }
    },
	methods:{
		change:change,
	},
    components:{
        'mavon-editor': mavonEditor
    }
}

//内容被修改时
function change(value,render)
{
	this.$emit('text-change',{value:value,render:render})
}

</script>
<style>
.blog-article-markdowm{height:500px;}
</style>

