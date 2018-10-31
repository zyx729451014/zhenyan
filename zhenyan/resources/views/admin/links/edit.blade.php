@extends('admin/layout/layout');
@section('content-wrapper')
<div class="col-md-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">友情链接修改</h4>
                  <form class="forms-sample" action="/admin/links/{{$link->id}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-1 col-form-label">链接名称</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="lname" id="exampleInputUsername2" placeholder="友情链接名称" value='{{ $link->lname }}'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-1 col-form-label">链接URL</label>
                      <div class="col-sm-6">
                        <input type="url" class="form-control" name="lurl" id="exampleInputEmail2" placeholder="URL地址" value='{{ $link->lurl }}'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-1 col-form-label">状态</label>
                      <div class="col-sm-1">
                           <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" @if ($link->status==1)checked @endif>
                                激活
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="0" @if ($link->status==0)checked @endif>
                                未激活
                              </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">修改</button>
                    
                  </form>
                </div>
              </div>
            </div>
@endsection