var redis = require('redis');
var mosca = require('mosca');


var config = {};
//redis配置
var redisSettings = {
    host:'47.98.195.63',
    port: '16379',
    password:'codingwork_redis',
}
//发布订阅模型配置
var backEndSettings = {
    type: 'redis',
    redis: redis,
    port: redisSettings.port,
    host:redisSettings.host,
    return_buffers: true,
    password:redisSettings.password,
};
//持久化db配置
var persistenceSettings = {
    factory: mosca.persistence.Redis,
    host:redisSettings.host,
    port:redisSettings.port,
    password:redisSettings.password,
}
//http
var httpSettings = {
    port:80,//web端连接端口
    bundle:true,
    static:'./',
}
//server配置
var moscaSettings = {
    port:1884,//客户端连接端口
    backend:backEndSettings,
    persistence:persistenceSettings,
    http:httpSettings,
};
config.redisSettings = redisSettings;
config.backEndSettings = backEndSettings;
config.persistenceSettings = persistenceSettings;
config.moscaSettings = moscaSettings;


module.exports = config;
