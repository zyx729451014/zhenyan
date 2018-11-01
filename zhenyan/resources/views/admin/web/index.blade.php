@extends('admin/layout/layout')
@section('content-wrapper')
			<div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">网站信息</h4>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站名称：</label>
                  <div class="col-sm-8">
                    {{ $web['name'] }}
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站描述：</label>
                  <div class="col-sm-8">
                    {{ $web['describe'] }}
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站logo：</label>
                  <div class="col-sm-8">
                  	<img src="{{ $web['logo'] }}">
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站备案号：</label>
                  <div class="col-sm-8">
                    {{ $web['filing'] }}
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">联系方式：</label>
                  <div class="col-sm-8">
                    {{ $web['telephone'] }}
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站状态：</label>
                  <div class="col-sm-8">
                  	@if ($web['statu']==1)
                  		开启
                  	@else
                  		维护
                  	@endif
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">网站URL地址：</label>
                  <div class="col-sm-8">
                   {{ $web['url'] }}
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">版权信息：</label>
                  <div class="col-sm-8">
                    {{ $web['cright'] }}
                  </div>
                </div>
              </div>                     
            </div>
            <a href="/admin/web/{{ $web['id'] }}/edit"><button type="button" class="btn btn-gradient-primary mr-2">修改</button></a>
        </div>
      </div>
    </div>
@endsection