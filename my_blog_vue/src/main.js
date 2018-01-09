//导入类库
import Vue from '@/libs/Vue.js'
import Router from '@/libs/Route.js'
import Store from '@/libs/Store.js'
import Axios from '@/libs/Axios'
import Cookie from '@/libs/Cookie'

//导入组件
import App from '@/components/App'

//调试模式
Vue.config.productionTip = true
Vue.prototype.$axios = Axios.curl
Vue.prototype.$cookie = Cookie

//创建Vue实例
new Vue({
	el: '#app',
	router:Router,
	store:Store,
	template: '<App/>',
	components: {
		App:App
	}
})
