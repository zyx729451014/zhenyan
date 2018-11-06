@extends('admin/layout/layout')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	@section('content-wrapper')
	<div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">类别添加</h4>
          <form class="form-sample" method="post" action="/admin/invitation/{{ $invitation->id }}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">标题：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="tetle" value="{{ $invitation['title'] }}" readonly="" />
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">类别：</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="cid">
                    	<option>--请选择--</option>
                      	<option value="0">顶级类别</option> 

                        @foreach($cates as $k=>$v)
                        <option value="{{ $v->cid }}" @if($invitation->cid == $v->cid) selected @endif>{{ $v->cname }}</option>
                        @endforeach                          
                    </select>
                  </div>
                </div>
              </div>                      
            </div>
             <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">内容：</label>
                  <div class="col-sm-12">
                     {!! $invitation['content'] !!}
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
                        <input type="radio" class="form-check-input" name="stick" id="membershipRadios1" value="1" @if($invitation['stick'] == 1) checked @endif>
                       置顶
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="stick" id="membershipRadios2" value="0" @if($invitation['stick'] == 0) checked @endif>
                       未置顶
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
</body>
</html>