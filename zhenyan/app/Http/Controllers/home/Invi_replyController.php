<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Invi_reply;
use App\Models\Userdateail;
use DB;

class Invi_replyController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->input('content'))) {
            return redirect() -> back() -> withInput() -> withErrors('回复内容不能为空');
        }
        $iniv_reply = new Invi_reply;
        $iniv_reply->iid     = $request->input('iid');
        $iniv_reply->cid     = $request->input('cid');
        $iniv_reply->uid     = session('user')['uid'];
        $iniv_reply->content = $request->input('content');
        $res = $iniv_reply->save(); // bool
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
