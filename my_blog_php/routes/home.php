<?php

//用户模块
Route::group(['namespace' => 'User','prefix' => 'user'], function(){
	//新增授权(即登录)
	Route::post('access', 'User@accessPost');
	//删除授权(即退出)

	//新增用户(注册)
	Route::post('user', 'User@userPost');

    //获取访问量
    Route::get('visitor_num', 'Visitor@visitorNumGet');
});

//cms模块
Route::group(['namespace' => 'Cms','prefix' => 'cms'], function(){
	//目录列表
    Route::get('category_list', 'Category@categoryListGet');

    //文章列表
    Route::get('article_list', 'Article@articleListGet');

    //文章
    Route::get('article', 'Article@articleGet');
    Route::post('article', 'Article@articlePost');
    Route::put('article/{id}', 'Article@articlePut');

    //点赞
    Route::put('zan/{id}', 'Article@zanPut');

});

//system模块
Route::group(['namespace' => 'System','prefix' => 'system'], function(){
    //获取将文件上传到oss的签名
    Route::get('upload_sig', 'Upload@uploadSigGet');

    //获取oss的文件访问路径
    // Route::get('file_url', 'File@fileUrlGet');
    //访问文件
    Route::get('file', 'File@fileGet');

    //新增mqtt连接授权clientID
    Route::post('mqtt_clientid', 'Mqtt@mqttClientIdPost');
    //获取mqtt的连接授权
    Route::get('mqtt_connect_access', 'Mqtt@connectAccessGet');
    //获取mqtt发布授权
    Route::get('mqtt_publish_access', 'Mqtt@publishAccessGet');
    //获取mqtt订阅授权
    Route::get('mqtt_subscribe_access', 'Mqtt@subscribeAccessGet');
    //client连接回调
    Route::get('mqtt_connect_callback', 'Mqtt@connectCallbackGet');
    //client断开回调
    Route::get('mqtt_close_callback', 'Mqtt@closeCallbackGet');




});

