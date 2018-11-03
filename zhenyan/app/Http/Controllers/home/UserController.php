<?php

namespace App\Http\Controllers\home;
 
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use Crypt;

class UserController extends Controller
{ 


    /**
     * 前台注册
     */
    public function getRegister()
    {
        return view('home.user.register');
    }

     /**
     * 前台注册成功
     *
     * @return \Illuminate\Http\Response
     */
    public function postDoregister(Request $request)
    {
       // 获取数据 进行添加
        $user = new User;
        $user->uname = $request->input('uname');
        $user->upass = hash::make($request->input('upass'));
        $res = $user->save(); // bool
        // 逻辑判断
        if($res){
            echo "<script>alert('恭喜您注册成功,快去登录吧！',location.href='/home/user/login')</script>";
        }else{
            echo "<script>alert('很遗憾您注册失败了',location.href='')</script>";
        }

    } 

    //  验证用户名
    public function postCheckname()
    {
        $name = $_POST['uname'];
        $data = User::where('uname',$name)->first();
        if ($data) {
           echo "error";
           
        }else{
            echo "success";
           
        }
        
    }

    /**
     * 前台登录
     */
    public function getLogin()
    {
        return view('home.user.login');
    }

     /**
     * 前台登录成功
     *
     * @return \Illuminate\Http\Response
     */
    public function postDologin(Request $request)
    {
       // 判断用户输入
        $res = $request->except('_token');
        // 查询数据库用户 
        $user = User::where('uname',$res['uname'])->first();
        // 判断用户是否存在数据库 没有返回登录页面
        if(!$user){
            echo '<script>alert("此用户不存在",location.href="/home/user/login");</script>';
        }
        // 判断密码错误
        if (Hash::check($res['upass'],$user['upass'])) {
             session(['homeUserInfo'=>$user]);
             // dump(session('homeUserInfo')['uid']);
             // exit;
            echo '<script>location.href="/";</script>';
        }else{
            echo '<script>location.href="/home/user/login;</script>';
        }
    
      
    } 









    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
