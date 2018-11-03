<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Adver;
use App\Http\Requests\AdverRequest;

class AdverController extends Controller
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
        $advers = Adver::where('atitle','like','%'.$search .'%')->paginate($showCount);
        return view('admin.adver.index',['advers'=>$advers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adver.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdverRequest $request)
    {
        // 开启事务 作为回滚点
        DB::beginTransaction();
        // 获取数据 进行添加
        $adver = new Adver;
        $adver->atitle   = $request->input('atitle');
        $adver->aurl     = $request->input('aurl');
        $adver->status   = $request->input('status');
        if( !$request -> hasFile('apic') )
        {
            return redirect() -> back() -> withInput() -> withErrors('没有文件上传');
        }else{
             $profile = $request -> file('apic');
            $ext = $profile ->getClientOriginalExtension(); //获取文件后缀
            $file_name = str_random('20').'.'.$ext;
            $dir_name = './uploads/'.date('Ymd',time());
            $res = $profile -> move($dir_name,$file_name);
            // 拼接数据库存放路径
            $profile_path = ltrim($dir_name.'/'.$file_name,'.');
        }
        $adver->apic   =  $profile_path;
        $res = $adver->save(); // bool
        // 逻辑判断
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/adver')->with('success', '添加成功');
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
        $adver = Adver::find($id);
        return view('admin.adver.edit',['adver'=>$adver]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdverRequest $request, $id)
    {
        // 开启事务 作为回滚点
        DB::beginTransaction();
        // 获取数据 进行添加
        $adver = Adver::find($id);
        $adver->atitle   = $request->input('atitle');
        $adver->aurl     = $request->input('aurl');
        $adver->status   = $request->input('status');
        if($request->hasFile('apic')){
            $profile = $request -> file('apic');
            $ext = $profile ->getClientOriginalExtension(); //获取文件后缀
            $file_name = str_random('20').'.'.$ext;
            $dir_name = './uploads/'.date('Ymd',time());
            $res = $profile -> move($dir_name,$file_name);
            // 拼接数据库存放路径
            $profile_path = ltrim($dir_name.'/'.$file_name,'.');
        }else{
            $profile_path = $adver['apic'];
        }
        $adver->apic   =  $profile_path;
        $res = $adver->save(); // bool
        // 逻辑判断
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/adver')->with('success', '修改成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','添加失败');
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
        $res = Adver::destroy($id);
        if ($res) {
            return redirect('admin/adver')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }   
    }
}
