<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notice_reply;
use App\Models\Userdateail;

class NoticereplyController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        if (empty($request->input('content'))) {
            return redirect() -> back() -> withInput() -> withErrors('回复内容不能为空');
        }
        $notice_reply = new Notice_reply;
        $notice_reply->nid     = $request->input('nid');
        $notice_reply->cid     = $request->input('cid');
        $notice_reply->uid     = session('user')['uid'];
        $notice_reply->content = $request->input('content');
        $res = $notice_reply->save(); // bool
        // 逻辑判断
        if($res){
            $userdateail = Userdateail::where('uid',session('user')['uid'])->first();
            $userdateail->point = $userdateail->point+5; 
            $res1 = $userdateail->save(); 
            return back()->with('success', '回复成功');
        }else{
            return back()->with('error','回复失败');
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
