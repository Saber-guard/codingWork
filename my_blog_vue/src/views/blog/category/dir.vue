<template>
<div class="blog-category-dir">
	<div class="pic-box" >
    <imgBox class="pic" :src="api_url+info.c_pic" ondragstart="return false"></imgBox>
  </div>
	<div class="title">
    <router-link :to="'/blog/list/'+info.c_id" v-text="info.c_title"></router-link>
	</div>
	<div class="list" v-loading="loding">
		<div class="memo" v-text="info.c_alias"></div>
		<div class="desc" v-text="info.c_info"></div>
		<div class="article" v-for="(article,index) in info.list" :key="index">
			<!--<a href="#" v-text="article.a_title"></a>-->
      <router-link :to="'/blog/article/'+article.a_id" v-text="article.a_title"></router-link>
		</div>
	</div>
</div>
</template>
<script>
import common from '@/components/common'
import imgBox from '@/components/imgBox'

export default {
	extends:common,
	name: 'dir',
	props: ['info'],
  created: function(){
    this.$axios({
      method:"get",
      url:'cms/article_list',
      params:{
        "c_id":this.info['c_id'],
        "select":"title,id",
        "size":100,
      }
    }).then(function (response) {
      this.loding = false
      this.info['list'] = response.data.data
    }.bind(this))
  },
	methods:{

	},
	data:function(){
		return {
      loding:true,
      api_url:process.env.API_URL,
		}
	},
	components:{
    imgBox:imgBox,
  }
}

</script>
<style lang="scss" scoped>
.blog-category-dir{
  min-width: 210px;
  width:95%;
  background:#fff;
  position:relative;
  margin-bottom:10px;
  box-shadow: #999 3px 4px 6px;
  transition:box-shadow 0.5s;
  -webkit-transition:box-shadow 0.5s;

  .pic-box{
    border:3px solid #fff;
    border-bottom:0px;
    .pic{
      width:100%;
    }
  }

  .title{
    position:relative;
    top:-28px;
    padding:0px 10px;
    a{font-size: 18px;font-weight:bold;color:#fff;line-height:23px;text-shadow: 0px 0px 5px #000;}
    a:hover{color:#000;text-shadow: 0px 0px 6px #fff;}
  }

  .list{
    position:relative;
    top:-20px;
    padding:0px 10px 25px;
    .memo{font-weight:bold;font-size: 14px;}
    .desc{padding-bottom:10px;}
    .article{
      margin:2px 0px;
      a{font-weight:bold;color:#8E6D56;}
      a:hover{text-decoration: underline;}
    }
  }
}
.blog-category-dir:hover{box-shadow: #777 8px 9px 6px;}



</style>

