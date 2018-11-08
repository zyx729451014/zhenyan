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
	<div class="content" style="margin-top:100px;">
		<div class="title">{{ $answer->title }}</div>
		<div class="name"><span>Posted by </span>|<a href="">{{ $answer->answersuser->uname }}</a></div>
		<div id="cont">
		{!! $answer->content !!}
		</div>
		<p>总回答数 <?= count($answer_comment)?> | 发表时间  {{ $answer->created_at }}</p>
			@foreach($answer_comment as $k => $v)
			<ol class="comment">

				<li>

					<div style="height:10px;">
						<p style="float:right;">{{ $k+1 }}楼</p>
					</div>
					
					<cite>
						<img alt="" src="{{ $v->answer_commentuser->userinfo->face }}" height="70" width="70" />			
						<a href="index.html">{{ $v->answer_commentuser->uname }}</a> 
						<span style='color:#333;'>{{ $v['content'] }}</span>
						<br />				
						<a href="#comment-63">{{ $v['created_at'] }}</a><br>
					</cite>
					<div style="width:100%;height:10px;">
						<a href="#hf" style="float:right" class="hf">回复</a>
					</div>
					<div class="huifu">
						<?php
							$answer_replys = App\Models\Answer_reply::where('cid','=',$v['id'])->get();
						?>
						<ul>
							@foreach($answer_replys as $kk => $vv)
							<li>
								<img src="{{ $vv->answer_replyuser->userinfo->face }}" height="20" width="20">
								<a href="/home/information/{{ $vv->answer_replyuser->uid }}">{{ $vv->answer_replyuser->uname }}</a>:<span>{{ $vv['content'] }}</span>
							</li>
							@endforeach
							<li>
								<form action="/home/answer_reply/store" method="post" class="fbpl fbpl1" style="width:750px;height:150px;" hidden="hidden">	
									{{ csrf_field() }}	
									<label for="message"></label><br />
									<input type="hidden" name="aid" value="{{ $answer->id }}">
									<input type="hidden" name="cid" value="{{ $v->id }}">
									@if(session()->has('user'))
									<textarea id="message" name="content" rows="3" cols="30" tabindex="4" style="width:90%;margin-left:5%;"  placeholder="@ {{ $v->answer_commentuser->uname }}　{{ $v['created_at'] }}"></textarea>	
									@else
									<?php  
										$uri=\Request::getRequestUri();
										session(['home_uri'=>$uri]);
									?>
									<div style="width:90%;margin-left:5%;height:70px;border:1px solid #ccc;background:#fff;text-align:center;line-height:70px;">
										<a href="/home/user/login">登录</a>后才可以回复哟~
									</div>
									@endif
									<input class="button" type="submit" value="回复" tabindex="5" style="background-color:#1e96b0;width:100px;margin-left:300px;height:40px;margin-top:10px;border:none;border-radius:10px;">         		
								</form>	
							</li>
						</ul>
					</div>
					
				</li>

			</ol>
			@endforeach
			
			


			<h3>回答</h3>				
			
			<form action="/home/answer_comment/store" method="post" class="fbpl">	
			{{ csrf_field() }}	
					<label for="message"></label><br />
					<input type="hidden" name="aid" value="{{ $answer['id'] }}">
					@if(session()->has('user'))
					<textarea id="message" name="content" rows="10" cols="30" tabindex="4" style="width:90%;margin-left:5%;"></textarea>	
					@else
					<div style="width:90%;margin-left:5%;height:200px;border:1px solid #ccc;background:#fff;text-align:center;line-height:200px;">
						<a href="/home/user/login">登录</a>后才可以回答哟~
					</div>
					@endif
					<input class="button" type="submit" value="发表" tabindex="5" style="background-color:#1e96b0;width:100px;margin-left:400px;height:40px;margin-top:10px;border:none;border-radius:10px;" />         		
			</form>
	</div>
</body>
</html>
<script type="text/javascript">
	$('.hf').click(function(){
		$(this).parent().next().find('form').slideToggle();
	});

</script>
@endsection