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
use App\Models\Friending;
use App\Models\Answer;
use App\Models\Answer_comment;
use App\Models\Answer_reply;

class UserController extends Controller
{ 
    public function __construct(){
        $this->middleware('hlogin', ['only' => ['getUserdateail', 'getInformation']]);
    }

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
        // 判断是管理员不能登录
        if($user->identity != 1){
            // 判断密码错误
            if (Hash::check($upass,$user['upass'])) {
                session(['user'=>$user]);
                // 用户登录积分加10
                $user = Userdateail::find($user->uid);
                $user->point +=10;
                $res1 = $user->save();

                $uri=empty(session('home_uri')) ? '/':session('home_uri');
                session('home_uri',NULL);
                // 密码正确跳转到首页
                echo "<script>location.href='".$uri."';</script>";
            }else{
                //密码错误返回error 
                echo "error";
            }
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
        // 我发布的图集
        $glossary = Glossary::where('uid',$id)->paginate(15);
        $glossaries = Glossary::where('uid',$id)->get();
        // 我的图集评论
        $glossary_comment = Glocomment::where('uid',$id)->paginate(5);
        $glossary_comments = Glocomment::where('uid',$id)->get();
        // 我的图集收藏
        $glossary_collect = Glocollect::where('uid',$id)->paginate(15);
        $glossary_collects = Glocollect::where('uid',$id)->get();
        // 我的帖子
        $invitations = Invitation::where('uid',$id)->paginate(15);
        $invitations1 = Invitation::where('uid',$id)->get();
        // 我的回帖
        $invi_comments = Invi_comment::where('uid',$id)->paginate(5);
        $comments = Invi_comment::where('uid',$id)->get();
        // 帖子收藏
        $invi_collects = Invi_collect::where('uid',$id)->paginate(15);
        $collects = Invi_collect::where('uid',$id)->get();
        // 我的问题
        $answer = Answer::where('uid',$id)->paginate(5);
        $answers = Answer::where('uid',$id)->get();
        // 我的回答
        $answer_comment= Answer_comment::where('uid',$id)->paginate(5);
        $answer_comments = Answer_comment::where('uid',$id)->get();
        // 加载模板
        return view('home.user.userdateail',['userinfo'=>$userinfo,'user'=>$user,
            'invitations'=>$invitations,'invitations1'=>$invitations1,'invi_comments'=>$invi_comments,
            'comments'=>$comments,'invi_collects'=>$invi_collects,'collects'=>$collects,
            'glossary'=>$glossary,'glocomment'=>$glossary_comment,'glocollect'=>$glossary_collect,
            'glossaries'=>$glossaries,'glocomments'=>$glossary_comments,'glocollects'=>$glossary_collects,'answer'=>$answer,'answers'=>$answers,'answer_comment'=>$answer_comment,'answer_comments'=>$answer_comments]);
    }
    /**
     * 用户个人中心
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsercenter()
    {
        $user = User::where('uid',session('uid'))->first();
        // 他的帖子
        $invitation = Invitation::where('uid',session('uid'))->paginate(5);
        $invitations = Invitation::where('uid',session('uid'))->get();
        // 他的回复
        $invicomments = Invi_comment::where('uid',session('uid'))->get();
        // 他的收藏
         $invicollects = Invi_collect::where('uid',session('uid'))->get();
         // 他的图集
        $glossary = Glossary::where('uid',session('uid'))->paginate(5);
        $glossarys = Glossary::where('uid',session('uid'))->get();
        // 他的图集评论
        $glocomments = Glocomment::where('uid',session('uid'))->get();
        // 他的图集收藏
        $glocollects = Glocollect::where('uid',session('uid'))->get();
        // 他的问题
        $answers = Answer::where('uid',session('uid'))->get();
        // 他的回答
        $answer_comments = Answer_comment::where('uid',session('uid'))->get();
         $idol = count(Friending::where('fans',session('uid'))->get());
         // 他的粉丝
        $fans = count(Friending::where('idol',session('uid'))->get());
        return view('home.user.usercenter',['user'=>$user,'invitations'=>$invitations,'invitation'=>$invitation,
                    'invicomments'=>$invicomments,'invicollects'=>$invicollects,
                    'glossarys'=>$invitations,'glossary'=>$invitation,'glocomments'=>$glocomments,
                    'glocollects'=>$glocollects,'idol'=>$idol,'fans'=>$fans,'answers'=>$answers,'answer_comments'=>$answer_comments]);
    }
    /**
     * 查看用户的个人中心
     * 
     */
    public function getUsercenters($id)
    {
        if(session()->has('user')){
            if($id == session('user')->uid){
                return redirect('/home/user/information');
            }else{
                session(['uid'=>$id]);
                return redirect('/home/user/usercenter');
            }
        }else{
            session(['uid'=>$id]);
            return redirect('/home/user/usercenter');
        }
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
        // 他的关注
        $idol = count(Friending::where('fans',session('user')->uid)->get());
         // 他的粉丝
        $fans = count(Friending::where('idol',session('user')->uid)->get());
        // 加载模板
        return view('home.user.information',['userinfo'=>$userinfo,'idol'=>$idol,'fans'=>$fans]);
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
