import axios from 'axios'
import Store from '@/libs/Store'


class Axios{
    // 构造
    constructor(){

    }

    curl(param) {
      var defaultParam = {
        baseURL:Store.state.API_URL
      }

    	for (var i in param) {
        defaultParam[i] = param[i]
    	}
    	return axios(defaultParam)
    }

}

export default new Axios()
