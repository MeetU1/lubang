<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*Route::get('e', function () {
    return view('hello word!');
});*/
Route::get('/hello','HelloController@Hello');

Route::any('/weixin2','WeixinController@weixin');
Route::any('/wechat','WechatController@serve');
