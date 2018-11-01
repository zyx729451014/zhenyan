@extends('admin/layout/layout')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	@section('content-wrapper')
	  <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">类别浏览</h4>
            <form action="/admin/cates" method="get" class='table-primary'>
              <div class='sousuo'>
              <label class='num'>显示
                <select size="1" name="showCount">
                  <option value="5" @if((isset($request['showCount']) && !empty($request['showCount'])) && $request['showCount'] == 5) selected @endif>5</option>
                  <option value="10" @if((isset($request['showCount']) && !empty($request['showCount'])) && $request['showCount'] == 10) selected @endif>10</option>
                  <option value="20" @if((isset($request['showCount']) && !empty($request['showCount'])) && $request['showCount'] == 20) selected @endif>20</option>
                  <option value="30" @if((isset($request['showCount']) && !empty($request['showCount'])) && $request['showCount'] == 30) selected @endif>30</option>
                
                </select>
              条</label>
              <label class='uname'>
                <span>关键字</span>
                <input type="text" name='search' value="{{ $request['search'] or '' }}">
              </label>
              <button type="submit" class="btn btn-gradient-primary">搜索</button>
            </div>  
          </form>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                 ID
                </th>
                <th>
                  类名
                </th>
                <th>
                  属性类
                </th> 
                <th>
                  类别路径
                </th>
                <th>
                  分类状态
                </th>
                <th>
                  操作
                </th>
              </tr>
            </thead>
            @foreach($cates as $k=>$v)
            <tbody>
              <tr>
                <td>
                  {{ $v['cid'] }}
                </td>
                <td>
                 {{ $v['cname'] }}
                </td>
                <td>
                  {{ $v['pid'] }}
                </td>
                <td>
                 {{ $v['path'] }}
                </td>
                <td>
                 {{ $v['status'] ==1 ? '激活' : '未激活' }}
                </td>
                <td>
                  <label class="badge badge-warning"><a href="/admin/cates/{{ $v['cid'] }}/edit">修改</a></label>
                </td>
              </tr>                      
            </tbody>
            @endforeach
          </table>
          <ul class="pagination" style="margin:0px auto;">
          {!! $cates->render() !!}
          </ul>

        </div>
      </div>
    </div>
@endsection
</body>
</html>