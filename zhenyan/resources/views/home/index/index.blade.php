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
<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11"> 
				<article>
					<div class="heading">
						<h2><a href="#">帖子推荐</a></h2>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
						<p><h4>标题</h4></p>
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
							<li><a href="/home/index/notice/{{ $v['id'] }}">{{ $v['title'] }}</a></li>
							@endforeach
						</ul>
					</div>
				</section>
				<section>
					<div class="heading">热帖</div>
					<div class="content">
						<h4><a href="" style="color:#030303;">标题</a></h4>
						<h4><a href="" style="color:#030303;">标题</a></h4>
						<h4><a href="" style="color:#030303;">标题</a></h4>
						<h4><a href="" style="color:#030303;">标题</a></h4>
						<h4><a href="" style="color:#030303;">标题</a></h4>

					</div>
				</section>
				<section>
					<div class="heading">问答</div>
					<div class="content">
					<ul class="list">
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">2</a></li>					
					</ul>
					</div>
				</section>
				<section>
					<div class="heading">最受喜欢</div>
					<div class="content">
						<section>
							<img src="home/images/thumb4.jpg"/>
							<h4><a href="#" style="line-height:60px;">用户名</a></h4>							
						</section>
					</div>
					<div class="content">
						<section>
							<img src="home/images/thumb4.jpg"/>
							<h4><a href="#" style="line-height:60px;">用户名</a></h4>							
						</section>
					</div>
					<div class="content">
						<section>
							<img src="home/images/thumb4.jpg"/>
							<h4><a href="#" style="line-height:60px;">用户名</a></h4>							
						</section>
					</div>
					<div class="content">
						<section>
							<img src="home/images/thumb4.jpg"/>
							<h4><a href="#" style="line-height:60px;">用户名</a></h4>							
						</section>
					</div>

				</section>
			</div>
			
		</div>
	</div>
</section>  
@endsection