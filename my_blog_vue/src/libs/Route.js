import Router from 'vue-router'

import aaa from '@/views/aaa'
import bbb from '@/views/bbb'
let routes = [
    {
      	path: '/aaa',
      	name: 'aaa',
      	component: aaa,
    },
    {
      	path: '/bbb',
      	name: 'bbb',
      	component: bbb,
    }
]

//路由
let routerObj = new Router({
	// mode: 'history',
  	routes: routes
});

export default routerObj