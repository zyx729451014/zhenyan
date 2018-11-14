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
use Mail;

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
     * 前台邮箱注册成功
     *
     * @return \Illuminate\Http\Response
     */
    public function postDoregister(Request $request)
    {
       // 获取数据 进行添加
        $email = $request->input('email');
        $user = new User;
        $user->email = $email;
        $user->upass = hash::make($request->input('upass')); 
        $token = str_random(60);
        // 加密签名
        $user->token = $token; 
        $res1 = $user->save(); // bool
        $id = $user->uid;  
        $userdateail = new Userdateail;
        $userdateail->uid = $id;
        $userdateail->point = 200;
        $res2 = $userdateail->save();
        // 逻辑判断
        if($res1 && $res2){
            // 发送邮件
            Mail::send('home.email.index', ['email' => $email,'id'=>$id,'token'=>$token], function ($m) use ($user) {
               $res = $m->to($user->email)->subject('【LAMP官方】');
            });
            return redirect('/home/user/register');
        }else{
            echo "<script>alert('很遗憾您注册失败了');";
        }

    } 
    // 邮箱激活
    public function getJihuo($id,$token)
    {
        // 修改用户的状态
        $user = User::find($id);
        // 检测用户
        if($user->status == 1){
            return redirect('/home/user/login')->with('error','用户已经激活');
            
        }
        if($user->token != $token){
            return redirect('/home/user/login')->with('error','链接失效');
        }
        $user->status = 1;
        $user->token = str_random(60);
        if($user->save()){
            return redirect('/home/user/login')->with('success','激活成功 去登录');
        }
    }

    //  验证邮箱注册
    public function postCheckemail()
    {
        $email = $_POST['email'];
        $data = User::where('email',$email)->first();
        if ($data) {
           // 用户名存在返回error
           echo "error";  
        }else{
            // 用户不存在返回success
            echo "success";
           
        }
        
    }

    // 发送短信验证
    public function getSendphonecode(Request $request)
    {

        // URL 请求手机短信验证的接口地址
        $mobile = $request->input('phone');
        dump($mobile);
        $str_rand = rand(1000,9999);
        // 压入session
        session(['phone_code'=>$str_rand]);
        $mobile_code = $str_rand;
        //短信接口地址
        $target = "http://106.ihuyi.com/webservice/sms.php?method=Submit";
        $target .= "&account=C01852037&password=04313695dc00345c014c807e39f29b71&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL,$target);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        echo $data;

    }

    // 前台手机号注册
    public function postPhonedoregister(Request $request)
    {
        
        if($request->input('phone_code') != session('phone_code')){
            return redirect('/home/user/register')->with('error','验证码错误');
        }
         // 获取数据 进行添加
        $phone = $request->input('phone');
        $user = new User;
        $user->phone = $phone;
        $user->upass = hash::make($request->input('upass')); 
        $res1 = $user->save(); // bool
        $id = $user->uid;  
        $userdateail = new Userdateail;
        $userdateail->uid = $id;
        $userdateail->point = 200;
        $res2 = $userdateail->save();
        // 逻辑判断
        if($res1 && $res2){
            return redirect('/home/user/register');
        }else{
            echo "<script>alert('很遗憾您注册失败了');";
        }
    }



    //  验证手机注册
    public function postCheckphone()
    {
        $phone = $_POST['phone'];
        $data = User::where('phone',$phone)->first();
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
     * 上传头像
     *
     * @return \Illuminate\Http\Response
     */
    public function postUploads(Request $request)
    {
        // 接收数据执行上传
         if($request->hasFile('face')){
            // 创建对象
            $profile = $request -> file('face');
            // 获取文件后缀
            $ext = $profile ->getClientOriginalExtension(); 
            $file_name = str_random('20').'.'.$ext;
            $dir_name = './uploads/'.date('Ymd',time());
             if($profile -> move($dir_name,$file_name)){
                $str = [
                    'code' =>1,
                    'msg' =>'上传成功',
                    'data'=>[
                        'src' => ltrim($dir_name.'/'.$file_name,'.'),
                    ],
                ];
            }else{
                $str = [
                    'code' =>0,
                    'msg' =>'上传失败',
                    'data'=>[
                        'src' =>ltrim($dir_name.'/'.$file_name,'.'),
                    ],
                ];
            }
        }
        return response()->json($str);
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
        $userdateail->sex = $request->input('sex');
        $userdateail->birthdate = $request->input('birthdate');
        if (!empty($request->input('face'))) {
            $userdateail->face = $request->input('face');
        }
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
