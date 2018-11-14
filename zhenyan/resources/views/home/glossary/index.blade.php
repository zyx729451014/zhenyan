@extends('home/layout/layout')
@section('content-wrapper')
	<script src="/home/js/jquery-2.1.4.min.js"></script>
	<script src="/home/js/nprogress.js"></script>
	<script src="/home/js/jquery.lazyload.min.js"></script>

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
					<h3 style="line-height: 1.3">图集</h3>
					<br>
					<ul style="width:600px;height:40px;margin-left:150px;">
						@if(!session()->has('user'))
							<li style="float:left;width:80px;height:30px;border:1px solid #d8dadb;margin-left:450px;text-align: center;"><a href="#" style="line-height:30px;color:#809195" onclick="create()">发表</a></li>
						@else
							<li style="float:left;width:80px;height:30px;border:1px solid #d8dadb;margin-left:450px;text-align: center;"><a href="/home/glossary/create" style="line-height:30px;color:#809195">发表</a></li>
						@endif
						
						 <?php  
		                    $uri=\Request::getRequestUri();
		                    session(['home_uri'=>$uri]);
		                ?>
		                <script type="text/javascript">
			                function create()
			                {
			                  	layer.alert('您还未登录 请先去登录', {icon: 2,time: 5000},function(){ location.href='/home/user/login'; }); 
		                        return false;
			                }
		                </script> 
					</ul>
  				</div>
  				@foreach ($glossary as $k=>$v)
				<article class="excerpt" style="margin-top:20px;height:400px;">
						<h2><a href="/home/glossary/{{ $v->id }}" target="_blank" >{{ $v->title }}</a></h2>
					<p class="meta">
						<br>
						<?php
							// 评论条数
							$comment = \App\Models\Glocomment::where('gid',$v['id'])->get();
							$sum = count($comment);
						?>
						<time class="time"><i class="glyphicon glyphicon-time"></i> {{ $v->created_at }}</time>
						<span class="views"><i class="glyphicon glyphicon-eye-open"></i> 217</span> <a class="comment" href="##comment" title="评论" target="_blank" ><i class="glyphicon glyphicon-comment"></i> {{ $sum }}</a></p>
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
				<ul style="margin-left:20px;height:auto;margin-top:10px;">
			  		<a href="/home/glossary/{{ $v->id }}" style="color:#809195;text-decoration: none;">
			  		<li style="height:auto;">
			  		</span>
			  		<span class="text">{{ $v->title }}</span><span class="muted"></li></a>		
					</span><span class="muted">{{ $v->created_at }}&nbsp<i class="glyphicon glyphicon-eye-open"></i>
					{{ $v->glossaryuser->uname }}
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