<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Answer_comment;
use DB;
use App\Models\Userdateail;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search    = $request->input('search','');
        // 获取数据
        $answer = Answer::where('content','like','%'.$search .'%')->paginate(8);
        // 最新发布
        $answer2 = DB::select('select * from answers order by created_at desc limit 5');
        // dd($answer2);
        // 加载到列表页面
        return view('home.answer.index',['answer'=>$answer,'answer2'=>$answer2,'request'=>$request->all()]);
    }

    /**
     * 问答发布
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('home.answer.create');
    }

    /**
     * 问答发布成功
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
        $id = session('user')->uid;
        $answer = new Answer;
        $answer->title = $request->input('title');
        $answer->content = $request->input('content');
        $answer->uid = $id;
        $res = $answer->save(); // bool
        // 逻辑判断
        if($res){
            // 提交事务
            DB::commit();      
            $userdateail = Userdateail::where('uid',session('user')['uid'])->first();
            $userdateail->point = $userdateail->point+10; 
            $res1 = $userdateail->save();    
            return redirect('home/answer')->with('success', '发布成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','发布失败');
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
        $answer = Answer::find($id);
        $answer_comment = Answer_comment::where('aid','=',$id)->get();
        return view('home.answer.show',['answer'=>$answer,'answer_comment'=>$answer_comment]);
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
