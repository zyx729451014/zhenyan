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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/admin/links','admin\LinksController'); // 后台友情链接管理
Route::resource('/admin/cates','admin\CatesController'); // 后台类别管理
Route::controller('/admin/user','admin\UserController');// 用户管理 注册 登录
Route::resource('/home/index','home\IndexController');  //前台首页 
Route::get('/home/invitation/{id}','home\InvitationController@index');	//前台列表
Route::resource('/admin/adver','admin\AdverController');	//后台推荐位广告