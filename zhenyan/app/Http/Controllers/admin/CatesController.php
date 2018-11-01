<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;
class CatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * 分类数据处理
     */
    public static function getCates()
    {
        $cates = Cates::select('*',DB::raw("concat(path,',',cid) as paths"))->orderBy('paths','asc')->paginate(10);
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
        $cates = Cates::select('*',DB::raw("concat(path,',',cid) as paths"))->where('cname','like','%'.$search .'%')->orderBy('paths','asc')->paginate($showCount);
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path, ',');
            $cates[$key]->cname = str_repeat('|-----',$n).$value->cname;
        }
        // 加载到列表页面
        return view('admin.cates.index',['cates'=>$cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cates.create',['cates'=>self::getCates()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pid = $request->input('pid','');
        if($pid == 0){
            $path = 0;
        }else{
            $parent_data = Cates::find($pid);
            $path =  $parent_data->path.','.$parent_data->cid;
        }

        $cates = new Cates;
        $cates->cname = $request->input('cname','');
        $cates->pid = $request->input('pid','');
        $cates->status = $request->input('status',1);
        $cates->path = $path;
        if($cates->save()){
            return redirect('admin/cates')->with('success','添加成功');
        }else{
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
        $cate = Cates::find($id);
        return view('admin.cates.edit',['cates'=>self::getCates(),'cate'=>$cate]);
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
        $pid = $request->input('pid','');
        if($pid == 0){
            $path = 0;
        }else{
            $parent_data = Cates::find($pid);
            $path =  $parent_data->path.','.$parent_data->cid;
        }

        $cates = Cates::find($id);
        $cates->cname = $request->input('cname','');
        $cates->pid = $request->input('pid','');
        $cates->status = $request->input('status',1);
        $cates->path = $path;
        if($cates->save()){
            return redirect('admin/cates')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
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
