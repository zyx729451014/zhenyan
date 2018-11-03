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
	<div class="content">
		<div class="title">{{ $invitation['title'] }}</div>
		<div class="name"><span>Posted by </span>|<a href="">{{ $invitation->invitationuser->uname }}</a></div>
		<div id="cont">
				{!! $invitation['content'] !!}
			<p>总楼层 | 发表时间</p>

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
					<textarea id="message" name="message" rows="10" cols="30" tabindex="4" style="width:90%;margin-left:5%;"></textarea>	
					<input class="button" type="submit" value="发表" tabindex="5" style="background-color:#1e96b0;width:100px;margin-left:400px;height:40px;margin-top:10px;border:none;border-radius:10px;" />         		
			</form>	
		</div>
	</div>
</body>
</html>
@endsection