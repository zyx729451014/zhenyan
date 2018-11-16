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
use Mail;
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
    public function __construct()
    {
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
        if($request->input('email')){
          $user->email = $request->input('email');  
        }
        if($request->input('phone')){
          if ($request->input('phonecode')!= session('phone_code')) {
            return back()->with('error','手机验证码错误');
          }
          $user->phone = $request->input('phone');
          $user->status = 1;  
        }
        $user->upass = hash::make($request->input('upass'));
        $user->token = str_random(60);
        $res1 = $user->save(); // bool
        $id = $user->uid;  
        $userdateail = new Userdateail;
        $userdateail->uid = $id;
        $userdateail->point = 200;
        $res2 = $userdateail->save();
        // 逻辑判断
        if($res1 && $res2){
            if($request->input('email')){
                 Mail::send('home.index.email', ['user' => $user], function ($m) use ($user) {
                    $m->to($user->email)->subject('臻妍论坛-账号激活');
                 });
                 return redirect('/home/user/login')->with('success','邮件发送成功 请去邮箱激活账号');
            }
            if($request->input('phone')){
                 return redirect('/home/user/login')->with('success','注册成功 即将到登录页面');
            }
        }else{
            return back()->with('error','注册失败');
        }

    } 
    /**
     *
     *  验证用户名
     * 
     */
     
    public function postCheckname()
    {
        $uname = $_POST['uname'];
        $data = User::where('uname',$uname)->first();
        if ($data) {
           // 用户名存在返回error
           echo "error";  
        }else{
            // 用户不存在返回success
            echo "success";
           
        }
        
    }
    /**
     *
     *  验证邮箱
     * 
     */
    public function postCheckemail()
    {
        $email = $_POST['email'];
        $data = User::where('email',$email)->first();
        if ($data) {
           // 邮箱存在返回error
           echo "error";  
        }else{
            // 邮箱不存在返回success
            echo "success";
           
        }
        
    }
    /**
     *
     *  验证手机号
     * 
     */
    public function postCheckphone()
    {
        $phone = $_POST['phone'];
        $data = User::where('phone',$phone)->first();
        if ($data) {
           // 手机号存在返回error
           echo "error";  
        }else{
            // 手机号不存在返回success
            echo "success";
           
        }
        
    }

    /**
     *
     *  用户邮箱注册激活
     *
     *  $id 激活的用户id  $token 激活用户的token
     * 
     */
    public function getActivation($id,$token)
    {
        $user = User::find($id);
        if($user->status == 1)
        {
            return redirect('/home/user/login')->with('error','用户已经激活');
        }

        if ($user->token != $token) 
        {
            return redirect('/home/user/login')->with('error','该链接已经失效');
        }
        $user ->token = str_random(60);
        $user ->status = 1;
        $user ->save();
        return redirect('/home/user/login')->with('success','账号已成功激活快去登录吧!');
    }

    /**
     *
     *  用户手机注册发送验证码
     *
     * 
     */
    public function getSendmobilecode()
    {
        $str_rand = rand(1000,9999);
        session(['phone_code'=>$str_rand]);
        $mobile_code = $str_rand; 
        //获取手机号
        $mobile = $_GET['phone'];
        //短信接口地址
        $target = "http://106.ihuyi.com/webservice/sms.php?method=Submit";
        $target .= "&account=C31354845&password=ea2a13501ac56076dd64149fa2d14622&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");

        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $target);
        //设置头文件的信息作为数据流出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回 而不是直接输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行集合
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        function xml_to_array($data){
            $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
            if(preg_match_all($reg, $data, $matches)){
                $count = count($matches[0]);
                for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                    if(preg_match( $reg, $subxml )){
                        $arr[$key] = xml_to_array( $subxml );
                    }else{
                        $arr[$key] = $subxml;
                    }
                }
            }
            return $arr;
        }
        var_dump(xml_to_array($data));
    }
    /**
     *
     *  修改用户名
     * 
     */
    public function postChangename(Request $request,$id)
    {
        $user = User::find($id);
        $user -> uname = $request->input('uname');
        if($user -> save()){
            $request->session()->flush();
            session(['user'=>$user]);
            return back()->with('success','用户名设置成功');
        }else{
            return back()->with('error','用户名设置失败');
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
        $uname = $request->input('uname');
        $upass = $request->input('upass');
        // 查询数据库用户 
        if (preg_match('/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/',$uname)) {
            $user = User::where('email',$uname)->first(); 
        }else if(preg_match('/^1[345786]\d{9}$/', $uname)){
            $user = User::where('phone',$uname)->first();
        }else{
            $user = User::where('uname',$uname)->first();
        }
        if(!$user){
            return back()->with('error','用户不存在请核对用户名');
        }
        // 判断是管理员不能登录
        if($user->identity != 1){
            if($user->status == 1){
                // 判断密码错误
                if (Hash::check($upass,$user['upass'])) {
                    session(['user'=>$user]);
                    // 用户登录积分加10
                    $userdateail = Userdateail::find($user->uid);
                    $userdateail -> point +=10;
                    $res1 = $userdateail->save();

                    $uri=empty(session('home_uri')) ? '/':session('home_uri');
                    session('home_uri',NULL);
                    // 密码正确跳转到首页
                    return redirect($uri);
                }else{
                    //密码错误返回error 
                    return back()->with('error','用户名和密码不匹配');
                }
            }else{
                return back()->with('error','账号未激活 请先激活账号');
            }
        }else{
            return back()->with('error','管理员不能登录前后哦');
        }
    } 


    /**
     * 前台退出登录
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

    // 找回密码
    public function getFp()
    {
        return view('home.user.fp');
    }
    // 通过邮箱找回密码
    public function getEmails(Request $request)
    {
        return view('home.user.emails');
    }
    // 通过手机号找回密码
    public function getMobile()
    {
        return view('home.user.mobile');
    }



    /**
     * 通过手机号修改密码
     *
     * @return \Illuminate\Http\Response
     */
    public function getUpdatephone()
    {
        return view('home.user.updatephone');
    }
    /**
     * 通过手机号修改密码成功
     *
     * @return \Illuminate\Http\Response
     */
    public function postUpdatephone2(Request $request)
    {
        $phone = $request->input('phone');
        $upass = $request->input('upass');
        $user = User::where('phone','=',$phone)->first();
        if(empty($phone)){
            return back()->with('error','手机号不能为空');
        }
        if($phone != $user['phone']){
            return back()->with('error','该手机号不存在');
        }
        if(Hash::check($upass,$user['upass'])){
            return back()->with('error','修改密码不能与原来密码相同');
        }
        $res = $user->save();
        if($res){
            return redirect('/')->with('success','修改密码成功!');
        }else{
            return back()->with('error','修改密码失败!');
        }
       
    }


    /**
     * 通过邮箱修改密码
     *
     * @return \Illuminate\Http\Response
     */
    public function getUpdateemail()
    {
        return view('home.user.updateemail');
    }

     /**
     *
     *  邮箱用户修改密码发送验证码
     *
     * 
     */
    public function getSendemailcode(Request $request)
    {
        
        $email = $_GET['email'];
        $str_rand = rand(1000,9999);
        session(['mobilecode'=>$str_rand]);
        if($email){
            Mail::send('home.index.emailcode', ['str_rand' => $str_rand,'email'=>$email], function ($m) use ($email) {
                $m->to($email)->subject('臻妍论坛-获取验证码');
            });
            
        }
        return 'success';
    }



    /**
     * 通过邮箱修改密码成功
     *
     * @return \Illuminate\Http\Response
     */
     public function postUpdateemail2(Request $request)
    {   
        $email = $request->input('email');
        $upass = $request->input('upass');
        $user = User::where('email','=',$email)->first();
        if(empty($email)){
            return back()->with('error','邮箱不能为空');
        }
        if($email != $user['email']){
            return back()->with('error','该邮箱号不存在');
        }
        if(Hash::check($upass,$user['upass'])){
            return back()->with('error','修改密码不能与原来密码相同');
        }
        $res = $user->save();
        if($res){
            return redirect('/')->with('success','修改密码成功!');
        }else{
            return back()->with('error','修改密码失败!');
        }
    }

    /**
     * 邮箱验证不能为空
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckemailcode(Request $request)
    {
        if (empty($request->input('email')) || empty($request->input('emailcode'))) {
            return back()->with('error','请先验证');
        }
        if(session('mobilecode') == $request->input('emailcode')){
            return redirect('/home/user/updateemail');
        }else{
            return back()->with('error','校验码错误');
        }
    }

    /**
     * 手机验证不能为空
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckmobilecode(Request $request)
    {
        if (empty($request->input('phone')) || empty($request->input('phonecode'))) {
            return back()->with('error','请先验证');
        }
        exit;
        if(session('phone_code') == $request->input('phonecode')){
            return redirect('/home/user/updateemail');
        }else{
            return back()->with('error','校验码错误');
        }
    }


     /**
     * 修改密码
     *
     * @return \Illuminate\Http\Response
     */
    public function postUpdateupass(Request $request,$id)
    {
        $user = User::find($id);
        $oldpassword = $request->input('oldpassword');
        if(!Hash::check($oldpassword,$user['upass'])){
            return back()->with('error','原密码错误,请重新输入');
        }
        $upass = hash::make($request->input('upass'));
        $user->upass = $upass;
        if(Hash::check($oldpassword,$upass)){
            return back()->with('error','原密码不能与新密码一致');
        }
        $res = $user->save();
        if($res){
            return back()->with('success','修改密码成功');
        }else{
            return back()->with('error','修改密码失败');
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
