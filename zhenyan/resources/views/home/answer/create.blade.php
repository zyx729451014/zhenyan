@extends('home/layout/layout')
@section('content-wrapper')
<style type="text/css">
	.container{width: 970px;height: 100%;background-color: #e6e9e9;}
	.container>h3{color: #168da6;font-size: 25px;font-weight: bold;}	
	.container>form{width: 900px;height: 100%;}	
	.container>span{font-size: 18px;}
	.container>form>input[type='text']{margin-left: 10px;width: 650px;height: 30px;text-indent: 2em;}
	.container>form>select{width: 150px;margin-left: 50px;height: 30px;}
	.container>form>button{margin: 0px auto;background-color: #0f94b1;margin-top: 15px;margin-left: 400px;}
	.container>form>.ueditor{width: 900px;margin-left: 40px;margin-top: -10px;}
</style>
<section class="container" style="margin:100px auto;"> 
	<h3>发表问答</h3>
	<form method="post" action="/home/answer">
		{{ csrf_field() }}
		<span>问题:</span><input type="text" name="title" placeholder="标题" value="{{ old('title') }}">
		<br><br>
		<span>回答:</span>
		<div class="ueditor">
			<!-- 加载编辑器的容器 -->
		    <script id="content" name="content" type="text/plain" placeholder="内容" class="small" value="{{ old('content') }}" style="height:500px">
		        
		    </script>
		   
		</div>
		
		<button type="submit" class="btn btn-gradient-primary">发布</button>
	</form>
	<!-- 配置文件 -->
    <script type="text/javascript" src="\home\utf8-php\ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="\home\utf8-php\ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('content',{toolbars: [
    ['fullscreen', 'source', 'undo', 'redo', 'bold','indent','snapscreen','italic','underline','strikethrough','subscript','fontborder','superscript','formatmatch',
    	,'insertrow','insertcol','mergeright','mergedown','deleterow','deletecol','splittorows','splittocols','splittocells','deletecaption','inserttitle','mergecells',
    	,'deletetable','justifyright','justifycenter','justifyjustify','forecolor','backcolor','insertorderedlist','imagecenter']
	]});
    </script>
</section> 
@endsection