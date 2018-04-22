<template>
<div class="blog">
  <animation v-if="hasAnimation"></animation>
  <headhead v-if="hasHead"></headhead>
  <div><router-view /></div>
  <footfoot v-if="hasFoot"></footfoot>
</div>
</template>
<script>
/*
@ type: view
 */
import common from '@/components/common'
import head from '@/views/blog/common/head'
import foot from '@/views/blog/common/foot'
import animation from '@/views/blog/common/animation'

export default {
	extends:common,
	name: 'blog',
	data:function(){
		return {
			hasHead:true,//是否显示头部
			hasFoot:true,//是否显示底部
      hasAnimation:false,//是否显示动画
		}
	},
	methods:{
    openAnimation:openAnimation,
    openFoot:openFoot,
    openHead:openHead,
	},
	components:{
		headhead:head,
		footfoot:foot,
    animation:animation,
	},
}
//显示动画
function openAnimation(status)
{
  this.hasAnimation = status
}
//显示头部
function openHead(status)
{
  this.hasHead = status
}
//显示底部
function openFoot(status)
{
  this.hasFoot = status
}
</script>
<style>

</style>

