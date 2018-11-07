<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Notice_comment;
use DB;
 
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  按发表时间顺序获取5条数据
        $notice = DB::select('select * from notice order by created_at desc limit 5');
        // 加载模板
        return view('home.index.index',['notice'=>$notice]);
       
    }

    /**
     * 公告详情
     *
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    { 
        // 获取一条数据
        $notice = Notice::where('id',$id)->first();
        // dd($notice);
        $notice_comments = Notice_comment::where('nid','=',$id)->get();
        // 加载模板
        return view('home.index.notice',['notice'=>$notice,'notice_comments'=>$notice_comments]);
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
