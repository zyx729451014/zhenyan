@extends('home/layout/layout')
@section('content-wrapper')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/home/css/style4.css">
	<script type="text/javascript" src="/home/js/jquery-1.8.3.min.js"></script>
	<style type="text/css">
		#cont{
			height: auto;
		}
		#content #cont p{
			width: 100%;
			height: 40px;
			background-color: #f8f8f8;
			line-height: 40px;
			font-size: 13px;
		}
	</style>
</head>
<body>
	<div class="content" style="margin-top:90px;">
		<form method="post" action="/home/invitation/update/{{ $invitation->id }}">
			{{ csrf_field() }}
			<span style="font-size:15px;line-height:40px;">标题:</span>	<input type="text" value="{{ $invitation->title }}" name="title" class="title" style="width:900px;">
			<div class="name"><span>Posted by </span>|<a href="">{{ $invitation->invitationuser->uname }}</a></div>
			<div class="ueditor">
			<!-- 加载编辑器的容器 -->
		    <script id="content" name="content" type="text/plain" placeholder="内容" class="small" value="{{ old('content') }}" style="height:500px">
		        {!! $invitation->content !!}	
		    </script>
		   
		</div>
			<button type="submit" style="background:#07aacd;color:#fff;margin-left:940px;margin-top:10px;"class="btn btn-default btn-search">修改</button>
		</form>
		
	</div>
</body>
</html>
<script type="text/javascript">
	$('.hf').click(function(){
		$(this).parent().next().find('form').slideToggle();;
	});

</script>
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
@endsection