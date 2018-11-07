<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Link;
use App\Http\Requests\LinksRequest;

class LinksController extends Controller
{
    /**
     * 显示浏览友情链接页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showCount = $request->input('showCount',5);
        $search    = $request->input('search','');
        // 获取数据
        $links = Link::where('lname','like','%'.$search .'%')->paginate($showCount);
        // 加载到列表页面
        return view('admin.links.index',['links'=>$links,'request'=>$request->all()]);
    }

    /**
     * 添加友情链接页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.links.create');
    }

    /**
     * 添加友情链接判断
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinksRequest $request)
    {
        // 开启事务 作为回滚点
        DB::beginTransaction();
        // 获取数据 进行添加
        $link = new Link;
        $link->lname = $request->input('lname');
        $link->lurl = $request->input('lurl');
        $link->status = $request->input('status');
        $res = $link->save(); // bool
        // 逻辑判断
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/links')->with('success', '添加成功');
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
     * 修改友情链接页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Link::find($id);
        return view('admin.links.edit',['link'=>$link]);
    }

    /**
     * 修改友情链接判断
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinksRequest $request, $id)
    {
        // 开启事务 作为回滚点
        DB::beginTransaction();
        $link = Link::find($id);
        $link->lname = $request->input('lname');
        $link->lurl = $request->input('lurl');
        $link->status = $request->input('status');
        $res = $link->save();
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/links')->with('success', '修改成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除友情链接.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除数据
        $res = Link::destroy($id);
        if ($res) {
            return redirect('admin/links')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }   
    }
}
