<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Notice_comment;
use App\Models\Answer;
use App\Models\Answer_comment;
use DB;
 
class IndexController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  按发表时间顺序获取5条公告数据
        $notice = DB::select('select * from notice order by created_at desc limit 10');
         //  按发表时间顺序获取5条问答数据
        $answer = DB::select('select * from answers order by created_at desc limit 10');
        // 加载模板
        return view('home.index.index',['notice'=>$notice,'answer'=>$answer]);
       
    }

    /**
     * 公告详情
     *
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    { 
        // 获取一条公告数据
        $notice = Notice::where('id',$id)->first();
        // 获取一条问答数据
        $answer = Answer::where('id',$id)->first();

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
