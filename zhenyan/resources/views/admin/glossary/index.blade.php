@extends('admin/layout/layout');
@section('content-wrapper')
<div class='card'>
  <div class="card-body">
   <h4 class="card-title">友情链接浏览</h4>
    <br>
    <form action="/admin/glossary" method="get" class='table-primary'>
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
                        <th> 发表用户 </th>
                        <th> 标题 </th>
                        <th> 发表图片 </th>
                        <th> 操作 </th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($glossary as $k=>$v)
                      <tr>
                      		<td>{{ $v->id }}</td>
                      		<td>{{ $v->glossaryuser->uname }}</td>
                      		<td>{{ $v->title }}</td>
                      		<td style="overflow:hidden;">
                              <?php 

                                $image = explode('!-!', $v->image);
                              ?>
                              @foreach ($image as $kk=>$vv)
                              <img src="{{ $vv }}" style="border-radius:0px;width:100px;height:100px;">
                              @endforeach
							            </td>
                      		<td>
            								<form action="/admin/glossary/{{ $v->id }}" method="post" style="display:inline-block;">
            									{{ csrf_field() }}
            									{{ method_field('DELETE') }}
            									<a href="/admin/glossary/{{$v->id}}"><button type="submit" class="badge badge-danger">删除</button></a>
            								</form>		
                      		</td>
                      </tr>
                      @endforeach
                    </tbody>
                     

                  </table>
                  <ul class="pagination" style="margin:0px auto;">
                  {!! $glossary->render() !!}
                  </ul>
                </div>
              </div>
            </div>
            </div>
@endsection