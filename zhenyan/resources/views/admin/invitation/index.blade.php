@extends('admin/layout/layout')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	@section('content-wrapper')
	  <div class="col-lg-13 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">帖子浏览</h4>
          <a href="/admin/invitation/show" class="btn btn-gradient-primary" style="float:right;margin-top:8px;">回收站</a>
            <form action="/admin/invitation" method="get" class='table-primary'>
              <div class='sousuo'>
              <label class='num'>显示
                <select size="1" name="showCount">
                  <option value="5" @if((isset($request['showCount']) && !empty($request['showCount'])) && $request['showCount'] == 5) selected @endif>5</option>
                  <option value="10" @if((isset($request['showCount']) && !empty($request['showCount'])) && $request['showCount'] == 10) selected @endif>10</option>
                  <option value="20" @if((isset($request['showCount']) && !empty($request['showCount'])) && $request['showCount'] == 20) selected @endif>20</option>
                  <option value="30" @if((isset($request['showCount']) && !empty($request['showCount'])) && $request['showCount'] == 30) selected @endif>30</option>
                
                </select>
              条</label>
               <label class='num'>类别
                <select size="1" name="cid">
                  <option value="0">选择类别</option>
                  @foreach($cates as $k=>$v)                 
                  <option value="{{ $v->cid }}">{{ $v->cname }}</option>
                  @endforeach  
                </select>
              </label>
              <label class='uname' style="margin-left:200px;">
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
                  帖子类别ID
                </th>
                 <th>
                  发布人
                </th>
                <th>
                  标题
                </th>
                <th>
                  置顶
                </th> 
                <th>
                  操作
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($invitation as $k=>$v)
              <tr>
                  <td>{{ $v['id'] }}</td>
                  <td>
                      <?php $cates = \App\Models\Cates::find($v['cid']);                
                       ?>
                     {{ $cates['cname'] }}
                  </td>
                  <td>
                      <?php $user = \App\User::find($v['uid']);                
                       ?>
                     {{ $user['uname'] }}
                  </td>
                  <td>{{ $v['title'] }}</td>                  
                  <td>{{ $v['stick'] }}</td>
                <td>
                  <a href="/admin/invitation/{{$v['id']}}/edit" class="badge badge-warning">修改</a>
                  <form action="/admin/invitation/{{ $v['id'] }}" method="post" style="display:inline-block;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a href="/admin/invitation/{{$v['id']}}"><button type="submit" class="badge badge-danger">删除</button></a>
                  </form>   
                </td>
              </tr>
              @endforeach
            </tbody>
            </table>
          <ul class="pagination" style="margin:0px auto;">
          {!! $invitation->render() !!}
          </ul>

        </div>
      </div>
    </div>
@endsection
</body>
</html>