<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoRegisterRequest;
use App\User;
use Hash;

class LoginController extends Controller
{
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
     * 后台登录成功
     *
     * @return \Illuminate\Http\Response
     */
    public function postDologin(Request $request)
    {
        // 判断用户输入
        $res = $request->except('_token');
        // 查询数据库用户 
        $user = User::where('uname',$res['uname'])->first();
        session(['uname'=>$res['uname']]);
        // 判断用户是否存在数据库 没有返回登录页面
        if(!$user){
            return back()->withErrors('没有此用户')->withInput();
        }
      // 判断密码错误
        if (Hash::check($res['upass'],$user['upass'])) {
            return redirect('admin/user/index');
        }else{
            return back()->withErrors('密码错误')->withInput();
        }
    }


     /**
     * 后台退出登录
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
       $request->session()->flush();
       return redirect('admin/login/login');

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

    /**
     * 后台注册成功
     *
     * @return \Illuminate\Http\Response
     */
    public function postDoregister(DoRegisterRequest $request)
    {
        // 获取数据 进行添加
        $user = new User;
        $user->uname = $request->input('uname');
        $user->upass = hash::make($request->input('upass'));
        $res = $user->save(); // bool
        // 逻辑判断
        if($res){
            return redirect('admin/login/login')->with('success', '注册成功');
        }else{
            return back()->with('error','注册失败');
        }
    
    }
}
