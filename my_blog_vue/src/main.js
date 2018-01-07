import Vue from 'vue'
import Router from 'vue-router'
import Vuex from 'vuex'

import routes from './route'
import stores from './store'
import App from './components/App'


Vue.config.productionTip = true
Vue.use(Router);
Vue.use(Vuex);

//路由
let router = new Router({
	// mode: 'history',
  	routes: routes
});
//vuex
let store = new Vuex.Store(stores)

new Vue({
	el: '#app',
	router:router,
	store:store,
	template: '<App/>',
	components: {
		App:App
	}
})
