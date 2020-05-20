var mosca = require('mosca');
var md5=require('md5');
var CircularJSON = require('circular-json');
var config = require('./config');
var redis = require('./redis');
var axios = require('./axios');

//开启服务
var server = new mosca.Server(config.moscaSettings);

//服务开启事件
server.on('ready',function(){
    console.log('服务开启');
    redis.expire('mqtt:clients',1);
});



//客户端连接事件
server.on('clientConnected', function (client) {
    //排除发布客户端
    var reg = /codingwork_publish:(\d)+/
    if (reg.test(client.id))
	return true;

    //保存到redis
    redis.hset('mqtt:clients',client.id,CircularJSON.stringify(client),function(){
        redis.hlen('mqtt:clients',function(err,len){
            //通知其他客户端
                message = {
                topic:'/public/online',
                payload:len.toString(),
                qos:0,
                retain:true
                }
                server.publish(message,function(){});

        });
    });
});

//客户端关闭事件
server.on('clientDisconnected', function (client) {
    //排除发布客户端
    var reg = /codingwork_publish:(\d)+/
        if (reg.test(client.id))
            return true;

    //从redis中去除
    redis.hdel('mqtt:clients',client.id,function(){
 	redis.hlen('mqtt:clients',function(err,len){
	    //通知其他客户端
    	    message = {
	        topic:'/public/online',
	        payload:len.toString(),
	        qos:0,
	        retain:true
    	    }
    	    server.publish(message,function(){});

	});
    });
});

//客户端验证
server.authenticate = function(client, username, password, callback) {
    password = password.toString();
    //验证
    axios.curl({
        method:"get",
        url:'system/mqtt_connect_access',
        params:{
            "client_id":client.id,
            "username":username,
            "password":password,
        }
    }).then(function(response){
	var allow = response.data.errno==0?true:false;
	callback(null,allow);
    });

};

server.authorizeSubscribe = function(client, topic, callback){
    callback(null,true);
}
server.authorizePublish = function(client, topic, callback){
    callback(null,true);
}
