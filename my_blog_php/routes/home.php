<?php

//用户模块
Route::group(['namespace' => 'User','prefix' => 'user'], function(){
	//新增授权(即登录)
	Route::post('access', 'User@accessPost');
	//删除授权(即退出)
	
	//新增用户(注册)
	Route::post('user', 'User@userPost');
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

