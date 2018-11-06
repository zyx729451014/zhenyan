@extends('admin/layout/layout');
@section('content-wrapper')
<div class='card'>
  <div class="card-body">
   <h4 class="card-title">图集回收站</h4>
    <br>
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
            									<a href="/admin/glossary/recovery/{{ $v->id }}"><button type="submit" class="badge badge-info">恢复</button></a>
                              <a href="/admin/glossary/forcedelete/{{ $v->id }}"><button type="submit" class="badge badge-danger">永久删除</button></a>
                      		</td>
                      </tr>
                      @endforeach
                    </tbody>
                     

                  </table>
                  <ul class="pagination" style="margin:0px auto;">
                
                  </ul>
                </div>
              </div>
            </div>
            </div>
@endsection