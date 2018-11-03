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
        $res1 = $user->save(); // bool
        $id = $user->id;
        $userdateail = new Userdateail;
        $userdateail->uid = $id;
        $res2 = $userdateail->save();
        // 逻辑判断
        if($res1 && $res2){
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

    

   
 


   
}
