@extends('admin/layout/layout');
@section('content-wrapper')
<div class='card'>
  <div class="card-body">
   <h4 class="card-title">公告浏览</h4>
    <br>
    <form action="/admin/notice" method="get" class='table-primary'>
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
            <th> ID </th>
            <th> 发表人 </th>
            <th> 公告标题 </th>
            <th> 公告内容 </th>
            <th> 发表时间 </th>
            <th> 操作 </th>
          </tr>
        </thead>
        <tbody>
          @foreach($notice as $k => $v)
      	 	<tr>
            <td>{{ $v->id }}</td>
      	 		<td>{{ $v->noticeuser->uname }}</td>
      	 		<td>{{ $v->title }}</td>
      	 		<td>{{ $v->content }}</td>
      	 		<td>{{ $v->created_at }}</td>
      	 		<td>
      				<a href="/admin/notice/{{ $v->id }}/edit" class='badge badge-info'>修改</a>
      				<form action="/admin/notice/{{ $v->id }}" method="post" style="display:inline-block;">
      					{{ csrf_field() }}
      					{{ method_field('DELETE') }}
      					<a href="/admin/notice/{{ $v->id }}"></a><button type="submit" class="badge badge-danger">删除</button>
      				</form>	
      	 		</td>
      	 	 </tr>
	       	@endforeach
	</tbody>
	</table>
	<ul class="pagination" style='margin-left:100px;'>
		{!! $notice->appends ($request)->render() !!}
  	</ul>
</div>
</div>
@endsection