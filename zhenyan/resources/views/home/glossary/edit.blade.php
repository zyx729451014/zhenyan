@extends('home/layout/layout')
@section('content-wrapper')
<style type="text/css">
	.container{width: 970px;height: 100%;background-color: #e6e9e9;}
	.container>h3{color: #168da6;font-size: 25px;font-weight: bold;}	
	.container>form{width: 900px;height: 100%;}	
	.container> span{font-size: 18px;}
	.container>form>ul>li{margin-top: 50px;}
	.container>form input[type='text']{margin-left: 10px;width: 600px;height: 40px;text-indent: 2em;}
	.container>form input[type='file']{width: 550px;height: 50px;border:1px solid #ccc;margin-left: 100px;}
	.container>form>select{width: 150px;margin-left: 50px;height: 30px;}
	.container>form>button{margin: 50px auto;background-color: #0f94b1;margin-top: 15px;margin-left: 400px;}
</style>
<section class="container">
	<h3>发贴</h3>
	<form method="post" action="/home/glossary/{{ $glossary->id }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        {{ method_field('PUT') }}
		<ul>
			<li><span>标　　题:</span><input type="text" name="title" placeholder="请输入标题" value="{{ $glossary->title }}"></li>
			<li><span>上传图片:</span><input type="file" name="image[]" value="" multiple></li>
			<li>
				<?php 
					$image = explode('!-!', $glossary->image);
				?>
				@foreach ($image as $k=>$v)
				<img src="{{ $v }}" style="height:100px;margin-top:5px;">
				@endforeach
			</li>
		</ul>
		
		<button type="submit" class="btn btn-gradient-primary">发布</button>
	</form>
</section> 
@endsection