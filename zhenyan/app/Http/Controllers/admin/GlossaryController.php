<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Glossary;

class GlossaryController extends Controller
{
    /**
     * 显示浏览图集页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showCount = $request->input('showCount',5);
        $search    = $request->input('search','');
        // 获取数据
        $glossary = Glossary::where('title','like','%'.$search .'%')->paginate($showCount);
        // 加载到列表页面
        return view('admin.glossary.index',['glossary'=>$glossary,'request'=>$request->all()]);
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
     * 显示回收站(软删除)的页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 获取软删除的数据
        $glossary = Glossary::onlyTrashed()->get();
        return view('admin.glossary.show',['glossary'=>$glossary]);
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
     * 软删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Glossary::destroy($id);
        if ($res) {
            return redirect('admin/glossary')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }   
    }

    /**
     *
     *  永久删除  
     *
     *  @param  $id 被删除的id
     * 
     */
    public function forcedelete($id)
    {
        // 获取被软删除的指定数据
        $glossary = Glossary::onlyTrashed()->where('id',$id)->first();
        // 永久删除
        $glossary->forceDelete();
        return back()->with('success', '删除成功');
    }

    /**
     *
     *  恢复被软删除的数据
     *
     *  @param   $id 恢复的id
     * 
     */
    
    public function recovery($id)
    {
        // 恢复指定数据
         $res = Glossary::withTrashed()->where('id',$id)->restore();
         if ($res) {
            return redirect('admin/glossary')->with('success', '恢复成功');
        }else{
            return back()->with('error', '恢复失败');
        } 
    }

    
}
