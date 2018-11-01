<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\WebRequest;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 查询网站信息
        $web=DB::table('webs')->first();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $web=DB::table('webs')->where('id',$id)->first();
        return view('admin.web.edit',['web'=>$web]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WebRequest $request, $id)
    {
        // 开启事物
        DB::beginTransaction();
        if($request->hasFile('logo')){
            $profile = $request -> file('logo');
            $ext = $profile ->getClientOriginalExtension(); //获取文件后缀
            $file_name = str_random('20').'.'.$ext;
            $dir_name = './uploads/'.date('Ymd',time());
            $res = $profile -> move($dir_name,$file_name);
            // 拼接数据库存放路径
            $profile_path = ltrim($dir_name.'/'.$file_name,'.');
        }
        $res = DB::table('webs')
            ->where('id', $id)
            ->update(['name' => $request->input('name'),
                     'describe' => $request->input('describe'),
                     'filing' => $request->input('filing'),
                     'telephone' => $request->input('telephone'),
                     'statu' => $request->input('statu'),
                     'url' => $request->input('url'),
                     'cright' => $request->input('cright'),
                     'logo' => $profile_path,
                    ]);
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
