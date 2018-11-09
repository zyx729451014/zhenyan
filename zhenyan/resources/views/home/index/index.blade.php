@extends('home/layout/layout')
@section('content-wrapper')

<!-- 轮播图 -->
<?php
		$slids = \App\Models\Slid::where('status',1)->get();
?>
<div id="banner_tabs" class="flexslider" style="width:1920px;margin:0px auto;">
	<ul class="slides">
		@foreach($slids as $k=>$v)
		<li style="width:1920px;height:482px;">
			<a title="" target="_blank" href="#">
				<img   width="1920" height="482" alt="" style="background: url('{{ $v->simg }}') no-repeat center;" src="{{ $v->simg }}">
			</a>
		</li>
		@endforeach
	</ul>
	<ul class="flex-direction-nav">
		<li><a class="flex-prev" href="javascript:;">Previous</a></li>
		<li><a class="flex-next" href="javascript:;">Next</a></li>
	</ul>
	<ol id="bannerCtrl" class="flex-control-nav flex-control-paging">
		@foreach($slids as $k=>$v)
		<li style="background:none;"><a></a></li>
		@endforeach
	</ol>
</div>
<script type="text/javascript">
$(function() {
	var bannerSlider = new Slider($('#banner_tabs'), {
		time: 5000,
		delay: 400,
		event: 'hover',
		auto: true,
		mode: 'fade',
		controller: $('#bannerCtrl'),
		activeControllerCls: 'active'
	});
	$('#banner_tabs .flex-prev').click(function() {
		bannerSlider.prev()
	});
	$('#banner_tabs .flex-next').click(function() {
		bannerSlider.next()
	});
})
</script>
</div>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
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
		*{
			text-decoration: none;
		}
		#cont{height: auto;}
		#content #cont p{width: 100%;height: 40px;background-color: #f8f8f8;line-height: 40px;font-size: 13px;}	
		#invi{height: auto;}
		#invi h2{height:20px;line-height: 20px;padding-bottom: 40px;}
		#invi a{line-height: 25px;font-size: 15px;color: #383838;text-decoration: none;}
		#invi span{display: inline-block;float: right;color: #9d9f9f;font-size: 13px;}
		#invi a:hover{color: #249db7;}
		#comm h4{width: 310px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;}
		#comm a{line-height: 25px;font-size: 15px;color: #383838;text-decoration: none;}
		#comm a:hover{color: #249db7;}	
		#idol h4>a{font-size: 15px;color: #383838;text-decoration: none;display: inline-block;margin-left: 20px;}	
		#idol a:hover{color: #249db7;}		
		#idol img{width: 60px;height: 60px;border: none;}	
	</style>
</head>
<body>


<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11"> 
				<article>
					<div class="heading" id="invi">
						<h2>帖子推荐</h2>
						@foreach($invitation as $k=>$v)
						<h4><a href="/home/invitation/show/{{ $v['id'] }}">{{ $v->title }}</a><span>{{ $v->created_at }}</span></h4>
						@endforeach
					</div>
				</article>
				<article>
					<div class="heading">
						<h2><a href="/home/glossary" style="color:#333;">图集</a></h2>
						@foreach($glossary as $k=>$v)
						<ul>
						<p><h4>
						<a href="/home/glossary/{{ $v->id }}" style="font-size: 15px;color: #383838;text-decoration: none;">{{ $v->title }}</a>
								<span style="display: inline-block;float: right;color: #9d9f9f;font-size: 13px;">{{ $v->created_at }}</span></h4></p>
						<?php 
							$image = explode('!-!', $v->image);
						?>
						@foreach ($image as $kk=>$vv)
						<li style="width:1000px;"><a href="/home/glossary/{{ $v->id }}"><img src="{{ $vv }}" style="height:100px;"></a></li>
						@endforeach
						</ul>
					@endforeach
					</div>
					
				</article>
				
			</div>
			
			<div class="sidebar col05">
				<section>
					<div class="heading">公告</div>
					<div class="content">

						<ul class="list">
							@foreach($notice as $k=>$v)
							<li style="overflow:hidden;"><a href="/home/index/show/{{ $v['id'] }}">{{ $v['title'] }}</a>
							</li>
							@endforeach
						</ul>
					</div>
				</section>
				<section>
					<div class="heading">热帖</div>
					<div class="content" id="comm">
						@foreach($comment as $k=>$v)
						<h4><a href="/home/invitation/show/{{ $v[0]['id'] }}">{{ $v[0]['title'] }}</a></h4>
						@endforeach
					</div>
				</section>
				<section>
					<div class="heading">问答</div>
					<div class="content">
					<ul class="list">
						@foreach($answer as $k => $v)
						<li style="overflow:hidden;"><a href="/home/answer/{{ $v['id'] }}">{{ $v['title'] }}</a></li>
						@endforeach	
					</ul>
					</div>
				</section>
				<section>
					<div class="heading">最受喜欢</div>
					<div class="content" id="idol">
					@foreach($idol as $k=>$v)
							<a href="/home/user/usercenters/{{ $v[0]->uid }}"><img src="{{ $v[0]->userinfo->face }}"/></a>
							<h4><a href="/home/user/usercenters/{{ $v[0]->uid }}" style="line-height:60px;">{{ $v[0]->uname }}</a></h4>							
					@endforeach
					</div>
				</section>
			</div>
			
		</div>
	</div>
</section>  
</body>
</html>
@endsection