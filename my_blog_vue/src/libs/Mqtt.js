import mqtt from 'mqtt'
import md5 from 'js-md5'
import Axios from '@/libs/Axios'
import Store from '@/libs/Store.js'

let ext = 'codingwork';
let mq_url = process.env.MQ_URL;
let connect_option = {
	clean:false,//设置为 false 以在离线时接收 QoS 1 和 2 消息
	connectTimeout:60000,//连接超时时间
	reconnectPeriod:60000,//两次重连的间隔时间
};
let client;
//不同频道接收消息后的回调函数列表
let subscribe_callback_list = {};

let Mqtt = {

	connect:function(){
		//获取clientid,写到session里
		Axios.curl({
		    method:"post",
		    url:'system/mqtt_clientid',
		    data:{}
		}).then(function(response){

			// let data = response.data;
			// if (data.errno == 0) {
			// 	//连接参数
			//     connect_option.clientId=data.data.clientid,
			//    	connect_option.username=data.data.user,
			// 	connect_option.password=md5(data.data.user+ext),
      //
			// 	//连接
			// 	client = mqtt.connect(mq_url,connect_option);
			// 	client.on('connect',connectCallback);
			// 	client.on('reconnect',reconnectCallback);
			// 	client.on('close',closeCallback);
			// 	client.on('error',errorCallback);
			// 	client.on('message',messageCallback);
      //
			// } else {
			// 	console.log('连接授权获取失败！');
			// }

		}.bind(this));

	},

	//发布
	publish:function(topic, message,options,callback){
		client.publish(topic, message,options,callback);
	},
	//订阅
	subscribe:function(topic,options,message_callback){
		subscribe_callback_list[topic] = message_callback;
		client.subscribe(topic,options,subscribeCallback);
	},
	//退订
	unsubscribe:function(topic){
		delete subscribe_callback_list[topic];
		client.unsubscribe(topic,unsubscribeCallback);
	},
	//关闭连接 force 是否强制关闭不等待数据传输完毕
	end:function(force){
		client.end(force,endCallback);
	},
}

//连接事件回调
function connectCallback(){
	if (process.env.DE_BUG) {
		console.log('connect');
	}
	//连接状态
	Store.commit('connectMqtt');
	Mqtt.subscribe('/personal/'+connect_option.clientId,{},function(topic, message,packet){
		console.log('收到'+topic+'频道的消息');
	});
}
//重连事件回调
function reconnectCallback(){
	if (process.env.DE_BUG) {
		console.log('reconnect');
	}
}
//断开连接事件回调
function closeCallback(){
	if (process.env.DE_BUG) {
		console.log('close');
	}
	Store.commit('unconnectMqtt');
}
//连接失败或发生错误事件回调
function errorCallback(error){
	Store.commit('unconnectMqtt');
	console.log('error');
}
//收到消息事件回调
function messageCallback(topic, message, packet){
	if (typeof subscribe_callback_list[topic] != 'undefined') {
		subscribe_callback_list[topic](topic, message,packet);
	} else {
		if (process.env.DE_BUG) {
			console.log('no callback');
		}
	}
}
//订阅频道回调
function subscribeCallback(err, granted){
	if (process.env.DE_BUG && err) {
		console.log('subscribe fail: ',err);
	}
}
//退订频道回调
function unsubscribeCallback(err, granted){
	if (process.env.DE_BUG && err) {
		console.log('unsubscribe fail: ',err);
	}
}
//主动关闭连接回调
function endCallback(){

}


export default Mqtt;
