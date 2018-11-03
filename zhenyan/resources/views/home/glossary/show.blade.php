@extends('home/layout/layout')
@section('content-wrapper')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/home/dateails/style.css">
	<script type="text/javascript" src="/home/dateails/jquery-1.8.3.min.js"></script>
</head>
<body>
	<div class="content">
		<div style="border:1px solid #ccc; width:80px;height:30px;text-align:center;line-height:30px;margin-top:10px;"><a href="/home/glossary">返回</a></div>
		<div class="title">{{ $glossary->title }}</div>
		<div class="name"><span>Posted by </span>|<a href="">{{ $glossary->glossaryuser->uname }}</a></div>
		<div class="cont">
			<div class="tw1"></div>
			<div class="bpic">
				<img src="./1.jpg" class="image">
			</div>
			<div class="spic">
				<ul class="spic">
					<?php 
						$image = explode('!-!', $glossary->image);
					?>
					@foreach ($image as $k=>$v)
					<li><a href=""><img src="{{ $v }}"></a></li>
					@endforeach
				</ul>
			</div>
			<script type="text/javascript">
			var i=0;
			var time=null;
				$('.spic img:not(.image)').mouseover(function(){
					clearInterval(time);
					time=null;
					$(this).css('border','1px solid #000');
					$('.image').attr('src',$(this).attr('src'));
				}).mouseout(function(){
					run();
					$(this).css('border','');

				});
			
			function run(){
				if (time==null) {
					time=setInterval(function(){
						$('.image').attr('src',$('.spic img:not(.image)').eq(i).attr('src'));
						$('.spic img:not(.image)').eq(i).attr('src');
						i++;
						if (i>=$('.spic img:not(.image)').length) {
							i=0;
						};
					},1500);
				};
			}
			run();
			
			</script>
			<div class="tw2"></div>
			
		</div>
		<p>总楼层 | 发表时间	{{ $glossary->created_at }}</p>

			<ol class="comment">

				<li>

					<div style="height:10px;">
						<p style="float:right;">1楼</p>
					</div>

					<cite>
						<img alt="" src="images/gravatar.jpg" height="70" width="70" />			
						<a href="index.html">名字</a> Says: <br />				
						<a href="#comment-63">时间</a><br>
					</cite>
						<span>Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!</span>
					<div style="width:100%;height:10px;">
						<a href="" style="float:right">回复</a>
					</div>

					<div class="huifu">
						<ul>
							<li>
								<img src="images/gravatar.jpg" height="20" width="20">
								<a href="">名字</a>:<span>Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!Comments are great!</span>
							</li>
							<li>
								<img src="images/gravatar.jpg" height="20" width="20">
								<a href="">名字</a>:<span>Comments are great!</span>
							</li>
							<li>
								<img src="images/gravatar.jpg" height="20" width="20">
								<a href="">名字</a>:<span>Comments are great!</span>
							</li>
							<li>
								<img src="images/gravatar.jpg" height="20" width="20">
								<a href="">名字</a>:<span>Comments are great!</span>
							</li>
						</ul>
					</div>
				</li>

			</ol>


			<h3>发表评论</h3>				
			
			<form action="index.html" method="post" class="fbpl">		
					<label for="message"></label><br />
					<textarea id="message" name="message" rows="7" cols="30" tabindex="4" style="width:90%;margin-left:5%;border:1px solid #333;"></textarea>	
					<input class="button" type="submit" value="发表" tabindex="5" style="background-color:#1e96b0;width:100px;margin-left:400px;height:40px;margin-top:10px;border:none;border-radius:10px;color:#fff;" />         		
			</form>	
	</div>
	<div style="clear:both;"></div>
</body>
</html>
@endsection