@extends('home/layout/layout')
@section('content-wrapper')
<!-- 轮播图 -->

	<?php
		$slids = \App\Models\Slid::where('status',1)->get();
	?>
	<div class="banner" style="margin-top: 65px;">
		<ul>
			@foreach($slids as $k=>$v)
			<li style="background-image: url('{{ $v->simg }}');">
				<div class="inner">
					<h1></h1>
				</div>
			</li>			
			@endforeach
		</ul>
	</div>
	<script src="/home/js/jquery-1.11.0.min.js"></script>

	<script src="/home/js/jquery.event.move.js"></script>
	<script src="/home/js/jquery.event.swipe.js"></script>
	
	<script src="/home/js/unslider.min.js"></script>
	<script src="/home/js/bootstrap.min.js"></script>

	<script>
		if(window.chrome) {
			$('.banner li').css('background-size', '100% 100%');
		}

		$('.banner').unslider({
			arrows: true,
			fluid: true,
			dots: true,
			keys: true
		});

		//  Find any element starting with a # in the URL
		//  And listen to any click events it fires
		$('a[href^="#"]').click(function() {
			//  Find the target element
			var target = $($(this).attr('href'));

			//  And get its position
			var pos = target.offset(); // fallback to scrolling to top || {left: 0, top: 0};

			//  jQuery will return false if there's no element
			//  and your code will throw errors if it tries to do .offset().left;
			if(pos) {
				//  Scroll the page
				$('html, body').animate({
					scrollTop: pos.top,
					scrollLeft: pos.left
				}, 1000);
			}

			//  Don't let them visit the url, we'll scroll you there
			return false;
		});
	</script>

	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="/home/css/style4.css">
	<script type="text/javascript" src="/home/js/jquery-1.8.3.min.js"></script>
	<style type="text/css">
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
						<h2><a href="#">图文帖</a></h2>
						<p><h4>标题</h4></p>
					</div>
					<div class="content">
						<img src="home/images/thumb2.jpg"/>
						<p>内容</p>
					</div>
				</article>
				<article>
					<div class="heading">
						<p><h4>标题</h4></p>
					</div>
					<div class="content">
						<img src="home/images/thumb2.jpg"/>
						<p>内容</p>
					</div>
				</article>
				<article>
					<div class="heading">
						<p><h4>标题</h4></p>
					</div>
					<div class="content">
						<img src="home/images/thumb2.jpg"/>
						<p>内容</p>
					</div>
				</article>
				<article>
					<div class="heading">
						<p><h4>标题</h4></p>
					</div>
					<div class="content">
						<img src="home/images/thumb2.jpg"/>
						<p>内容</p>
					</div>
				</article>
				<article>
					<div class="heading">
						<p><h4>标题</h4></p>
					</div>
					<div class="content">
						<img src="home/images/thumb2.jpg"/>
						<p>内容</p>
					</div>
				</article>
			</div>
			
			<div class="sidebar col05">
				<section>
					<div class="heading">公告</div>
					<div class="content">

						<ul class="list">
							@foreach($notice as $k=>$v)
							<li><a href="/home/index/show/{{ $v['id'] }}">{{ $v['title'] }}</a></li>
							@endforeach
							<li><a href="/home/index/show/{{ $v['id'] }}"></a></li>
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
						<li><a href="/home/answer/{{ $v['id'] }}">{{ $v['title'] }}</a></li>
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