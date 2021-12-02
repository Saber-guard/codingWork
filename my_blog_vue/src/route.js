const aaa = () => import('@/views/aaa')
const bbb = () => import('@/views/bbb')
const ccc = () => import('@/views/ccc')
const blog = () => import('@/views/blog/blog')
const blogCategory = () => import('@/views/blog/category/category')
const blogList = () => import('@/views/blog/list/list')
const blogArticle = () => import('@/views/blog/article/article')
const investment = () => import('@/views/investment/investment')
const investmentCompanyList = () => import('@/views/investment/company/companyList')

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
                component: blogCategory,
            },
            {
                path: 'list/:id',
                name: 'list',
                component: blogList,
            },
            {
                path: 'article/:id',
                name: 'article',
                component: blogArticle,
            },
        ],
    },
    {
      path:'/investment',
      name:'investment',
      component:investment,
      redirect: '/investment/companyList',
      children:[
          {
              path: 'companyList',
              name: 'companyList',
              component: investmentCompanyList,
          },
      ],
    },
]
