import axios from 'axios'
import Store from '@/libs/Store'
import md5 from 'js-md5';

class Axios{
    // 构造
    constructor(){

    }

    curl(param) {
      let defaultParam = {
        baseURL:Store.state._config.API_URL,
      };

    	for (let i in param) {
    	  let value = typeof param[i] == 'object' || param[i] instanceof Array ?
          JSON.parse(JSON.stringify(param[i])) : param[i];

        defaultParam[i] = value;
    	}

    	//生成sig
      if (typeof defaultParam['data'] == 'undefined') {
    	  //无data无params时
        if (typeof defaultParam['params'] == 'undefined') {
          defaultParam['params'] = {}
        }
        //无data有params时
        defaultParam.params.sig = getSig(defaultParam,0);

      } else {
    	  //有data时
        defaultParam.data.sig = getSig(defaultParam,1);
      }

    	return axios(defaultParam).catch(function(error){
    	  //调试模式
        if (Store.state._config.DE_BUG) {
          console.log(error)
        }
      })
    }

}

function getSig(defaultParam,type)
{
  let datas = type == 0 ? defaultParam.params : defaultParam.data ;
  //取键组成数组
  let keys = [];
  for (let i in datas) {
    keys.push(i);
  }
  //倒叙
  keys.sort();
  //按照此顺序拼接
  let str = defaultParam.baseURL+'/'+ defaultParam.url;
  for (let i in keys) {
    let key = keys[i];
    let value = typeof datas[keys[i]] == 'object' || datas[keys[i]] instanceof Array ?
      JSON.stringify(datas[keys[i]]) : datas[keys[i]] ;
    str += key +'=' +value
  }
  //加密
  str = md5(str);
  //截取25位
  str = str.substr(1,25);
  // console.log(str);
  return str;
}


export default new Axios()
