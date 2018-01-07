import Vue from 'vue'
import axios from 'axios'

export default Vue.extend({
	data:function (){
	    return {
	    	baseURL:this.$store.state.baseURL,
	    	axios:axios.create({
	    		baseURL:this.$store.state.baseURL,
	    	}),
	    }
	},
})
