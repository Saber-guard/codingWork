<template>
<div class="blog-article-markdowm">
	<mavon-editor style="height: 100%"
					:toolbars="toolbars"
					:subfield="false"
					:value="content"
          @change="change"
          			@imgAdd="imgAdd"
					@save="save"></mavon-editor>
</div>
</template>
<script>
/*
@ type: component
@ 引用处:
@   component:blog-article-edit
 */
import md5 from 'js-md5'
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
    	save:save,
		imgAdd:imgAdd,
	    getPath:getPath,
    	getFilename:getFilename,
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
//按下保存键时
function save(value,render)
{
  this.$emit('ctrl-save',{value:value,render:render})
}
//添加图片时
function imgAdd(pos_name,file)
{
  //获取OSS签名
  this.$axios({
    method:"get",
    url:'system/upload_sig',

  }).then(function (response) {
    let data = response.data
    if (data.errno == 0) {
      let oss_data = new FormData() //上传数据
      let oss_url = data.data.host //上传地址
      oss_data.append('OSSAccessKeyId',data.data.OSSAccessKeyId)
      oss_data.append('policy',data.data.policy)
      oss_data.append('signature',data.data.signature)
      oss_data.append('expire',data.data.expire)
      oss_data.append('key',this.getPath() + this.getFilename(file.name))
      oss_data.append('file',file)

      //上传
      this.$axios({
      	  method:"put",
    	  url:oss_url,
    	  data:oss_data,
    	  headers:{'Content-Type':'multipart/form-data'},
      }).then(function(res){

      	console.log(res)
      })



    } else {
      this.$message({
        message: '上传失败',
        type: 'success'
      });
    }
  }.bind(this))

}

//生成上传文件路径
function getPath(){

  let path = 'pic'

  let dateObj = new Date();
  let mon = dateObj.getMonth() + 1
  let day = dateObj.getDate()
  let date = dateObj.getFullYear() + "/" + (mon<10?"0"+mon:mon) + "/" +(day<10?"0"+day:day)

  path += '/' + date + '/'
  return path
}

//生成文件名
function getFilename(old_name){

  let ext = old_name.split('.')[1]
  ext = ext ? ext : ''
  let timestamp = new Date().getTime()
  let rand = Math.random()
  return md5((timestamp + rand).toString()) + '.' + ext
}

</script>
<style lang="scss" scoped>
.blog-article-markdowm{height:700px;}
</style>

