@extends('admin/layout/layout');
@section('content-wrapper')
 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">推荐位广告浏览</h4>
                  <form action="/admin/adver" method="get" class='table-primary'>
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
                        <th> 广告名称 </th>
                        <th> 链接URL地址 </th>
                        <th> 广告图 </th>
                        <th> 状态 </th>
                        <th> 操作 </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($advers as $k=>$v)
                      <tr>
                      		<td>{{ $v->id }}</td>
                      		<td>{{ $v->atitle }}</td>
                          <td>{{ $v->aurl }}</td>
                      		<td><img src="{{ $v->apic }}" class="adver" style="width: 200px;height: 150px;border-radius: 0px;"></td>
                      		<td>@if ($v->status == 0)
            								    未激活
            								@else
            								    激活
            								@endif
							           </td>
          		          <td>
                    			<a href="/admin/adver/{{$v->id}}/edit" class="badge badge-warning">修改</a>
          								<form action="/admin/adver/{{ $v->id }}" method="post" style="display:inline-block;">
          									{{ csrf_field() }}
          									{{ method_field('DELETE') }}
          									<a href="/admin/adver/{{$v->id}}"><button type="submit" class="badge badge-danger">删除</button></a>
          								</form>		
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                     

                  </table>
                  <ul class="pagination" style="margin:0px auto;">
                  {!! $advers->render() !!}
                  </ul>
                </div>
              </div>
            </div>
@endsection