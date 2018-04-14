import Vuex from 'vuex'

let stores = {
	state: {
		//接口路径
		API_URL: 'http://codingwork.com',
		// //视图目录
		// VIEW_PATH: '@/views/',
		// //组件目录
		// COMP_PATH: '@/components/',
		// //类库目录
		// LIB_PATH: '@/libs/',
		// //静态资源目录
		// ASSETS_PATH: '@/assets/',
	},
}

//vuex
let storeObj = new Vuex.Store(stores)

export default storeObj
