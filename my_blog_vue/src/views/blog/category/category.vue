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
			<el-col :span="8">
        <el-row>
          <el-col :span="24"  v-for="(cate,index) in cates" :key="cate.c_id">
            <dir :info="cate" v-if="index%3==0?true:false"></dir>
          </el-col>
        </el-row>
			</el-col>
      <el-col :span="8">
        <el-row>
          <el-col :span="24"  v-for="(cate,index) in cates" :key="cate.c_id">
            <dir :info="cate" v-if="index%3==1?true:false"></dir>
          </el-col>
        </el-row>
      </el-col>
      <el-col :span="8">
        <el-row>
          <el-col :span="24"  v-for="(cate,index) in cates" :key="cate.c_id">
            <dir :info="cate" v-if="index%3==2?true:false"></dir>
          </el-col>
        </el-row>
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
  created:function()
  {
    //打开动画
    this.$parent.openAnimation(true)
    //获取栏目列表
    this.$axios({
      method:"get",
      url:'cms/category_list',
      params:{
        "parent":1,
        "select":"title,id,info,alias,pic",
      }
    }).then(function (response) {
      //分割为3个一组
      // this.cates = this.$func.group(response.data.data,3)
      this.cates = response.data.data
      for (var i in this.cates) {
        this.$Vue.set(this.cates[i],'list',[])
      }

    }.bind(this))
  },
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
			cates:[]
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

