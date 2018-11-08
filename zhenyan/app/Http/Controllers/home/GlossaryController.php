<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Userdateail;
use App\Models\Glossary;
use App\Models\Glocomment;
use App\Models\Gloreply;
use App\Models\Glocollect;
use App\Http\Requests\GlossaryRequest;
use DB;

class GlossaryController extends Controller
{
    public function __construct(){
        $this->middleware('hlogin', ['only' => ['create', 'edit','destroy']]);
    }
    /**
     * 显示图集列表页.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 查询全部
        $glossary = Glossary::all(); 
        // 查询最新发布
        $newglossary = Glossary::orderBy('created_at','desc')->get();
        // 以title为关键字查询
        if (!empty($_GET['title'])) {
           $glossary = Glossary::where('title','like','%'.$_GET['title'].'%')->get(); 
        }
        
        return view('home.glossary.index',['glossary'=>$glossary,'newglossary'=>$newglossary]);
    }

    /**
     * 显示发布图集页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.glossary.create');
    }

    /**
     * 发布图集判断.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GlossaryRequest $request)
    {
        // 开启事物
        DB::beginTransaction();
        // 声明文件路径数组 (多文件)
        $file_paths = [];
        if($request -> hasFile('image')){
            $profile = $request -> file('image');
            foreach ($profile as $key => $value) {
                $ext = $value ->getClientOriginalExtension(); //获取文件后缀
                $file_name = str_random('20').'.'.$ext;
                $dir_name = './uploads/'.date('Ymd',time());
                $res = $value -> move($dir_name,$file_name);
                if($res){
                    // 拼接数据库存放路径
                    $profile_path = ltrim($dir_name.'/'.$file_name,'.');    
                    $file_paths[] = $profile_path;
                    // 把数组拼接成一个字符串 用 !-! 隔开
                    $file = implode('!-!',$file_paths);  
                }
            }
        }
        // 添加数据
        $glossary = new Glossary;
        $glossary -> uid = session('user')->uid;
        $glossary -> title = $request->input('title');
        $glossary -> image = $file;
        $glossary -> save();
        // 发布图集用户积分加5
        $user = Userdateail::find(session('user')->uid);
        $user -> point +=5;
        $res1 = $user->save();
        if($res && $res1){
            // 提交事务
            DB::commit();
            return redirect('home/glossary')->with('success', '发表成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','发表失败');
        }

    }

    /**
     * 显示图集详情页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $glossary = Glossary::find($id);
        $glocomment = Glocomment::where('gid',$id)->get();
        return view('home.glossary.show',['glossary'=>$glossary,'glocomment'=>$glocomment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $glossary = Glossary::find($id);
        return view('home.glossary.edit',['glossary'=>$glossary]);
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
         // 添加数据
        $glossary = Glossary::find($id);
        $glossary -> title = $request->input('title');
        // 声明文件路径数组 (多文件)
        $file_paths = [];
        if($request -> hasFile('image')){
            $profile = $request -> file('image');
            foreach ($profile as $key => $value) {
                $ext = $value ->getClientOriginalExtension(); //获取文件后缀
                $file_name = str_random('20').'.'.$ext;
                $dir_name = './uploads/'.date('Ymd',time());
                $res = $value -> move($dir_name,$file_name);
                if($res){
                    // 拼接数据库存放路径
                    $profile_path = ltrim($dir_name.'/'.$file_name,'.');    
                    $file_paths[] = $profile_path;
                    // 把数组拼接成一个字符串 用 !-! 隔开
                    $file = implode('!-!',$file_paths);  
                }
            }
            $glossary -> image = $file;
        }
        $res = $glossary -> save();
        if($res){
            return back()->with('success', '修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Glossary::destroy($id);
        $res1 = Glocomment::where('gid',$id)->delete();
        $res2 = Gloreply::where('gid',$id)->delete();
        $res3 = Glocollect::where('gid',$id)->delete();
        if ($res && $res1 && $res2 && $res3) {
            return back()->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }   
    }
}
