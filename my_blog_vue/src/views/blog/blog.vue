<template>
<div class="blog">
	<headhead v-if="hasHead"></headhead>
	<router-view/>
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

export default {
	extends:common,
	name: 'blog',
	data:function(){
		return {
			hasHead:true,
			hasFoot:true,
		}
	},
	methods:{

	},
	components:{
		headhead:head,
		footfoot:foot,
	},
}

</script>
<style>

</style>

