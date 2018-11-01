@extends('admin/layout/layout')
@section('content-wrapper')
<div class='card'>
	<div class="card-body">
	 <h4 class="card-title">{{ $title or '' }}</h4>
  	<br>
  	<form action="/admin/user/index" method="get" class='table-primary'>
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
	   	<td>id</td>
	   	<td>用户名</td>
	   	<td>手机号</td>
	   	<td>邮箱</td>
	   	<td>权限</td>
	   	<td>操作</td>
	  </tr>
	</thead>
	<tbody>
		@foreach($user as $k => $v)
	 	<tr>
	 		<td>{{ $v->uid }}</td>
	 		<td>{{ $v->uname }}</td>
	 		<td>{{ $v->phone }}</td>
	 		<td>{{ $v->email }}</td>
	 		<td>{{ $v->identity ==0 ? '管理员' : '普通用户' }}</td>
	 		<td>
				<a href="/admin/user/userdetails/{{ $v['uid'] }}" class='badge badge-info'>详情</a>
				<a href="/admin/user/delete/{{ $v['uid'] }}" class='badge badge-danger'>删除</a>
	 		</td>
	 	 </tr>
	 	@endforeach
	</tbody>
	</table>
	<ul class="pagination" style='margin-left:100px;'>
		{!! $user->appends ($request)->render() !!}
  	</ul>
	</div>
</div>
@endsection


