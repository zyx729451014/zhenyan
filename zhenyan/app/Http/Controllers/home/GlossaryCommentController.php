<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Glocomment;
use App\Models\Userdateail;


class GlossaryCommentController extends Controller
{
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
     * 图集评论判断.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 评论内容为空返回错误信息
        if (empty($request->input('content'))) {
            return redirect() -> back() -> withInput() -> withErrors('发表内容不能为空');
        }
        // 添加数据
        $glocomment = new Glocomment;
        $glocomment->uid = session('user')->uid;
        $glocomment->gid = $request->input('gid');
        $glocomment->content = $request->input('content');
        $res = $glocomment->save();
        // 评论用户积分加5
        $user = Userdateail::find(session('user')->uid);
        $user -> point +=5;
        $res1 = $user->save(); 
        if($res && $res1){
            return back()->with('success', '发表成功');
        }else{
            return back()->with('error','发表失败');
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
