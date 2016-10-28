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


//��̨Admin��·��
Route::any('/admin',['as'=>'admin.index','middleware'=>['auth'],'uses'=>'Admin\AdminController@index']);

//Route::get('admin/index', ['as' => 'admin.index', 'middleware' => ['auth','menu'], 'uses'=>'Admin\\IndexController@index']);

Route::any('/admin/addtimeline',['as'=>'admin.addtimeline','middleware'=>['auth'],'uses'=>'Admin\AdminController@addtimeline']);

Route::any('/admin/uploadimg',['as'=>'admin.UploadImg','middleware'=>['auth'],'uses'=>'Admin\AdminController@UploadImg']);

Route::any('/admin/imgtest',['as'=>'admin.imgtest','middleware'=>['auth'],'uses'=>'Admin\AdminController@imgtest']);
