<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Privatemess;
use App\user;
use DB;

class PrivateController extends Controller
{
    public function __construct()
    {
        $this->middleware('hlogin', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('uid',session('user')->uid)->first();
        $private = Privatemess::where('oid',session('user')->uid)->paginate(10);
        return view('home.private.index',['user'=>$user,'private'=>$private]);
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
        
        // 评论内容为空返回错误信息
        if (empty($request->input('content'))) {
            return redirect() -> back() -> withInput() -> withErrors('发送的私信内容不能为空');
        }
        // 添加数据
        $privatemess = new Privatemess;
        $privatemess->uid = session('user')->uid;
        $privatemess->oid = $request->input('oid');
        $privatemess->content = $request->input('content');
        $res = $privatemess->save();
        if($res){
            return back()->with('psuccess', '发送成功');
        }else{
            return back()->with('error','发送失败');
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
        $res = Privatemess::destroy($id);
        if ($res) {
            return back()->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }
    }

    /**
     *
     *
     *  删除选中私信
     * 
     */
    public function delall(Request $request)
    {
        // 接收要删除数据的id号
        $ids = $request -> input('ids');

        $res = DB::table('private')->whereIn('id',$ids)->delete();
        if($res){
            echo 'success';
            exit;
        }else{
            echo 'error';
            exit;
        }
    }
}
