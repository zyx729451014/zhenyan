@extends('admin/layout/layout')
@section('content-wrapper')
			<div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">网站信息</h4>
          <form class="form-sample" method="post" action="/admin/web/{{ $web['id'] }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站名称：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="{{ $web['name'] }}">
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站描述：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="describe" value="{{ $web['describe'] }}">
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站logo：</label>
                  <div class="col-sm-8">
                      <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" placeholder="修改网站logo" style="background-color:#fff;" name="logo">
                        <img src="{{ $web['logo'] }}">
                      </div>

                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站备案号：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="filing" value="{{ $web['filing'] }}">
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">联系方式：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="telephone" value="{{ $web['telephone'] }}">
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">网站状态：</label>
                <div class="col-sm-2">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="statu" id="identity" value="1" @if ($web['statu']==1) checked @endif>
                     开启
                    </label>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="statu" id="identity" value="2" @if ($web['statu']==2) checked @endif>
                     维护
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站URL地址：</label>
                  <div class="col-sm-8">
                    <input type="url" class="form-control" name="url" value="{{ $web['url'] }}">
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">版权信息：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="cright" value="{{ $web['cright'] }}"> 
                  </div>
                </div>
              </div>                     
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">确认</button>
            </form>
        </div>
      </div>
    </div>
@endsection