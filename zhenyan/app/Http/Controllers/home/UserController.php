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
use App\Models\Glossary;
use App\Models\Glocomment;
use App\Models\Glocollect;
use App\Models\Invi_collect;
use App\Models\Invitation;
use App\Models\Invi_comment;

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
        $id = $user->uid;
        $userdateail = new Userdateail;
        $userdateail->uid = $id;
        $userdateail->point = 200;
        $res2 = $userdateail->save();
        // 逻辑判断
        if($res1 && $res2){
            return redirect('/home/user/login');
        }else{
            echo "<script>alert('很遗憾您注册失败了');";
        }

    } 

    //  验证用户名
    public function postCheckname()
    {
        $name = $_POST['uname'];
        $data = User::where('uname',$name)->first();
        if ($data) {
           // 用户名存在返回error
           echo "error";  
        }else{
            // 用户不存在返回success
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
        $uname = $_POST['uname'];
        $upass = $_POST['upass'];
        // 查询数据库用户 
        $user = User::where('uname',$uname)->first();
        // 判断密码错误
        if (Hash::check($upass,$user['upass'])) {
            session(['user'=>$user]);
            // 用户登录积分加10
            $user = Userdateail::find($user->uid);
            $user->point +=10;
            $res1 = $user->save();
            // 密码正确跳转到首页
            echo "<script>location.href='/';</script>";
        }else{
            //密码错误返回error 
            echo "error";
        }
    
      
        
    } 


    /**
     * 前退出登录
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
       // 清除用户登录session
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
        $glossary = Glossary::where('uid',$id)->paginate(1);
        $glossary_comment = Glocomment::where('uid',$id)->paginate(1);
        $glossary_collect = Glocollect::where('uid',$id)->paginate(1);
        // 我发布的帖子
        $invitations = Invitation::where('uid',$id)->paginate(15);
        $invitations1 = Invitation::where('uid',$id)->get();
        // 我的回帖
        $invi_comments = Invi_comment::where('uid',$id)->paginate(5);
        $comments = Invi_comment::where('uid',$id)->get();
        // 帖子收藏
        $invi_collects = Invi_collect::where('uid',$id)->paginate(15);
        $collects = Invi_collect::where('uid',$id)->get();
        // 加载模板
        return view('home.user.userdateail',['userinfo'=>$userinfo,'user'=>$user,'invitations'=>$invitations,'invitations1'=>$invitations1,'invi_comments'=>$invi_comments,'comments'=>$comments,'invi_collects'=>$invi_collects,'collects'=>$collects,'glossary'=>$glossary,'glocomment'=>$glossary_comment,'glocollect'=>$glossary_collect]);
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
            return redirect('/home/user/information')->with('success', '修改成功');
        }else{
            return back()->with('error','修改失败');
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
