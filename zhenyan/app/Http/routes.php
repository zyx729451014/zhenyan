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

Route::get('/admin/index', function () {
    return view('admin.index.index');
});
Route::controller('/admin','admin\UserController');
// 后台注册页面
Route::get('/admin/login','admin')