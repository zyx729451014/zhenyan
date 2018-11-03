@extends('home/layout/layout')
@section('content-wrapper')
	<script src="/home/js/jquery-2.1.4.min.js"></script>
	<script src="/home/js/nprogress.js"></script>
	<script src="/home/js/jquery.lazyload.min.js"></script>
<section class="container">
		<div class="content-wrap">
			<div class="content">
				<div class="title">
					<h3 style="line-height: 1.3">图集</h3>
					<br>
					<ul style="width:600px;height:40px;margin-left:150px;">
						<li style="float:left;width:80px;height:30px;border:1px solid #d8dadb;margin-left:450px;text-align: center;"><a href="/home/glossary/create" style="line-height:30px;color:#809195">发表</a></li>
					</ul>
  				</div>
  				@foreach ($glossary as $k=>$v)
				<article class="excerpt" style="margin-top:20px;height:400px;">
						<h2><a href="/home/glossary/{{ $v->id }}" target="_blank" >{{ $v->title }}</a></h2>
					<p class="meta">
						<br>
						<time class="time"><i class="glyphicon glyphicon-time"></i> {{ $v->created_at }}</time>
						<span class="views"><i class="glyphicon glyphicon-eye-open"></i> 217</span> <a class="comment" href="##comment" title="评论" target="_blank" ><i class="glyphicon glyphicon-comment"></i> 4</a></p>
						<?php 
							$image = explode('!-!', $v->image);
						?>
						@foreach ($image as $k=>$v)
						<img src="{{ $v }}" style="height:300px;">
						@endforeach
				
				</article> 	
				@endforeach			
			  	<nav class="pagination" style="display: none;">
					<ul>
					  <li class="prev-page"></li>
					  <li class="active"><span>1</span></li>
					  <li><a href="?page=2">2</a></li>
					  <li class="next-page"><a href="?page=2">下一页</a></li>
					  <li><span>共 2 页</span></li>
					</ul>
			 	 </nav>
			</div>
		</div>
		<aside class="sidebar">
			<!-- 搜索 -->
		  	<div class="widget widget_search">
				<form class="navbar-form" action="/home/glossary" method="get">
				  <div class="input-group">
					<input type="text" name="title" class="form-control" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
					<span class="input-group-btn">
					<button class="btn btn-default btn-search" type="submit">搜索</button>
					</span> </div>
				</form>
		  	</div>	  
			<!-- 最新发布 -->
			<div class="widget widget_hot">
			  <h3>最新发布</h3>
			  	@foreach($newglossary as $k=>$v)
			  	<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"><a href="/home/glossary/{{ $v->id }}" style="padding:0px 0px 0px 0px;"><span class="text">{{ $v->title }}</span></a><span class="muted"></li>		
					</span><span class="muted">{{ $v->created_at }}<i class="glyphicon glyphicon-eye-open" style="margin-left:20px;">{{ $v->glossaryuser->uname }}</i></span></a></li>
				</ul>
				@endforeach
		  	</div>
		</aside>
	</section>
		<script src="/home/js/bootstrap.min.js"></script>
		<script src="/home/js/jquery.ias.js"></script>
		<script src="/home/js/scripts.js"></script>
@endsection