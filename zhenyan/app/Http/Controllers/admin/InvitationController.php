<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\invitation;
use DB;
use App\Models\User;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public static function getCates()
    {
        $cates = Cates::select('*',DB::raw("concat(path,',',cid) as paths"))->orderBy('paths','asc')->get();
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path, ',');
            $cates[$key]->cname = str_repeat('|-----',$n).$value->cname;
        }
        return $cates; 
        // 获取数据
    }
    public function index(Request $request)
    {
        $showCount = $request->input('showCount',5);
        $search    = $request->input('search','');
        $cid       = $request->input('cid','');
        if($cid === "0" || $cid === ''){
             $invitation = Invitation::where('title','like','%'.$search .'%')->paginate($showCount);            
        }else{
            // 先根据类别ID查出所有子类ID ，以一维数组返回
            $arr1 = Cates::where('cid','=',$cid)->get();
            if($arr1[0]->pid == 0){              
                $id = $cid;
                $arr2 = Cates::where('path','like',"%,$id%")->get();
                $arr_cid = [];
                foreach ($arr2 as $k => $v) {
                     $arr_cid[] = $arr2[$k]->cid;
                }
                // 形成查询帖子的条件
                $invitation = invitation::where('title','like','%'.$search .'%')->whereIn('cid', $arr_cid)->paginate($showCount);        

            }else{              
                $id = $arr1[0]->cid; 
                $invitation = Invitation::where('title','like','%'.$search .'%')->where('cid','=', $id)->paginate($showCount);                  
            }
                       
        }
        return view('admin.invitation.index',['cates'=>self::getCates(),'invitation'=>$invitation]);
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
       //获取软删除的数据
        $invitation = Invitation::onlyTrashed()->get();
        return view('admin.invitation.show',['invitation'=>$invitation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invitation = Invitation::find($id);
        return view('admin/invitation/edit',['cates'=>self::getCates(),'invitation'=>$invitation]);
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
        if($request->input('cid') == 0){
             return redirect() -> back() -> withInput() -> withErrors('请选择帖子类别');
        }
        // 开启事务 作为回滚点
        DB::beginTransaction();
        // 获取数据 进行添加
        $invitation = Invitation::find($id);
        $invitation->cid = $request->input('cid');
        $invitation->stick = $request->input('stick');
        $res = $invitation->save(); // bool
        // 逻辑判断
        if($res){
            // 提交事务
            DB::commit();
            return redirect('admin/invitation')->with('success', '修改成功');
        }else{
            // 事务回滚
            DB::rollBack();
            return back()->with('error','修改失败');
        }
    }

    /**
     * 软删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Invitation::destroy($id);
        if ($res) {
            return redirect('admin/invitation')->with('success', '删除成功');
        }else{
            return back()->with('error', '删除失败');
        }   
    }
     /**
     *
     *  永久删除  
     *
     *  @param  $id 被删除的id
     * 
     */
    public function forcedelete($id)
    {

        $invitation = Invitation::onlyTrashed()->where('id',$id)->first();
        $invitation->forceDelete();
        return back()->with('success', '删除成功');
    }

    /**
     *
     *  恢复被软删除的数据
     *
     *  @param   $id 恢复的id
     * 
     */
    
    public function recovery($id)
    {
         $res = Invitation::withTrashed()->where('id',$id)->restore();
         if ($res) {
            return redirect('admin/invitation')->with('success', '恢复成功');
        }else{
            return back()->with('error', '恢复失败');
        } 
    }
}
