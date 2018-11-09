<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Notice_comment;
use App\Models\Answer;
use App\Models\Answer_comment;
use App\Models\Invitation;
use App\Models\Invi_comment;
use App\Models\Friending;
use App\User;
use DB;
use App\Models\Glossary;
 
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
        $notice = DB::select('select * from notice order by created_at desc limit 5');
         //  按发表时间顺序获取5条问答数据
        $answer = DB::select('select * from answers order by created_at desc limit 5');
        // 帖子推荐中的显示
        $invitation = Invitation::orderBy('created_at','desc')->get()->take(15);
        // 热帖中的显示根据评论查询
        $iniv_comm = Invitation::get();
        $sum = [] ;
       
        foreach ($iniv_comm as $key => $value) {
            $sum[] = ['count'=>Invi_comment::where('iid',$value->id)->count(),'iid'=>$value->id];
        } 
        foreach ($sum as $key => $row)
            {
                $count[$key]  = $row['count'];
                $iid[$key] = $row['iid'];
            }

        array_multisort($count, SORT_DESC, $iid, SORT_ASC, $sum);
        $arr = [] ;
        foreach ($sum as $k => $v) {
           $arr[] = $v['iid'];
        }
        $comment = [];
        foreach ($arr as $k => $v) {
            if($k < 11 ){
                $comment[] = Invitation::where('id',$v)->get();
            }
            
        }
        // 最受欢迎的用户
        $user = User::get();
        $sum1 = [];
        foreach ($user as $key => $value) {
            $sum1[] = ['idol'=>Friending::where('idol',$value->uid)->count(),'uid'=>$value->uid];
        } 
        foreach ($sum1 as $key => $row)
        {
            $idol[$key]  = $row['idol'];
            $uid[$key] = $row['uid'];
        }

        array_multisort($idol, SORT_DESC, $uid, SORT_ASC, $sum1);
        $arr1 = [] ;
        foreach ($sum1 as $k => $v) {
           $arr1[] = $v['uid'];
        }
        $idol = [];
        foreach ($arr1 as $k => $v) {
            if($k < 6 ){
                $idol[] = User::where('uid',$v)->get();
            }         
        }
        //  按发表时间顺序获取5条图集
        $glossary = Glossary::orderBy('created_at','desc')->get()->take(10);
        // 加载模板
        return view('home.index.index',['notice'=>$notice,'answer'=>$answer,'invitation'=>$invitation,'comment'=>$comment,'idol'=>$idol,'glossary'=>$glossary]);

       
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
