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
							<li><a href="/home/index/show/{{ $v['id'] }}">{{ $v['title'] }}</a></li>
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
</body>
</html>
@endsection