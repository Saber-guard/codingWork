import axios from 'axios'
import md5 from 'js-md5'

class Axios{
    // 构造
    constructor(){

    }

    curl(param) {
      //method只能是get post put delete
      if (typeof param['method'] == 'undefined' || (
          param['method'] != 'get' && param['method'] != 'post' &&
          param['method'] != 'put' && param['method'] != 'delete'
        ))
        param['method'] = 'get'




      let defaultParam = {
        baseURL:process.env.API_URL,
      };

      if (param['method'] != 'get') {
        delete param['params']
      }

    	for (let i in param) {
    	  let value = typeof param[i] == 'object' || param[i] instanceof Array ?
          JSON.parse(JSON.stringify(param[i])) : param[i];

        defaultParam[i] = value;
    	}

    	//生成sig
      //非get
      if (defaultParam['method'] != 'get') {
        //非get请求不允许传param
        if (typeof defaultParam['params'] != 'undefined') {
          delete defaultParam.params
        }

        //必须有data 且为object
        if (typeof defaultParam['data'] != 'object') {
          defaultParam.data = {}
        }

        let sig = getSig(defaultParam,1);
        defaultParam.data = {
          sig:sig,
          data:JSON.stringify(defaultParam.data)
        }


      //get
      } else {
        //get必须有params 且为object
        if (typeof defaultParam['params'] != 'object') {
          defaultParam['params'] = {}
        }
        let sig = getSig(defaultParam,0);
        defaultParam.params = {
          sig:sig,
          data:JSON.stringify(defaultParam.params)
        }
      }


    	return axios(defaultParam).catch(function(error){
    	  //调试模式
        if (process.env.DE_BUG) {
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
  let str = '/'+ defaultParam.url;
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
