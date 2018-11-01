<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Slid;
use App\Http\Requests\SlidRequest;
use DB;

class SlidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showCount = $request->input('showCount',5);
        $search    = $request->input('search','');
        // 获取数据
        $slid = Slid::where('sname','like','%'.$search .'%')->paginate($showCount);
        // 加载到列表页面
        return view('admin.slid.index',['slid'=>$slid,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slid.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlidRequest $request)
    {
        // 开启事物
        DB::beginTransaction();
        // 判断是否有文件上传
        if($request->hasFile('simg')){
            $profile = $request -> file('simg');
            $ext = $profile ->getClientOriginalExtension(); //获取文件后缀
            $file_name = str_random('20').'.'.$ext;
            $dir_name = './uploads/'.date('Ymd',time());
            $res = $profile -> move($dir_name,$file_name);
            // 拼接数据库存放路径
            $profile_path = ltrim($dir_name.'/'.$file_name,'.');
        }else{
            return redirect() -> back() -> withInput() -> withErrors('没有文件上传');
        }
        // 获取数据 进行添加
        $slid = new Slid;
        $slid->sname = $request->input('sname');
        $slid->surl = $request->input('surl');
        $slid->simg = $profile_path;
        $slid->status = $request->input('status');
        $res = $slid->save(); // bool
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/slid')->with('success', '添加成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','添加失败');
        }
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
        $slid = Slid::find($id);
        return view('admin.slid.edit',['slid'=>$slid]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlidRequest $request, $id)
    {
        // 开启事物
        DB::beginTransaction();
        
        // 获取数据 进行添加
        $slid = Slid::find($id);
        $slid->sname = $request->input('sname');
        $slid->surl = $request->input('surl');
        $slid->status = $request->input('status');
        // 判断是否有文件上传
        if($request->hasFile('simg')){
            $profile = $request -> file('simg');
            $ext = $profile ->getClientOriginalExtension(); //获取文件后缀
            $file_name = str_random('20').'.'.$ext;
            $dir_name = './uploads/'.date('Ymd',time());
            $res = $profile -> move($dir_name,$file_name);
            // 拼接数据库存放路径
            $profile_path = ltrim($dir_name.'/'.$file_name,'.');
            $slid->simg = $profile_path;
        }
        $res = $slid->save(); // bool
        
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/slid')->with('success', '修改成功');
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
        $res = Slid::destroy($id);
        if ($res) {
            return redirect('admin/slid')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }   
    }
}
