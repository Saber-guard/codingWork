<template>
<div class="bbb">
	<el-button @click="startHacking">Start</el-button>
</div>
</template>
<script>
import common from '@/components/common'
export default {
	extends:common,
	name: 'bbb',
	data:function(){
	    return {
			path:this.$route.path,
	    }
	},
  created:function(){
    console.log(456)
  },
	methods: {
		startHacking () {
			this.$notify({
				title: 'It works!',
				type: 'success',
				message: 'We\'ve laid the ground work for you. It\'s time for you to build something epic!',
				duration: 5000
			})
		}
	}
}
</script>
<style>

</style>

