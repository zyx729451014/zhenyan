@extends('admin/layout/layout')
@section('content-wrapper')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title or '' }}</h4>
        <form class="form-sample" method="post" action="/admin/user/store">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">用户名：</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="uname" value="{{ old('uname') }}">
                </div>
              </div>
            </div>                     
          </div>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">密码：</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="upass">
                </div>
              </div>
            </div>                     
          </div>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">确认密码：</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="upassok">
                </div>
              </div>
            </div>                     
          </div>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">手机号：</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                </div>
              </div>
            </div>                     
          </div>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">邮箱：</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
              </div>
            </div>                     
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">权限：</label>
                <div class="col-sm-2">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="identity" id="identity" value="1">
                     管理员
                    </label> 
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="identity" id="identity" value="0" checked>
                     普通用户
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-gradient-primary mr-2">添加</button>
          <button type="reset" class="btn btn-light">重置</button>
        </form>
      </div>
    </div>
  </div>

@endsection
