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

  .pic{
    border:3px solid #fff;
    border-bottom:0px;
    height:120px;
    background:url(/static/images/zhende.jpg);
  }

  .title{
    position:absolute;
    top:98px;
    padding:0px 10px;
    a{font-size: 18px;font-weight:bold;color:#fff;line-height:23px;text-shadow: 0px 0px 5px #000;}
    a:hover{color:#000;text-shadow: 0px 0px 6px #fff;}
  }

  .list{
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

