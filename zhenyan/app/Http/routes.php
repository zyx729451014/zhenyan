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
    return view('home.index.index');
});
/**
 *
 *	后台路由
 * 
 */
Route::group(['middleware'=>'login'],function(){
	Route::resource('/admin/links','admin\LinksController'); // 后台友情链接管理
	Route::resource('/admin/cates','admin\CatesController'); // 后台类别管理
	Route::controller('/admin/user','admin\UserController'); // 后台用户管理
	Route::resource('/admin/web','admin\WebController'); // 后台网站管理
	Route::resource('/admin/slid','admin\SlidController'); // 后台轮播图管理 
	Route::resource('/admin/adver','admin\AdverController');	// 后台推荐位广告	
	Route::resource('/admin/glossary','admin\GlossaryController');	// 后台图集	
	Route::resource('/admin/invitation','admin\InvitationController');	// 后台帖子管理	
	Route::resource('/admin/notice','admin\NoticeController'); // 后台公告管理
});
Route::controller('/admin/login','admin\LoginController');   // 后台 注册 登录

/**
 *
 *	前台路由
 * 
 */
Route::controller('/home/user','home\UserController');   // 前台用户管理 注册 登录
Route::get('/home/invitation/{id}','home\InvitationController@index');	//前台列表
Route::resource('/home/glossary','home\GlossaryController'); //前台图文
Route::get('/home/invitation/create','home\InvitationController@create'); //前台帖子发布
Route::post('/home/invitation/store','home\InvitationController@store'); //前台帖子发布判断
Route::get('/home/invitation/show/{id}','home\InvitationController@show');	//前台帖子详情

