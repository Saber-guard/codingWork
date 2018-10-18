import Vuex from 'vuex'
import Cookie from '@/libs/Cookie'

let stores = {
	state: {
	  _config:{
	    //调试模式
      // DE_BUG:process.env.DE_BUG,
      //接口路径
      // API_URL: process.env.API_URL,
      //MQ服务地址
      // MQ_URL: 'mqtt://mq.codingwork.cn:8002',
      // API_URL: 'http://codingwork.com',
      // API_URL: 'http://api.codingwork.cn',
      // //视图目录
      // VIEW_PATH: '@/views/',
      // //组件目录
      // COMP_PATH: '@/components/',
      // //类库目录
      // LIB_PATH: '@/libs/',
      // //静态资源目录
      // ASSETS_PATH: '@/assets/',
    },

    //用户信息
    _common_data:{
	    user_info:{},
    },
	},
  mutations:{
	  //登录
    login:function(state,user_info){
      //转从cookie里获取user_info
      user_info = Cookie.getCookie('user_info')
      // console.log('login')
      state._common_data.user_info = user_info?user_info:{};
    },
    //退出
    logout:function(state){
      state._common_data.user_info = {}
    }
  },
  getters:{
	  //获得公共配置
    getConfig:function(state){
      return state._config
    },
    //获取公共数据
    getCommonData:function(state){
      return state._common_data
    },
  },
  actions:{

  }
}

//vuex
let storeObj = new Vuex.Store(stores)

export default storeObj
