import aaa from '@/views/aaa'
import bbb from '@/views/bbb'
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
      	path:'/blog',
        name:'blog',
        component:blog,
        children:[
            {
                path: 'category',
                name: 'category',
                component: blog_category,
            },
            {
                path: 'list',
                name: 'list',
                component: blog_list,
            },
            {
                path: 'article',
                name: 'article',
                component: blog_article,
            },
        ],
    },
]
