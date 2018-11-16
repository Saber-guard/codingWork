import aaa from '@/views/aaa'
import bbb from '@/views/bbb'
import ccc from '@/views/ccc'
import blog from '@/views/blog/blog'
import blog_category from '@/views/blog/category/category'
import blog_list from '@/views/blog/list/list'
import blog_article from '@/views/blog/article/article'

export default [
    {
      	path: '/aaa',
      	name: 'aaa',
      	component: aaa,
    },
    {
        path: '/bbb',
        name: 'bbb',
        component: bbb,
    },
    {
        path: '/ccc',
        name: 'ccc',
        component: ccc,
    },
    {
      path: '/',
      redirect: '/blog/category',
    },
    {
      	path:'/blog',
        name:'blog',
        component:blog,
        redirect: '/blog/category',
        children:[
            {
                path: 'category',
                name: 'category',
                component: blog_category,
            },
            {
                path: 'list/:id',
                name: 'list',
                component: blog_list,
            },
            {
                path: 'article/:id',
                name: 'article',
                component: blog_article,
            },
        ],
    },
]
