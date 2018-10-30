<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 显示后台登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('admin.index.index');
    }
    /**
     * 显示后台登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('admin.user.login');
    }

    /**
     * 显示后台注册页面
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('admin.user.register');
    }
   
}
