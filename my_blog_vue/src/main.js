//导入类库
import Vue from '@/libs/Vue.js'
import Router from '@/libs/Route.js'
import Store from '@/libs/Store.js'
import Axios from '@/libs/Axios'
import Cookie from '@/libs/Cookie'
import $ from 'jquery'


//导入组件
import App from '@/components/App'

//导入全局样式
import '@/assets/css/base.css'
import '@/assets/css/font-awesome.min.css'
import 'element-ui/lib/theme-chalk/index.css'

//调试模式
Vue.config.productionTip = true
Vue.prototype.$axios = Axios.curl
Vue.prototype.$cookie = Cookie
Vue.prototype.$Vue = Vue

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
