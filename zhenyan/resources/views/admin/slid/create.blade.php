@extends('admin/layout/layout')
@section('content-wrapper')
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">轮播图广告添加</h4>
        <form class="form-sample" method="post" action="/admin/slid" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">广告名称：</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="sname" value="{{ old('sname') }}"/>
                </div>
              </div>
            </div>                     
          </div>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">链接URL：</label>
                <div class="col-sm-8">
                  <input type="url" class="form-control" name="surl" value="{{ old('surl') }}"/>
                </div>
              </div>
            </div>                     
          </div>
          <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">广告图片：</label>
                  <div class="col-sm-8">
                      <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" placeholder="图片" style="background-color:#fff;" name="simg">
                        <img src="">
                      </div>

                  </div>
                </div>
              </div>                     
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">状态：</label>
                <div class="col-sm-2">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="0" checked>
                     未激活
                    </label>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="1">
                     激活
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-gradient-primary mr-2">添加</button>
        </form>
      </div>
    </div>
  </div>
@endsection