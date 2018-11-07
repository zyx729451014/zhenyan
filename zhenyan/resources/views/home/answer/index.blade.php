@extends('home/layout/layout')
@section('content-wrapper')
<script src="/home/js/jquery-2.1.4.min.js"></script>
	<script src="/home/js/nprogress.js"></script>
	<script src="/home/js/jquery.lazyload.min.js"></script>
	<style type="text/css">
		.title ul{width: 600px;height: 40px;margin-left: 150px;}
		.title ul li{float:left;width:80px;height:30px;border:1px solid #d8dadb;margin-left:5px;text-align: center;}	
		.title ul li a{line-height:30px;color:#809195;text-decoration: none;}	
		.title ul li a:hover{color: #168da6;}		
	</style>
<section class="container">
		<div class="content-wrap">
			<div class="content">
				<div class="title">
					<h3 style="line-height: 1.3"></h3>
					<br>
					
					<ul>
						
						<li><a href="/home/answer/create">发帖</a></li>
					</ul>
  				</div>
  				@foreach($answer as $k => $v)
  				<article class="excerpt" style="margin-top:20px;">
				 		<h2><a href="/home/answer/{{ $v->id }}" title="用DTcms做一个独立博客网站（响应式模板）">{{ $v->title }}</a></h2>
					<p class="meta">
						<br>
						<time class="time"><i class="glyphicon glyphicon-time"></i>{{ $v->created_at }}</time>
						<span class="views"><i class="glyphicon glyphicon-eye-open"></i> 217</span> <a class="comment" href="#comment" title="评论" target="_blank" ><i class="glyphicon glyphicon-comment"></i></a></p>
					<a class="note1" style='color:#000;text-decoration:none;'>{!! $v->content !!}</a>
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
				<form class="navbar-form" action="/home/answer" method="get">
				  <div class="input-group">
					<input type="text" name="search" class="form-control" value="{{ $request['search'] or '' }}" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
					<span class="input-group-btn">
						<button class="btn btn-default btn-search" type="submit">搜索</button>
					</span> 
				</div>
				</form>
		  	</div>	  
			<!-- 最新发布 -->
			<div class="widget widget_hot">
			  <h3>最新发布</h3>
			  	@foreach($answer2 as $kk => $vv)
			  	<ul style="margin-left:20px;height:auto;margin-top:10px;">
			  		<a href="/home/answer/{{ $vv['id'] }}" style="color:#809195;text-decoration: none;"><li style="height:auto;"></span><span class="text"></span>{{ $vv['title'] }}<span class="muted"></li></a>		
					</span><span class="muted">{{ $vv['created_at'] }}<i class="glyphicon glyphicon-eye-open"></i>
					<?php $user = \App\Models\User::find($vv['uid']);                
                       ?>
                     {{ $user['uname'] }}
					</span></a></li>
				</ul>	
			 	@endforeach
		  	</div>
		</aside>
	</section>
		<script src="/home/js/bootstrap.min.js"></script>
		<script src="/home/js/jquery.ias.js"></script>
		<script src="/home/js/scripts.js"></script>
@endsection
