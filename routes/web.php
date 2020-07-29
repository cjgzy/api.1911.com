<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get("/wx/add","A\AddController@add");
Route::get('add',"TestController@add");
Route::post("test/create","Test\TestController@create");
Route::post("test/login","Test\TestController@login");
Route::get('test/center',"Test\TestController@center");
Route::post("cre","TestController@cre");
Route::get("rsa1","TestController@rsa1");
Route::get("sign","TestController@sign");
Route::get("goods","TestController@goods");
Route::get("goodslist","TestController@goodslist");
