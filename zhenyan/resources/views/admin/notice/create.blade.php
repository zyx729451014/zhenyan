@extends('admin/layout/layout');
@section('content-wrapper')
<div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ $title }}</h4>
          <form class="form-sample" method="post" action="/admin/notice">
          {{ csrf_field() }}
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">公告标题：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" />
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">公告内容：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="content" />
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
