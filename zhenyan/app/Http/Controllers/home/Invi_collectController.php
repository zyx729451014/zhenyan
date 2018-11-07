<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Invi_collect;
class Invi_collectController extends Controller
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
    public function store(Request $request)
    {  
        $invi_collect = Invi_collect::where('iid',$request->collect)->where('uid',session('user')['uid'])->get();
        if(count($invi_collect) == 0){
            $iniv_collect = new Invi_collect;
            $iniv_collect->iid = $request->collect;
            $iniv_collect->uid = session('user')['uid'];
            $res = $iniv_collect->save(); // bool
        }else{
            return redirect() -> back() -> withInput() -> withErrors('您已收藏');
             
        }
       
        // 逻辑判断
        if($res){
            return back()->with('success', '收藏成功');
        }else{
            return back()->with('error','收藏失败');
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
        $res = Invi_collect::destroy($id);
        if ($res) {
            return back()->with('success', '取消收藏成功');
        }else{
            return back()->with('error', '取消收藏失败');
        }   
    }
}
