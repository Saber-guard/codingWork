//导入类库
import Vue from '@/libs/Vue.js'
import Router from '@/libs/Route.js'
import Store from '@/libs/Store.js'
import Axios from '@/libs/Axios'
import Cookie from '@/libs/Cookie'
import Func from '@/libs/Func'
import Mqtt from '@/libs/Mqtt'
import $ from 'jquery'


//导入组件
import App from '@/components/App'

//导入全局样式
import '@/assets/css/base.css'
import '@/assets/css/font-awesome.min.css'
import '@/assets/css/element-css/index.css'// element自定义主题
// import 'element-ui/lib/theme-chalk/index.css'

//调试模式
Vue.config.productionTip = Store.state._config.DE_BUG

Vue.prototype.$axios = Axios.curl
Vue.prototype.$cookie = Cookie
Vue.prototype.$func = Func
Vue.prototype.$Vue = Vue

console.log(Mqtt)

//创建Vue实例
new Vue({
	el: '#app',
	router:Router,
	store:Store,
	template: '<App/>',
	components: {
		App:App,
	}
})
