@extends('admin/layout/layout');
@section('content-wrapper')
<div class="col-md-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">友情链接添加</h4>
                  <form class="forms-sample" action="/admin/links" method="post">
                  {{ csrf_field() }}
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-1 col-form-label">链接名称</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="lname" id="exampleInputUsername2" placeholder="友情链接名称" value='{{ old("lname") }}'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-1 col-form-label">链接URL</label>
                      <div class="col-sm-6">
                        <input type="url" class="form-control" name="lurl" id="exampleInputEmail2" placeholder="URL地址" value='{{ old("lurl") }}'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-1 col-form-label">状态</label>
                      <div class="col-sm-1">
                           <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" checked>
                                激活
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="0">
                                未激活
                              </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">添加</button>
                    
                  </form>
                </div>
              </div>
            </div>
@endsection