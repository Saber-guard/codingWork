<script>
import Vue from 'vue'
import Axios from '@/libs/Axios'
import Cookie from '@/libs/Cookie'

export default Vue.extend({
	data:function (){
	    return {
	    	API_URL:this.$store.state.API_URL,
	    	axios:Axios.curl,
	    	cookie:Cookie,
	    }
	},
})
</script>
