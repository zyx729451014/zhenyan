@extends('admin/layout/layout')
@section('content-wrapper')
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">轮播图广告修改</h4>
        <form class="form-sample" method="post" action="/admin/slid/{{ $slid->sid }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">广告名称：</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="sname" value="{{ $slid->sname }}"/>
                </div>
              </div>
            </div>                     
          </div>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">链接URL：</label>
                <div class="col-sm-8">
                  <input type="url" class="form-control" name="surl" value="{{ $slid->surl }}"/>
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
                        <input type="file" class="form-control file-upload-info" placeholder="修改网站logo" style="background-color:#fff;" name="logo" value="{{ $slid->simg }}">
                        <img src="{{ $slid->simg }}"  style="width: 200px;height: 70px;border-radius: 0px;">
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
                      <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="0" @if ($slid->status==0) checked @endif>
                     未激活
                    </label>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="1" @if ($slid->status==1) checked @endif>
                     激活
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-gradient-primary mr-2">修改</button>
        </form>
      </div>
    </div>
  </div>
@endsection