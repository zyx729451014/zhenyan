@extends('admin/layout/layout');
@section('content-wrapper')
<div class='card'>
  <div class="card-body">
   <h4 class="card-title">帖子回收站</h4>
    <br>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th> ID </th>
                        <th>  帖子类别ID</th>
                        <th> 发表用户 </th>
                        <th> 标题 </th>
                        <th> 操作 </th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($invitation as $k=>$v)
                      <tr>
                          <td>{{ $v->id }}</td>
                          <td> 
                          <?php $cates = \App\Models\Cates::find($v['cid']);                
                        ?>
                          {{ $cates['cname'] }}</td>
                          <td>{{ $v->invitationuser->uname }}</td>
                          <td>{{ $v->title }}</td>
                          <td>
                              <a href="/admin/invitation/recovery/{{ $v->id }}"><button type="submit" class="badge badge-info">恢复</button></a>
                              <a href="/admin/invitation/forcedelete/{{ $v->id }}"><button type="submit" class="badge badge-danger">永久删除</button></a>
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