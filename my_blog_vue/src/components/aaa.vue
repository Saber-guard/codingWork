<template>
<div class="aaa">
	<span @click="toto">{{baseURL}}</span>
<router-view/>
</div>
</template>
<script>
import common from './common.js'

export default {
	extends:common,
	name: 'aaa',
	data:function(){
	    return {
			path:this.$route.path,
	    }
	},
	methods:{
		toto:function(){
			this.axios({
			    method:"POST",
			    url:'zhibo/zhibolist',
			    //baseURL:'http://app.douniu.com/index.php/',
			    data:{
					"sid":1,
					"index":1,
					"ub_id":4,
					"uo_long":12,
					"uo_lat":13,
					"uo_high":14,
					"order":0,
					"page":1
			    }
			})
		}
	},
}

</script>
<style>

</style>

