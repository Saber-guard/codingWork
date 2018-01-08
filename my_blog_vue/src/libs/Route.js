import Router from 'vue-router'

import aaa from '@/views/aaa'
let routes = [
    {
      	path: '/aaa',
      	name: 'aaa',
      	component: aaa,
    }
]

//路由
let routerObj = new Router({
	// mode: 'history',
  	routes: routes
});

export default routerObj