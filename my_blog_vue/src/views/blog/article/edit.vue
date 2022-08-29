<template>
<div class="blog-article-edit" :class="{show:mode==0}">
	<div class="edit-list" :class="{hidden:mode==0}">
    <div>
      <el-form :label-position="'left'" :label-suffix="':'">
        <el-form-item label="栏目">
          <el-select v-model="article.a_c_id" :disabled="article.a_id?true:false">
            <el-option
                :label="cate.c_title"
                :value="cate.c_id"
                v-for="cate in category_list"
                :key="cate.c_id"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="标题">
          <el-input v-model="article.a_title" ></el-input>
        </el-form-item>
        <el-form-item label="图片">
          <el-input type="hidden" v-model="article.a_pic" ></el-input>
          <uploadImg
            list_type="picture-card"
            :limit="1"
            @pic_list_update="picListUpdate"
            :pic_list="article.a_pic"></uploadImg>
        </el-form-item>
        <el-form-item label="简介">
          <el-input type="textarea" v-model="article.a_describe"></el-input>
        </el-form-item>
      </el-form>
    </div>
		<div>
			<markdowm
          :content="article.a_text"
          @text-change="textChange"
          @ctrl-save="submit"
          ></markdowm>
		</div>
		<div>
			<el-button type="success" @click="submit">保存</el-button>
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
import markdowm from './markdown'
import uploadImg from '@/components/common'
import UploadImg from "../../../components/uploadImg";

export default {
	extends:common,
	name: 'edit',
	props:['mode','article','render_text'],
  data:function(){
        return {
          category_list:[],
        }
  },
  computed:{

  },

  created:function(){
	  //获取栏目类型列表
    this.$axios({
      method:"get",
      url:'cms/category_list',
      params:{
        "parent":1,
        "select":"title,id",
        "size":100,
      }
    }).then(function (response) {
      let data = response.data
      if (data.errno == 0) {
        this.category_list = data.data
      }
    }.bind(this))

  },
	methods:{
		show:show,
		submit:submit,
		update:update,
		create:create,
		textChange:textChange,//内容改变
    picListUpdate:picListUpdate,//上传图片列表有变动时同步
	},
	components:{
    UploadImg,
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

//提交
function submit()
{
  if (this.article.a_id) {
    //修改文章
    this.update()
  } else {
    //新建文章
    this.create()
  }

}

//修改文章
function update()
{
  this.$axios({
    method:"put",
    url:'cms/article/'+this.article.a_id,
    data:this.article
  }).then(function(response){
    let data = response.data
    if (data.errno == 0) {
      this.$message({
        message: data.info,
        type: 'success'
      });
    } else {
      this.$message({
        message: data.info,
        type: 'warning'
      });
    }
  }.bind(this))
}

//新建文章
function create()
{
  //console.log(this.article)
  this.$axios({
    method:"post",
    url:'cms/article',
    data:this.article
  }).then(function(response){
    let data = response.data;
    if (data.errno == 0) {
      this.$message({
        message: data.info,
        type: 'success'
      });
      this.$Vue.set(this.article,'a_id',data.data.a_id);
      //跳转过去
      this.$router.push({path:'/blog/article/'+data.data.a_id})
    } else {
      this.$message({
        message: data.info,
        type: 'warning'
      });
    }
  }.bind(this))
}

// 上传图片列表有变动时同步
function picListUpdate(param){
  this.article.a_pic = param.pic_list
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

