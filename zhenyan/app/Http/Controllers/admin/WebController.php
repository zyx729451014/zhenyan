<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\WebRequest;
use App\Models\Web;

class WebController extends Controller
{
    /**
     * 显示浏览网站信息页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 查询网站信息
        $web = Web::find(1);
        return view('admin.web.index',['web'=>$web]);
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
     * 显示修改网站信息页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $web = Web::find($id);
        return view('admin.web.edit',['web'=>$web]);
    }

    /**
     * 修改网站信息判断.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WebRequest $request, $id)
    {
        // 开启事物
        DB::beginTransaction();
        
        $web = Web::find($id);
        $web->name = $request->input('name');
        $web->describe = $request->input('describe');
        $web->filing = $request->input('filing');
        $web->telephone = $request->input('telephone');
        $web->statu = $request->input('statu');
        $web->url = $request->input('url');
        $web->cright = $request->input('cright');
        // 判断图片文件是否上传
        if($request->hasFile('logo')){
            $profile = $request -> file('logo');
            $ext = $profile ->getClientOriginalExtension(); //获取文件后缀
            $file_name = str_random('20').'.'.$ext;
            $dir_name = './uploads/'.date('Ymd',time());
            $res = $profile -> move($dir_name,$file_name);
            // 拼接数据库存放路径
            $profile_path = ltrim($dir_name.'/'.$file_name,'.');
            $web->logo = $profile_path;
        }
        $res = $web->save();
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/web')->with('success', '修改成功');
        }else{
            // 事务回滚
            DB::rollBack();
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
        //
    }
}
