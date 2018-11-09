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
		<div class="title">{{ $notice->title }}</div>
		<div class="name">
			<div id="cont">{{ $notice->content }}	</div>
			<p>总楼层  <?= count($notice_comments)?>  | 发表时间 {{ $notice->created_at }} </p>
			@foreach($notice_comments as $k=>$v)
			<ol class="comment">

				<li>

					<div style="height:10px;">
						<p style="float:right;">{{ $k+1 }}楼</p>
					</div>
					
					<cite>
						<a href="/home/user/usercenters/{{ $v->uid }}"><img alt="" src="{{ $v->notice_commentuser->userinfo->face }}" height="70" width="70" /></a>			
						<a href="/home/user/usercenters/{{ $v->uid }}">{{ $v->notice_commentuser->uname }}</a> 
						<span style='color:#000;'>{{ $v['content'] }}</span>
						<br />				
						<a href="#comment-63">{{ $v['created_at'] }}</a><br>
					</cite>
						
					<div style="width:100%;height:10px;">
						<a href="" style="float:right" class="hf">回复</a>
					</div>
					<div class="huifu">
						<?php
							$notice_replys = App\Models\Notice_reply::where('cid','=',$v['id'])->get();
						?>
						<ul>
							@foreach($notice_replys as $kk=>$vv)
							<li>
								<img src="{{ $vv->notice_replyuser->userinfo->face }}" height="20" width="20">
								<a href="/home/information/{{ $vv->notice_replyuser->uid }}">{{ $vv->notice_replyuser->uname }}</a>:<span>{{ $vv['content'] }}</span>
							</li>
							@endforeach
							<li>
								<form action="/home/noticereply/store" method="post" class="fbpl fbpl1" style="width:750px;height:150px;" hidden="hidden">	
									{{ csrf_field() }}	
									<label for="message"></label><br />
									<input type="hidden" name="nid" value="{{ $notice->id }}">
									<input type="hidden" name="cid" value="{{ $v->id }}">
									<textarea id="message" name="content" rows="3" cols="30" tabindex="4" style="width:90%;margin-left:5%;"  placeholder="@ {{ $v->notice_commentuser->uname }}　{{ $v['created_at'] }}"></textarea>	
									<input class="button" type="submit" value="回复" tabindex="5" style="background-color:#1e96b0;color:#fff;width:100px;margin-left:300px;height:40px;margin-top:10px;border:none;border-radius:10px;">         		
								</form>	
							</li>
						</ul>
					</div>
				</li>
			</ol>
			@endforeach
			<h3>发表评论</h3>
			<form action="/home/noticecomment/store" method="post" class="fbpl">	
			{{ csrf_field() }}	
					<label for="message"></label><br>
					<input type="hidden" name='nid' value="{{ $notice->id }}">
					<textarea id="message" name="content" rows="10" cols="30" tabindex="4" style="width:90%;margin-left:5%;"></textarea>	
					<input class="button" type="submit" value="发表" tabindex="5" style="background-color:#1e96b0;width:100px;color:#fff;margin-left:400px;height:40px;margin-top:10px;border:none;border-radius:10px;">        		
			</form>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$('.hf').click(function(){
		$(this).parent().next().find('form').toggle();
	});
</script>
@endsection