<template>
<div class="blog">
	<headhead></headhead>
	<router-view/>
	<footfoot></footfoot>
</div>
</template>
<script>
import common from '@/components/common'
import head from '@/views/blog/head'
import foot from '@/views/blog/foot'

export default {
	extends:common,
	name: 'blog',
	methods:{

	},
	components:{
		headhead:head,
		footfoot:foot,
		// list:list,
	},
	
}

</script>
<style>

</style>

