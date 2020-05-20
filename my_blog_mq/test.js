var mqtt = require('mqtt');

var host = 'mqtt://mq.codingwork.cn:8002';
var client  = mqtt.connect(host,{
    keepalive:0,
    clientId:"784a679e50058b9eeb4ba462892ec6550d0b260d:1539784124",
    reconnectPeriod:false,
   	username:"784a679e50058b9eeb4ba462892ec6550d0b260d",
	password:"679bffcd0bf3568858e059178bc7696c",
	clean: false,
});
client.on('connect', function () {
	console.log(123)
});
client.on('error', function (error) {
        console.log(error)
});

