<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Gloreply;
use App\Models\Userdateail;



class GlossaryReplyController extends Controller
{
    public function __construct(){
        $this->middleware('hlogin', ['only' => ['store']]);
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
     * 图集评论回复判断.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 回复内容为空返回错误信息
        if (empty($request->input('content'))) {
            return redirect() -> back() -> withInput() -> withErrors('发表内容不能为空');
        }
        $gloreply = new Gloreply;
        $gloreply->uid = session('user')->uid;
        $gloreply->gid = $request->input('gid');
        $gloreply->cid = $request->input('cid');
        $gloreply->content = $request->input('content');
        $res = $gloreply->save();
        // 回复用户积分加5
        $user = Userdateail::find(session('user')->uid);
        $user -> point +=5;
        $res1 = $user->save();
        if($res){
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
