@extends('home/layout/layout')
@section('content-wrapper')
	<script src="/home/js/jquery-2.1.4.min.js"></script>
	<script src="/home/js/nprogress.js"></script>
	<script src="/home/js/jquery.lazyload.min.js"></script>
<section class="container">
		<div class="content-wrap">
			<div class="content">
				<div class="title">
					<h3 style="line-height: 1.3">{{ $cate['cname'] }}</h3>
					<br>
					<ul style="width:600px;height:40px;margin-left:150px;">
						@foreach($cates as $k=>$v)
						<li style="float:left;width:80px;height:30px;border:1px solid #d8dadb;margin-left:5px;text-align: center;"><a href="#"style="line-height:30px;color:#809195">{{ $v['cname'] }}</a></li>
						@endforeach		
					</ul>
  				</div>
				<article class="excerpt" style="margin-top:20px;">
						<a class="cat" href="#" title="MZ-NetBlog主题" >置顶<i></i></a>
						<h2><a href="#" title="用DTcms做一个独立博客网站（响应式模板）" target="_blank" >标题</a></h2>
					<p class="meta">
						<br>
						<time class="time"><i class="glyphicon glyphicon-time"></i> 2016-10-14</time>
						<span class="views"><i class="glyphicon glyphicon-eye-open"></i> 217</span> <a class="comment" href="##comment" title="评论" target="_blank" ><i class="glyphicon glyphicon-comment"></i> 4</a></p>
					<a class="note1">内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容</a>
				</article> 				
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
				<form class="navbar-form" action="/Search" method="post">
				  <div class="input-group">
					<input type="text" name="keyword" class="form-control" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
					<span class="input-group-btn">
					<button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
					</span> </div>
				</form>
		  	</div>	  
			<!-- 最新发布 -->
			<div class="widget widget_hot">
			  <h3>最新发布</h3>
			  	<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"></span><span class="text">标题</span><span class="muted"></li>		
					</span><span class="muted">2016-11-01&nbsp<i class="glyphicon glyphicon-eye-open"></i>用户名</span></a></li>
				</ul>
				<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"></span><span class="text">标题</span><span class="muted"></li>		
					</span><span class="muted">2016-11-01&nbsp<i class="glyphicon glyphicon-eye-open"></i>用户名</span></a></li>
				</ul>
				<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"></span><span class="text">标题</span><span class="muted"></li>		
					</span><span class="muted">2016-11-01&nbsp<i class="glyphicon glyphicon-eye-open"></i>用户名</span></a></li>
				</ul>
				<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"></span><span class="text">标题</span><span class="muted"></li>		
					</span><span class="muted">2016-11-01&nbsp<i class="glyphicon glyphicon-eye-open"></i>用户名</span></a></li>
				</ul>
				<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"></span><span class="text">标题</span><span class="muted"></li>		
					</span><span class="muted">2016-11-01&nbsp<i class="glyphicon glyphicon-eye-open"></i>用户名</span></a></li>
				</ul>
				<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"></span><span class="text">标题</span><span class="muted"></li>		
					</span><span class="muted">2016-11-01&nbsp<i class="glyphicon glyphicon-eye-open"></i>用户名</span></a></li>
				</ul>
				<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"></span><span class="text">标题</span><span class="muted"></li>		
					</span><span class="muted">2016-11-01&nbsp<i class="glyphicon glyphicon-eye-open"></i>用户名</span></a></li>
				</ul>
				<ul style="margin-left:20px;height:60px;margin-top:10px;">
			  		<li style="height:30px;"></span><span class="text">标题</span><span class="muted"></li>		
					</span><span class="muted">2016-11-01&nbsp<i class="glyphicon glyphicon-eye-open"></i>用户名</span></a></li>
				</ul>
		  	</div>
		</aside>
	</section>
		<script src="/home/js/bootstrap.min.js"></script>
		<script src="/home/js/jquery.ias.js"></script>
		<script src="/home/js/scripts.js"></script>
@endsection