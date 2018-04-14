<?php

//用户模块
Route::group(['namespace' => 'User','prefix' => 'user'], function(){

});

//cms模块
Route::group(['namespace' => 'Cms','prefix' => 'cms'], function(){
    Route::get('category_list', 'Category@categoryListGet');

    Route::get('article_list', 'Article@articleListGet');

    Route::get('article', 'Article@articleGet');
    Route::post('article', 'Article@articlePost');
    Route::put('article/{id}', 'Article@articlePut');

});


