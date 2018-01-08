import axios from 'axios'
import Store from '@/libs/Store'

var defaultParam = {
	baseURL:Store.state.API_URL
}

class Axios{
    // 构造
    constructor(){

    }

    curl(param) {
    	for (var i in param) {
    		defaultParam[i] = param[i]
    	}
    	return axios(defaultParam)
    }

}

export default new Axios()