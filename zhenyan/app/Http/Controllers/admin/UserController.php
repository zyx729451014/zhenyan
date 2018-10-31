<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Http\Requests\UsersStoreRequest;
use App\Http\Requests\DoRegisterRequest;
use Hash;
use App\Models\Userdetail;
use DB;
class UserController extends Controller
{
    /**
     * 浏览用户
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $showCount = $request->input('showCount',5);
        $search    = $request->input('search','');
        // 获取数据
        $user = User::where('uname','like','%'.$search .'%')->paginate($showCount);
        // 加载到列表页面
        return view('admin.user.index',['title'=>'浏览用户','user'=>$user,'request'=>$request->all()]);
    }

    /**
     * 添加用户
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('admin.user.create',['title'=>'添加用户']);
    }

    /**
     * 添加用户成功
     *
     * @return \Illuminate\Http\Response
     */
    public function postStore(UsersStoreRequest $request)
    {
        // 表单验证 
        // use App\Http\Requests\UsersStoreRequest;
    
        // 开启事务 作为回滚点
        DB::beginTransaction();
        // 获取数据 进行添加
        $user = new User;
        $user->uname = $request->input('uname');
        $user->upass = hash::make($request->input('upass'));
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->identity = $request->input('identity');
        $res = $user->save(); // bool
        // 逻辑判断
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/user/index')->with('success', '添加成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','添加失败');
        }  
       
    }

 
     /**
     * 用户详情
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserdetails($id)
    {
        return view('admin.user.userdetails');
    }

    /**
     * 用户删除
     *
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id)
    {
        $res = DB::table('users')->where('uid',$id)->delete();
        // 逻辑判断
        if($res){
            return redirect('admin/user/index')->with('success', '删除成功');
        }else{
            return redirect('admin/user/index')->with('error','删除失败');
        }  

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
        // 判断用户是否存在数据库 没有返回登录页面
        if(!$user){
            return back()->withErrors('没有此用户')->withInput();
        }
        // 验证密码是否正确
        if(($user['upass']) != trim($res['upass']))
        {
            return back()->withErrors('密码错误') -> withInput();
        }else{
            echo '<script>alert("登录成功",location.href="/admin/index")</script>';
        }
        

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
            return redirect('admin/user/login')->with('success', '注册成功');
        }else{
            return back()->with('error','注册失败');
        }
    
    }


   
}
