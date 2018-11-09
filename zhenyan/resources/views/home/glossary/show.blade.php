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
	<div class="content" style="margin-top:90px;">
		<div style="border:1px solid #ccc; width:80px;height:30px;text-align:center;line-height:30px;margin-top:10px;"><a href="/home/glossary">返回</a></div>
		<div class="title">{{ $glossary->title }}</div>
		<div class="name"><span>Posted by </span>|<a href="">{{ $glossary->glossaryuser->uname }}</a></div>
		<div class="cont">
			<div class="tw1"></div>
			<div class="bpic">  
				<img src="" class="image">
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
			<form action="/home/glossary/collect" method="post" style="float:right;">
			{{ csrf_field() }}	
			<button type="submit" class="btn btn-gradient-primary" name="collect" value="{{ $glossary->id }}">收藏</button>
		</form>
		</div>
		<br>
		<p>总楼层 <?= count($glocomment)?> | 发表时间	{{ $glossary->created_at }}</p>

			<ol class="comment" >
				@foreach ($glocomment as $k=>$v)
				<li>

					<div style="height:10px;">
						<p style="float:right;">{{ $k+1 }}楼</p>
					</div>

					<cite>
						<img alt="" src="{{ $v->commentuser->userinfo->face }}" height="70" width="70" />			
						<a href="">{{ $v->commentuser->uname }}</a>
							<span>{{ $v->content }}</span> 
						<br />				
						<a href="">{{ $v->created_at }}</a><br>
					</cite>
						
					<div style="width:100%;height:10px;">
						<a href="#hf" style="float:right" class="hf">回复</a>
					</div>

					<div class="huifu">
						<ul>
							<?php
								 $gloreply = App\Models\Gloreply::where('cid',$v->id)->get();
							?>
							@foreach ($gloreply as $kk=>$vv)
								<li>
									<img src="{{ $vv->replyuser->userinfo->face }}" height="30" width="30">
									<a href="/home/user/usercenter/{{ $vv->glossaryuser['uid'] }}">{{ $vv->replyuser->uname }}</a>:<span>{{ $vv->content }}</span>
								</li>
							@endforeachn
							<li>
								<form action="/home/glossary/reply" method="post" class="fbpl fbpl1" style="width:750px;height:180px;" hidden>	
									{{ csrf_field() }}	
									<label for="message"></label><br />
									<input type="hidden" name="cid" value="{{ $v->id }}">
									<input type="hidden" name="gid" value="{{ $glossary->id }}">
									@if(session()->has('user'))
									<textarea id="message" name="content" rows="2" cols="30" tabindex="4" style="width:90%;margin-left:5%;"  placeholder="@ {{ $v->commentuser->uname }}　{{ $v['created_at'] }}"></textarea>	
									@else
									<?php  
										$uri=\Request::getRequestUri();
										session(['home_uri'=>$uri]);
									?>
									<div style="width:90%;margin-left:5%;height:70px;border:1px solid #ccc;background:#fff;text-align:center;line-height:70px;">
										<a href="/home/user/login">登录</a>后才可以回复哟~
									</div>
									@endif
									<input class="button" type="submit" value="回复" tabindex="5" style="background-color:#1e96b0;color:#fff;width:100px;margin-left:300px;height:40px;margin-top:10px;border:none;border-radius:10px;" />         		
								</form>	
							</li>
						</ul>
					</div>
				</li>
				@endforeach

			</ol>


			<h3>发表评论</h3>				
			
			<form action="/home/glossary/comment" class="fbpl" method="post">
				{{ csrf_field() }}	
					<label for="message"></label><br />
					<input type="hidden" name="gid" value="{{ $glossary->id }}">
					@if(session()->has('user'))
					<textarea id="message" name="content" rows="10" cols="30" tabindex="4" style="width:90%;margin-left:5%;"></textarea>	
					@else
					<div style="width:90%;margin-left:5%;height:200px;border:1px solid #ccc;background:#fff;text-align:center;line-height:200px;">
						<a href="/home/user/login">登录</a>后才可以评论哟~
					</div>
					@endif
					<input class="button" type="submit" value="发表" tabindex="5" style="background-color:#1e96b0;color:#fff;width:100px;margin-left:400px;height:40px;margin-top:10px;border:none;border-radius:10px;color:#fff;" />         		
			</form>	
	</div>
	<script type="text/javascript">
	$('.hf').click(function(){
		$(this).parent().next().find('form').slideToggle();;
	});

	</script>
</body>
</html>
@endsection