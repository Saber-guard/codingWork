<template>
<div class="aaa">
	<span @click="setCookie">{{API_URL}}</span>
<router-view/>
</div>
</template>
<script>
import common from '@/components/common'

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
		},
		setCookie:function(){
			// this.cookie.setCookie('aa',1234)
			console.log(this.cookie.getCookie('aa'))
		}
	},
}

</script>
<style>

</style>

