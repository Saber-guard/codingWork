<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function ()
{
    return view('welcome');
});

//前台接口路由组
Route::group(['namespace' => 'Home'], function (){

    include 'home.php';

});

//后台接口路由组
Route::group(['namespace' => 'Admin','prefix' => 'admin'], function (){

	include 'admin.php';

});
