<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Answer;


class AnswerController extends Controller
{
    /**
     * 问答浏览
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showCount = $request->input('showCount',5);
        $search    = $request->input('search','');
        
        // 获取数据
        $answer = Answer::where('title','like','%'.$search .'%')->paginate($showCount);
        // 加载到列表页面
        return view('admin.answer.index',['title'=>'问答浏览','answer'=>$answer,'request'=>$request->all()]);
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
        $res = Answer::destroy($id);
        if ($res) {
            return redirect('admin/answer')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }  
    }
}
