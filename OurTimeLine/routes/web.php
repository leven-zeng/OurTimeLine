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

Route::any('/', ['uses'=>'TimeLineController@index']);

Auth::routes();

Route::get('/home', 'HomeController@index');


//后台Admin的路由
Route::any('/admin',['as'=>'admin.index','middleware'=>['auth'],'uses'=>'Admin\AdminController@index']);

//Route::get('admin/index', ['as' => 'admin.index', 'middleware' => ['auth','menu'], 'uses'=>'Admin\\IndexController@index']);
