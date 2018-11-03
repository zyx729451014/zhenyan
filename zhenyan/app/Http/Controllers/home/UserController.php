<?php

namespace App\Http\Controllers\home;
 
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use DB;
use Hash;
use Crypt;
use App\Models\Userdateail;

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
        $res1 = $user->save(); // bool
        $id = $user->id;
        $userdateail = new Userdateail;
        $userdateail->uid = $id;
        $res2 = $userdateail->save();
        // 逻辑判断
        if($res1 && $res2){
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
            echo '<script>alert("登录成功",location.href="/");</script>';
            session(['user'=>$user]);
        }else{
            echo '<script>alert("密码错误",location.href="/home/user/login");</script>';
        }      
    } 


    /**
     * 前退出登录
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
       $request->session()->flush();
       return redirect('home/user/login');

    }


    /**
     * 个人中心
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserdateail()
    {
        $id = session('user')->uid;
        $user = User::where('uid',$id)->first();
        $userinfo = $user->userinfo;
        // 加载模板
        return view('home.user.userdateail',['userinfo'=>$userinfo,'user'=>$user]);
    }

    /**
     * 我的资料
     *
     * @return \Illuminate\Http\Response
     */
    public function getInformation()
    {
        $id = session('user')->uid;
        $user = User::where('uid',$id)->first();
        $userinfo = $user->userinfo;
        // 加载模板
        return view('home.user.information',['userinfo'=>$userinfo]);
    }

    /**
     * 资料保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request,$id)
    {
        // 获取一条数据
         $userdateail = Userdateail::where('uid',$id)->first();
        if($request->hasFile('face')){
            $profile = $request -> file('face');
            // 获取文件后缀
            $ext = $profile ->getClientOriginalExtension(); 
            $file_name = str_random('20').'.'.$ext;
            $dir_name = './uploads/'.date('Ymd',time());
            $res = $profile -> move($dir_name,$file_name);
            // 拼接数据库存放路径
            $profile_path = ltrim($dir_name.'/'.$file_name,'.');        
        }else{
            $profile_path = $userdateail->face;
        }
        $userdateail->face = $profile_path;
        $userdateail->sex = $request->input('sex');
        $userdateail->birthdate = $request->input('birthdate');
        $userdateail->point = $request->input('point');
       
        $res = $userdateail->save();
        // 逻辑判断
        if($res){
            echo "<script>alert('编辑资料成功！',location.href='/home/user/information')</script>";
        }else{
            echo "<script>alert('编辑资料失败！',location.href='/home/user/information')</script>";
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
