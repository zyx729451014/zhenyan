<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Invitation;
use App\Http\Requests\InvitationRequest;
use DB;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $search    = $request->input('search','');
        $cate = Cates::where('cid',$id)->first();       
        $condition = [];     
        if(!empty($id)){
             // 先根据类别ID查出所有子类ID ，以一维数组返回
            $arr1 = Cates::where('path','like',"%,$id%")->get();
            $arr_cid = [];
            foreach ($arr1 as $k => $v) {
                 $arr_cid[] = $arr1[$k]->cid;
            }
            // 形成查询商品的条件
        }
        $invitation = DB::table('invitations')
                    ->whereIn('cid', $arr_cid)
                    ->get();
        // 最新发布
                $arr1 = Cates::where('path','like',"%,$id%")->get();
                $arr_cid = [];
                foreach ($arr1 as $k => $v) {
                     $arr_cid[] = $arr1[$k]->cid;
                }
                // 形成查询帖子的条件
        $invitations = DB::table('invitations')
                        ->where('title','like','%'.$search .'%')
                        ->orderBy('created_at','desc')
                        ->whereIn('cid', $arr_cid)                                     
                        ->paginate(8); 
        // dump($invitations);exit;
        // $invitations = Invitation::where('title','like','%'.$search .'%')->->paginate(8);
       return view('home.invitation.index',['cate'=>$cate,'invitation'=>$invitation,'invitations'=>$invitations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Cates::select('*',DB::raw("concat(path,',',cid) as paths"))->orderBy('paths','asc')->get();
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path, ',');
            $cates[$key]->cname = str_repeat('|-----',$n).$value->cname;
        }
       return view('home.invitation.create',['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvitationRequest $request)
    {
        if($request->input('cid') == 0){
             return redirect() -> back() -> withInput() -> withErrors('请选择帖子类别');
        }
        // 开启事务 作为回滚点
        DB::beginTransaction();
        // 获取数据 进行添加
        $invitation = new Invitation;
        $invitation->uid = session('homeUserInfo')['uid'];
        $invitation->cid = $request->input('cid');
        $invitation->title = $request->input('title');
        $invitation->content = $request->input('content');
        $invitation->stick = '0';
        $res = $invitation->save(); // bool
        // 逻辑判断
        if($res){
            // 提交事务
            DB::commit();
            return redirect()->back()->with('success', '添加成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','添加失败');
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
        $invitation = Invitation::find($id);
        return view('home.invitation.show',['invitation'=>$invitation]);
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
