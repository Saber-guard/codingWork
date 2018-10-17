import mqtt from 'mqtt'
import Store from '@/libs/Store'
import Axios from '@/libs/Axios'
import md5 from 'js-md5'

let ext = 'codingwork';
let client;

//获取clientid
Axios.curl({
    method:"post",
    url:'system/mqtt_clientid',
    data:{}
}).then(function(response){

	let data = response.data;
	if (data.errno == 0) {
		let option = {
		    clientId:data.data.clientid,
		   	username:data.data.user,
			password:md5(data.data.user+ext),
		};

		client  = mqtt.connect(Store.state._config.MQ_URL,option);

	} else {
		console.log('mqtt连接授权获取失败！');
	}
})//end then

export default client;