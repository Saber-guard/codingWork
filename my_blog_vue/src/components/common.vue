<script>
import Vue from 'vue'

export default {
	data:function (){
		//先获取store里的数据
		let common_data = this.$store.state

	    return common_data
	},
}
</script>
