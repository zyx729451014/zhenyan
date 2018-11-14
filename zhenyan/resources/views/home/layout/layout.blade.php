<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="www.zhenyan.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<?php $web = \App\Models\Web::find(1); ?>
	<title>{{ $web->name }}</title>

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
	<link rel="stylesheet" type="text/css" href="/home/banner/css/banner.css">
	<script src="/home/js/jquery-2.1.4.min.js"></script>
	<script src="/home/js/nprogress.js"></script>
	<script src="/home/js/jquery.lazyload.min.js"></script>
	<script src="/home/banner/js/jquery-1.10.2.min.js"></script>
	<script src="/home/banner/js/slider.js"></script>

	 <link rel="stylesheet" href="/layui/css/layui.css" media="all">
	 <script src="/layui/layui.all.js"></script>
	 <style type="text/css">
		.name{
			width: 300px;
			height: 200px;
			background-color: #fff;
			border: 1px solid #ccc;
			position: fixed;
			top: 250px;
			left: 40%;
			z-index: 9999999999;
		}
		.name input{
			border: 1px solid #ccc;
			width: 200px;
			height: 30px;
			margin-bottom: 10px;

		}
		.name input[type=submit]{
			width: 50px;
			margin-left: 110px;
			margin-top: 10px;
		}
		.name form{
			margin-top: 10px;
			padding: 20px;
		}
	 </style>
</head>
<body>

<!-- 导航 -->
	<header>
	<?php
		$cates = \App\Models\Cates::select()->where('pid','=',0)->get();
		/**
		 * 
		 *cates 类别分类
		 *advers 推荐位广告
		 *slid  轮播图
		 */
		$cates = \App\Models\Cates::getCates();
		$advers  = \App\Models\Adver::select()->where('status','=',1)->get();
		$slids  = \App\Models\Slid::select()->where('status','=',1)->get();
	?>
		<nav style="background:#fff url({{ $web->logo }}) no-repeat -15px;">
			<ul>			
				<li><a href="/">首页</a></li>
				@foreach($cates as $k=>$v)
				<li><a href="/home/invitation/{{ $v['cid'] }}">{{ $v['cname'] }}</a></li>
				@endforeach
				<li><a href="/home/glossary">图集</a></li>
				<li><a href="/home/answer">问答</a></li>
			
			@if (session()->has('user'))
			<button style='height:75px;float: right;line-height: 75px;' class="navbut">欢迎您:{{ session('user')->uname }}</button>
				<div class="person" style="display: none;height:120px;">
					<li><a href="/home/user/userdateail" style='text-decoration:none;color:#333;'>个人中心</a></li>
					<li><a href="/home/private" style='text-decoration:none;color:#333;'>我的私信</a></li>
					<li><a href="/home/user/logout" style='text-decoration:none;color:#333;'>退出</a></li>
				</div>
			@else
			<?php  
				$uri=\Request::getRequestUri();
				session(['home_uri'=>$uri]);
			?>
			<a href="/home/user/register" style='float: right;line-height:75px;'>注册</a>  
			<a href="/home/user/login" style='float: right;line-height:75px;margin-right:10px;'>登录</a>
			
			@endif
		</ul>
		</nav>
	</header>
	<script type="text/javascript">
			$('.navbut').click(function(){
				// 停止正在执行的动画  并且隐藏
				$('.person:animated').stop().hide();
				// 切换滑动效果
				$('.person').slideToggle('slow');
			});
	</script>

<!-- 内容 -->
	@if (session()->has('user') && !session('user')->uname)
		<div class="name">
			<p style="background:#ccc;font-size:20px;padding:5px;">请设置用户名</p>

			<form action="/home/user/changename/{{ session('user')->uid }}" method="post">
				{{ csrf_field() }}
				用户名：<input type="text" name="uname" placeholder="请输入中文英文数字2~6位字符">
				<span></span>
				<p>*用户名设置后不可修改 可作为登录账户</p>
				<input type="submit" value="确认">
			</form>
		</div>
	@endif
	<script type="text/javascript">
		$('input[name=uname]').blur(function(){
			var user_preg =  /^[a-zA-Z0-9_\u4e00-\u9fa5]{2,6}$/; 
			var user_vals = $(this).val();
			if(user_preg.test(user_vals)){
				$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
				});
				$.ajax({
					url:'/home/user/checkname',
					type:'post',
					data:{'uname':user_vals},
					success:function(msg){
						if(msg == 'success'){
						isUname = true;
						$('.name span:eq(0)').html('<font color="#CBCBCB">恭喜用户名可用</font>');
						}else{
						$('.name span:eq(0)').html('<font color="red">用户已经存在</font>') ;
						}
					},
					dataType:'html',
					async:false
				});

			}else{
				$('.name span:eq(0)').html('<font color="red">用户名格式错误</font>');
			}
		});
	</script>
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

			background: transparent url(/home/img/carousel_shine.png) no-repeat 0 0;

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

			background: transparent url(/home/img/carousel_control.png) no-repeat -2px -32px;

			text-decoration: none;

			text-indent: -999px;

			display: inline-block;

			overflow: hidden;

			width: 8px;

			height: 8px;

			margin: 0 5px 0 0;

		}

		#carousel .pager a.selected {

			background: transparent url(/home/img/carousel_control.png) no-repeat -12px -32px;

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
					@foreach($advers as $k=>$v)
					<li style="background:transparent url(/home/img/carousel_polaroid.png) no-repeat 0 0;">
						<img src="{{ $v['apic'] }}" alt="" />
						<span style="background:transparent url(/home/img/carousel_shine.png) no-repeat 0 ">Image1</span></li>					
					@endforeach
				</ul>

			</div>

			<!-- 读取提示信息开始 -->
	  	@if (session('success'))
	      	<script type="text/javascript">
		      	alert("{{ session('success')}}");        	
		    </script>;
	  	@endif
	  	@if (session('error'))
	      <script type="text/javascript">
		      	alert("{{ session('error')}}");        	
		    </script>;
	  	@endif
	<!-- 读取提示信息结束 -->

	<!-- 显示验证错误信息 开始 -->
	    @if (count($errors) > 0)
	    <div class="">
	        <ul> 
	        @foreach ($errors->all() as $k=>$v)
		        <script type="text/javascript">
		        	if('{{ $k }}' == 0){
		        		alert('{{ $v }}')
		        	}		        	
		        </script>;
	     	@endforeach
	       </ul>
	    </div>
	    @endif
	    <!-- 显示验证错误信息 结束 -->
<!-- 尾部 -->
	<footer>
		<div class="footer-top">
			<?php
				$links = \App\Models\Link::where('status',1)->get();
			?>
			<ol>
				<h4>友情链接：</h4>
				@foreach ($links as $k=>$v)
				<li><a href="{{ $v->lurl }}">{{ $v->lname }}</a></li>
				@endforeach
			<ol>
		</div>
		<div class="footer-bottom">
			<ul>
				<li><a href="">关于臻妍 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">广告服务 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">臻妍客服 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">隐私和版权 </a></li>
				<li><a href="">| </a></li>
				<li><a href=""> </a></li>
				<li><a href="">联系我们 </a></li>
				<li><a href="">加入臻妍 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">手机版 </a></li>
				<li><a href="">| </a></li>
				<li><a href="">隐私和版权 </a></li>
			</ul>
		<p>© 1999 - 2018 臻妍论坛</p>
		</div>
		
	</footer>

</body>
</html>
