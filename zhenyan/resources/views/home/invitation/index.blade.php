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

<section class="container">
		<div class="content-wrap">
			<div class="content">
				<div class="title">
					<h3 style="line-height: 1.3">{{ $cate['cname'] }}</h3>
					<br>
						<?php
						$cates = \app\Models\Cates::getCates();
					?>
					<ul>
						@foreach($cates as $k=>$v)
							@if($k == $cate['cid']-1)							
								@foreach($v->sub as $kk=>$vv)
									<li><a href="/home/invitation/{{ $vv['cid'] }}">{{ $vv['cname'] }}</a></li>
								@endforeach
							@endif						
						@endforeach	
						<li><a href="/home/invitation/create">发帖</a></li>
					</ul>
  				</div>
  				@foreach($invitation as $k=>$v)
				<article class="excerpt" style="margin-top:20px;">
						@if($v['stick'] == 1)
						<a class="cat" href="#" title="MZ-NetBlog主题" >置顶<i></i></a>
						@endif
				 		<h2><a href="/home/invitation/show/{{ $v['id'] }}" title="用DTcms做一个独立博客网站（响应式模板）" target="_blank" >{{ $v['title'] }}</a></h2>
					<p class="meta">
						<br>
						<?php
							// 评论条数
							$comment = \App\Models\Invi_comment::where('iid',$v['id'])->get();
							$sum = count($comment);
						?>
						<time class="time"><i class="glyphicon glyphicon-time"></i> {{ $v['created_at'] }}</time>
						<span class="views"><i class="glyphicon glyphicon-eye-open"></i> 217</span> <a class="comment" href="##comment" title="评论" target="_blank" ><i class="glyphicon glyphicon-comment">{{ $sum }}</i></a></p>
					<a class="note1">{!!$v['content'] !!}</a>
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
				<form class="navbar-form" action="/home/invitation/{{ $cate['cid'] }}" method="get">
				  <div class="input-group">
					<input type="text" name="search" class="form-control" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
					<span class="input-group-btn">
					<button class="btn btn-default btn-search" type="submit">搜索</button>
					</span> </div>
				</form>
		  	</div>	  
			<!-- 最新发布 -->
			<div class="widget widget_hot">
			  <h3>最新发布</h3>
			  @foreach($invitations as $k=>$v)
			  	<ul style="margin-left:20px;height:auto;margin-top:10px;">
			  		<a href="/home/invitation/show/{{ $v['id'] }}" style="color:#809195;text-decoration: none;"><li style="height:auto;"></span><span class="text">{{ $v['title'] }}</span><span class="muted"></li></a>		
					</span><span class="muted">{{ $v['created_at'] }}&nbsp<i class="glyphicon glyphicon-eye-open"></i>
					<?php $user = \App\Models\User::find($v['uid']);                
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