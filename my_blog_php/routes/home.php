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
    //栏目详情
    Route::get('category', 'Category@categoryGet');

    //文章列表
    Route::get('article_list', 'Article@articleListGet');

    //文章
    Route::get('article', 'Article@articleGet');
    Route::post('article', 'Article@articlePost');
    Route::put('article/{id}', 'Article@articlePut');

    //点赞
    Route::put('zan/{id}', 'Article@zanPut');


    //小说
    Route::get('novel_list', 'Novel@novelListGet');
    Route::post('novel', 'Novel@novelPost');
    Route::delete('novel', 'Novel@novelDelete');

    Route::get('novel_clicks_now', 'Novel@novelClicksNowGet');
    Route::get('novel_clicks_history', 'Novel@novelClicksHistoryGet');

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
    //获取客户端连接数
    Route::get('mqtt_client_count', 'Mqtt@clientCountGet');

});

//voice模块
Route::group(['namespace' => 'Voice','prefix' => 'voice'], function(){
    // strToVoice
    Route::get('strToVoice', 'VoiceController@strToVoice');
});
