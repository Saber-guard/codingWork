const aaa = () => import('@/views/aaa')
const bbb = () => import('@/views/bbb')
const ccc = () => import('@/views/ccc')
const blog = () => import('@/views/blog/blog')
const blog_category = () => import('@/views/blog/category/category')
const blog_list = () => import('@/views/blog/list/list')
const blog_article = () => import('@/views/blog/article/article')

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
