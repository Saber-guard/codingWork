import admin from '@/views/admin/admin'
import mqtt from '@/views/admin/mqtt/mqtt'
import id_list from '@/views/admin/mqtt/id_list'
import active_client from '@/views/admin/mqtt/active_client'


export default [
  {
    path: '/',
    redirect: '/admin',
  },
  {
    path: '/admin',
    name: 'admin',
    component: admin,
    children:[
      {
        path:'mqtt',
        name:'mqtt',
        component:mqtt,
        children:[
          {
            path:'id_list',
            name:'id_list',
            component:id_list,
          },
          {
            path:'active_client',
            name:'active_client',
            component:active_client,
          },
        ]
      }

    ],
  },
]
