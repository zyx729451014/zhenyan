<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\User;
use DB;

class NoticeController extends Controller
{
    /**
     * 公告浏览
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showCount = $request->input('showCount',5);
        $search    = $request->input('search','');
        
        // 获取数据
        $notice = Notice::where('title','like','%'.$search .'%')->paginate($showCount);
        // dump($notice->noticeuser);
        

        // 加载到列表页面
        return view('admin.notice.index',['title'=>'用户浏览','notice'=>$notice,'request'=>$request->all()]);
    }

    /**
     * 公告添加
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notice.create',['title'=>'公告添加']);
    }

    /**
     * 公告添加成功
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // 开启事务 作为回滚点
        DB::beginTransaction();
        // 获取数据 进行添加 
        $notice = new Notice;
        $notice->title = $request->input('title');
        $notice->content = $request->input('content');
        $uname = session('admin')->uname;
        $user = User::where('uname',$uname)->first();
        $id= $user->uid;
        $notice->uid = $id;
        $res = $notice->save();// bool
        // 逻辑判断
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/notice')->with('success', '添加成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','添加失败');
        }
    }

    /**
     * 公告修改
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('admin.notice.edit',['title'=>'公告修改','notice'=>$notice]);

    }

    /**
     * 公告修改成功
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // 开启事务 作为回滚点
        DB::beginTransaction();
        $notice = Notice::find($id);
        $notice->title = $request->input('title');
        $notice->content = $request->input('content');
        $res = $notice->save();
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/notice')->with('success', '修改成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','修改失败');
        }
    }

    /**
     * 公告删除
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Notice::destroy($id);
        if ($res) {
            return redirect('admin/notice')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }   
    }
}
