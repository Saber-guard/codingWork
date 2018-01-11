import Router from 'vue-router'

import aaa from '@/views/aaa'
import bbb from '@/views/bbb'
import blog from '@/views/blog/blog'
import blog_list from '@/views/blog/list'
let routes = [
    {
      	path: '/aaa',
      	name: 'aaa',
      	component: aaa,
    },
    {
      	path:'/blog',
        name:'blog',
        component:blog,
        children:[
            {
                path: 'list',
                name: 'list',
                component: blog_list,
            },
        ],
    }
]

//路由
let routerObj = new Router({
	// mode: 'history',
  	routes: routes
});

export default routerObj