<template>
<div class="bbb">
	<span v-text="path"></span>
</div>
</template>
<script>
export default {
	name: 'bbb',
	data:function(){
	    return {
			path:this.$route.path,
	    }
	},
}
</script>
<style>

</style>

