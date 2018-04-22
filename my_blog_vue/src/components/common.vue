<script>
import Vue from 'vue'

export default {
	// data:function (){
    // return {
    //
    // }
	// },
  computed: {
    //公共配置
    config:function(){
      return this.$store.getters.getConfig
    },
	  //公共数据
	  common_data:function(){
	    return this.$store.getters.getCommonData
    }
  },
  created:function(){
    this.$store.commit('login')
  }
}
</script>
