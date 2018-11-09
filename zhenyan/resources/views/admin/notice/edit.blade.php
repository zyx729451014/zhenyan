@extends('admin/layout/layout');
@section('content-wrapper')
<div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ $title }}</h4>
          <form class="form-sample" method="post" action="/admin/notice/{{ $notice->id }}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">公告标题：</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" value='{{ $notice["title"] }}' />
                  </div>
                </div>
              </div>                     
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">公告内容：</label>
                  <div class="col-sm-8">
                    <script id="content" style='width:800px;' name="content" type="text/plain" placeholder="内容" class="small" value="{{ old('content') }}" style="height:500px">
                        {!! $notice->content !!}  
                    </script>
                  </div> 
                </div>
              </div>                     
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">修改</button>
          </form>
        </div>
      </div>
    </div>
    </script>
<!-- 配置文件 -->
    <script type="text/javascript" src="\home\utf8-php\ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="\home\utf8-php\ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('content',{toolbars: [
    
        ]});
    </script>
@endsection
