@extends('admin/layout/layout');
@section('content-wrapper')
 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">友情链接浏览</h4>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th> ID </th>
                        <th> 链接名称 </th>
                        <th> 链接URL地址 </th>
                        <th> 状态 </th>
                        <th> 操作 </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($links as $k=>$v)
                      <tr>
                      		<td>{{ $v->id }}</td>
                      		<td>{{ $v->lname }}</td>
                      		<td>{{ $v->lurl }}</td>
                      		<td>@if ($v->status == 0)
								    未激活
								@else
								    激活
								@endif
							</td>
                      		<td>
                      			<a href="/admin/links/{{$v->id}}/edit" class="badge badge-warning">修改</a>
								<form action="/admin/links/{{ $v->id }}" method="post" style="display:inline-block;">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<a href="/admin/links/{{$v->id}}"></a><button type="submit" class="badge badge-danger">删除</button>
								</form>		
                      		</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
@endsection