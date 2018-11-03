<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="www.zhenyan.com">
	<title>臻妍论坛</title>

		<!-- 首页 -->
		<link rel="stylesheet" type="text/css" href="/home/css/style2.css">
		<link rel="stylesheet" href="/home/css/zerogrid.css">
		<link rel="stylesheet" href="/home/css/style.css">
	    <link rel="stylesheet" href="/home/css/responsive.css">
		<link rel="stylesheet" href="/home/css/responsiveslides.css" />
		<link href='/home/images/favicon.ico' rel='icon' type='image/x-icon'/>
		<script src="/home/js/responsiveslides.js"></script>
		<script>
	    $(function () {
	      $("#slider").responsiveSlides({
	        auto: true,
	        pager: true,
	        nav: true,
	        speed: 500,
	        maxwidth: 800,
	        namespace: "centered-btns"
	      });
	    });
	  </script>
	  <!-- 轮播图 -->
	 <link rel="stylesheet" type="text/css" href="/home/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="/home/css/default.css">
	<link rel="stylesheet" href="/home/css/style1.css">

	<link href="/home/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/home/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/home/css/flexible-bootstrap-carousel.css" />
	<link rel="stylesheet" href="/home/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="/home/css/styles1.css" />

	<link rel="stylesheet" type="text/css" href="/home/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/home/css/nprogress.css">
	<link rel="stylesheet" type="text/css" href="/home/css/font-awesome.min.css">
	<script src="/home/js/jquery-2.1.4.min.js"></script>
	<script src="/home/js/nprogress.js"></script>
	<script src="/home/js/jquery.lazyload.min.js"></script>
</head>
<body>
<!-- 导航 -->
	<header>
	<?php
		$cates = \App\Models\Cates::select()->where('pid','=',0)->get();
	?>
		<nav>
			<ul>			
				<li><a href="/">首页</a></li>
				@foreach($cates as $k=>$v)
				<li><a href="/home/invitation/{{ $v['cid'] }}">{{ $v['cname'] }}</a></li>
				@endforeach
				<li><a href="#">问答</a></li>
			</ul>
			@if (session()->has('user'))
			<button style='height:30px;float: right;line-height: 75px;'>欢迎您：{{ session('user')->uname }}</button>
				<div class="person" style="display: none;">
					<li><a href="/home/user/userdateail" style='text-decoration:none;color:#333;'>个人中心</a></li>
					<li><a href="/home/user/logout" style='text-decoration:none;color:#333;'>退出</a></li>
				</div>
			@else
			<a href="/home/user/login">登录</a>
			<a href="/home/user/register">注册</a>
			@endif
		</nav>
	</header>
	<script type="text/javascript">
		$(function(){
			$('nav button').click(function(){
				// 停止正在执行的动画  并且隐藏
				$('.person:animated').stop().hide();
				// 切换滑动效果
				$('.person').slideToggle('slow');
			});
		});
	</script>
<!-- 轮播图 -->
	<div class="banner" style="margin-top: 65px;">
		<ul>
			<li style="background-image: url('img/sunset.jpg');">
				<div class="inner">
					<h1>The jQuery slider that just slides.</h1>
					<p>No fancy effects or unnecessary markup, and it’s less than 3kb.</p>
				</div>
			</li>

			<li style="background-image: url('img/wood.jpg');">
				<div class="inner">
					<h1>Fluid, flexible, fantastically minimal.</h1>
					<p>Use any HTML in your slides, extend with CSS. You have full control.</p>
				</div>
			</li>

			<li style="background-image: url('img/subway.jpg');">
				<div class="inner">
					<h1>Open-source.</h1>
					<p>Everything to do with Unslider is hosted on GitHub.</p>
				</div>
			</li>

			<li style="background-image: url('img/shop.jpg');">
				<div class="inner">
					<h1>Uh, that’s about it.</h1>
					<p>I just wanted to show you another slide.</p>
				</div>
			</li>
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

<!-- 内容 -->
@section('content-wrapper')
@show
	<!-- 推荐位广告 -->
	<script src="/home/http://www.jq22.com/jquery/jquery-1.8.2.js" type="text/javascript"></script>

	<script src="/home/js/jquery.carouFredSel-6.0.4-packed.js" type="text/javascript"></script>
	<script type="text/javascript">

			$(function() {

				$('#carousel ul').carouFredSel({

					prev: '#prev',

					next: '#next',

					pagination: "#pager",

					scroll: 1000

				});

	

			});
	</script>

	<style type="text/css">
		#wrapper {

			width: 965px;

			height: 220px;

			margin: 0px auto;

			position: absolute;

			left: 50%;

			top: 50%;

		}



		#carousel {

			width: 1000px;
			position:vrelative;
			margin: 0px auto;

		}

		#carousel ul {

			list-style: none;

			display: block;

			margin: 0;

			padding: 0;

		}

		#carousel li {

			background: transparent url(img/carousel_polaroid.png) no-repeat 0 0;

			font-size: 40px;

			color: #999;

			text-align: center;

			display: block;

			width: 232px;

			height: 178px;

			padding: 0;

			margin: 6px;

			float: left;

			position: relative;

		}

		#carousel li img {

			width: 201px;

			height: 127px;

			margin-top: 14px;

		}

		#carousel li span {

			background: transparent url(img/carousel_shine.png) no-repeat 0 0;

			text-indent: -999px;

			display: block;

			overflow: hidden;

			width: 201px;

			height: 127px;

			position: absolute;

			z-index: 2;

			top: 14px;

			left: 16px;

		}			



		.clearfix {

			float: none;

			clear: both;

		}

		#carousel .prev, #carousel .next {

			background: transparent url(img/carousel_control.png) no-repeat 0 0;

			text-indent: -999px;

			display: block;

			overflow: hidden;

			width: 15px;

			height: 21px;

			margin-left: 10px;

			position: absolute;

			top: 70px;				

		}

		#carousel .prev {

			background-position: 0 0;

			left: -30px;

		}

		#carousel .prev:hover {

			left: -31px;

		}			

		#carousel .next {

			background-position: -18px 0;

			right: -20px;

		}

		#carousel .next:hover {

			right: -21px;

		}				

		#carousel .pager {

			text-align: center;

			margin: 0 auto;

		}

		#carousel .pager a {

			background: transparent url(img/carousel_control.png) no-repeat -2px -32px;

			text-decoration: none;

			text-indent: -999px;

			display: inline-block;

			overflow: hidden;

			width: 8px;

			height: 8px;

			margin: 0 5px 0 0;

		}

		#carousel .pager a.selected {

			background: transparent url(img/carousel_control.png) no-repeat -12px -32px;

			text-decoration: underline;				

		}

		

		#source {

			text-align: center;

			width: 100%;

			position: absolute;

			bottom: 10px;

			left: 0;

		}

		#source, #source a {

			font-size: 12px;

			color: #999;

		}

		

		#donate-spacer {

			height: 100%;

		}

		#donate {

			border-top: 1px solid #999;

			width: 750px;

			padding: 50px 75px;

			margin: 0 auto;

			overflow: hidden;

		}

		#donate p, #donate form {

			margin: 0;

			float: left;

		}

		#donate p {

			width: 650px;

		}

		#donate form {

			width: 100px;

		}

	</style>

			<div id="carousel">

				<ul>

					<li><img src="/home/img/up1.jpg" alt="" /><span>Image1</span></li>

					<li><img src="/home/img/up2.jpg" alt="" /><span>Image2</span></li>

					<li><img src="/home/img/up3.jpg" alt="" /><span>Image3</span></li>

					<li><img src="/home/img/up4.jpg" alt="" /><span>Image4</span></li>

					<li><img src="/home/img/up5.jpg" alt="" /><span>Image5</span></li>

					<li><img src="/home/img/up6.jpg" alt="" /><span>Image6</span></li>					

				</ul>

			</div>
<!-- 尾部 -->
	<footer>
		<div class="footer-top">
			
			<ol>
				<h4>友情链接：</h4>
				<a href="">财新网</a>
				<a href="">财经网</a>
				<a href="">南方周末</a>
				<a href="">新京报</a>
				<a href="">hao1232345</a>
				<a href="">星岛环球网</a>
				<a href="">海南房产</a>
				<a href="">环球网(英语)</a>
				<a href="">星辰在线</a>
				<a href="">红网</a>
				<a href="">西部网</a>
				<a href="">亚心网</a>
				<a href="">华声在线</a>
				<a href="">中国周刊</a>
				<a href="">扬子晚报</a>
				<a href="">海南旅游网</a>
				<a href="">海南在线</a>
				<a href="">广西旅游在线</a>
				<a href="">中国改革论坛</a>
				<a href="">清博大数据</a>
				<a href="">凯迪网络</a>
				<a href="">去哪TV</a>
				<a href="">交易街商业信息</a>
				<a href="">北京参考</a>
				<a href="">雄安论坛</a>
				<a href="">天眼查NBA直播吧</a>
			<ol>
		</div>
		<div class="footer-bottom">
			<ul>
				<li><a href="">关于甄妍 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">广告服务 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">甄妍客服 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">隐私和版权 </a></li>
				<li><a href="">| </a></li>
				<li><a href=""> </a></li>
				<li><a href="">联系我们 </a></li>
				<li><a href="">加入天涯 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">手机版 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">隐私和版权 </a></li>
			</ul>
		<p>© 1999 - 2018 甄妍论坛</p>
		</div>
		
	</footer>
</body>
</html>