import Router from 'vue-router'
import routes from '@/route'

//路由
let routerObj = new Router({
	// mode: 'history',
  	routes: routes,
});

export default routerObj