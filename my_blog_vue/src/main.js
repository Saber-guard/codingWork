//导入类库
import Vue from '@/libs/Vue.js'
import Router from '@/libs/Route.js'
import Store from '@/libs/Store.js'
import $ from 'jquery'

//导入组件
import App from '@/components/App'

//导入全局样式
import 'element-ui/lib/theme-chalk/index.css'

var aaaaa = 123
//调试模式
Vue.config.productionTip = true

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
