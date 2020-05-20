var redis = require("redis");
var config = require('./config');

//选项
var option = {
    port:config.redisSettings.port,
    host:config.redisSettings.host,
    password:config.redisSettings.password,
};
//连接
var client = redis.createClient(option);
client.on("error", function (err) {
    console.log("redis连接失败:" , err);
    process.exit();
});
client.on('connect', function(){
    console.log('Redis连接成功.');
});

//自定义回调
client.callback = function(err,result){
    if (err) {
	console.log(err);
    }
}

//模块出口
module.exports = client;
