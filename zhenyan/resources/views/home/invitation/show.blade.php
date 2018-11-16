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
	<div class="content" style="margin-top:90px;">
		<div class="title">{{ $invitation->title }}</div>
		<div class="name"><span>Posted by </span>|<a href="/home/user/usercenters/$invitation->invitationuser->uid">{{ $invitation->invitationuser->uname }}</a></div>
		<div id="cont">
				{!! $invitation->content !!}	
		</div>
		<?php
			if(session()->has('user')){
	            $collect = App\Models\Invi_collect::where('uid',session('user')->uid)->where('iid',$invitation->id)->first();
	        }
        ?>
			@if(isset($collect))
                @if(count($collect) != 1)
				<form action="/home/Invi_collect" method="post" style="float:right;">
					{{ csrf_field() }}	
					<button type="submit" class="btn btn-gradient-primary" name="collect" value="{{ $invitation->id }}">收藏</button>
				</form>
                @else
                <form method="post" action="/home/Invi_collect/{{ $collect->id }}" style="float:right;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-gradient-primary">取消收藏</button>
                </form>
                @endif
            @else
            	@if(!session()->has('user'))
					<button style="float:right;" type="submit" class="btn btn-gradient-primary" name="collect" value="{{ $invitation->id }}" onclick="collects()">收藏</button>
                <?php  
                    $uri=\Request::getRequestUri();
                    session(['home_uri'=>$uri]);
                ?>
                <script type="text/javascript">
	                function collects()
	                {
	                  	layer.alert('您还未登录 请先去登录', {icon: 2,time: 5000},function(){ location.href='/home/user/login'; }); 
                        return false;
	                }
                </script>   
                @else
                    @if(count($collect) != 1)
	                   	<form action="/home/Invi_collect" method="post" style="float:right;">
						{{ csrf_field() }}	
						<button type="submit" class="btn btn-gradient-primary" name="collect" value="{{ $invitation->id }}">收藏</button>
					</form>
                    @else
                  	<form method="post" action="/home/Invi_collect/{{ $collect->id }}" style="float:right;">
	                    {{ csrf_field() }}
	                    {{ method_field('DELETE') }}
	                    <button type="submit" class="btn btn-gradient-primary">取消收藏</button>
                	</form>
                    @endif
                @endif

            @endif
		<p>总楼层 <?= count($invi_comments)?> | 发表时间 {{ $invitation->created_at }} </p>
			@foreach($invi_comments as $k=>$v)
			<ol class="comment">

				<li>

					<div style="height:10px;">
						<p style="float:right;">{{ $k+1 }}楼</p>
					</div>
					
					<cite>
						<a href="/home/user/usercenters/{{ $v->invi_commentuser->uid }}"><img alt="" src="{{ $v->invi_commentuser->userinfo->face }}" height="70" width="70" /></a>			
						<a href="/home/user/usercenters/{{ $v->invi_commentuser->uid }}">{{ $v->invi_commentuser->uname }}</a> 
						<span>{{ $v['content'] }}</span>
						<br />				
						<a href="#comment-63">{{ $v['created_at'] }}</a><br>
					</cite>
						
					<div style="width:100%;height:10px;">
						<a href="#hf" style="float:right" class="hf">回复</a>
					</div>
					<div class="huifu">
						<?php
							$invi_replys = App\Models\Invi_reply::where('cid','=',$v['id'])->get();
						?>
						<ul>
							@foreach($invi_replys as $kk=>$vv)
							<li>
								<a href="/home/user/usercenters/{{ $vv->invi_replyuser->uid }}"><img src="{{ $vv->invi_replyuser->userinfo->face }}" height="20" width="20"></a>
								<a href="/home/information/{{ $vv->invi_replyuser->uid }}">{{ $vv->invi_replyuser->uname }}</a>:<span>{{ $vv['content'] }}</span>
							</li>

							@endforeach
							<li>
								<form action="/home/Invi_reply" method="post" class="fbpl fbpl1" style="width:750px;height:150px;" hidden>	
									{{ csrf_field() }}	
									<label for="message"></label><br />
									<input type="hidden" name="iid" value="{{ $invitation['id'] }}">
									<input type="hidden" name="cid" value="{{ $v['id'] }}">
									@if(session()->has('user'))
									<textarea id="message" name="content" rows="3" cols="30" tabindex="4" style="width:90%;margin-left:5%;"  placeholder="@ {{ $v->invi_commentuser->uname }}　{{ $v['created_at'] }}"></textarea>	
									@else
									<?php  
										$uri=\Request::getRequestUri();
										session(['home_uri'=>$uri]);
									?>
									<div style="width:90%;margin-left:5%;height:70px;border:1px solid #ccc;background:#fff;text-align:center;line-height:70px;">
										<a href="/home/user/login">登录</a>后才可以回复哟~
									</div>
									@endif
									<input class="button" type="submit" value="回复" tabindex="5" style="background-color:#1e96b0;color:#fff;width:100px;margin-left:300px;height:40px;margin-top:10px;border:none;border-radius:10px;" />         		
								</form>	
							</li>
						</ul>
					</div>
				</li>
			</ol>
			
			@endforeach


			<h3>发表评论</h3>				
			
			<form action="/home/Invi_comment" method="post" class="fbpl">	
			{{ csrf_field() }}	
					<label for="message"></label><br />
					<input type="hidden" name="iid" value="{{ $invitation['id'] }}">
					@if(session()->has('user'))
					<textarea id="message" name="content" rows="10" cols="30" tabindex="4" style="width:90%;margin-left:5%;"></textarea>	
					@else
					<div style="width:90%;margin-left:5%;height:200px;border:1px solid #ccc;background:#fff;text-align:center;line-height:200px;">
						<a href="/home/user/login">登录</a>后才可以评论哟~
					</div>
					@endif
					<input class="button" type="submit" value="发表" tabindex="5" style="background-color:#1e96b0;color:#fff;width:100px;margin-left:400px;height:40px;margin-top:10px;border:none;border-radius:10px;" />         		
			</form>
	</div>
</body>
</html>
<script type="text/javascript">
	$('.hf').click(function(){
		$(this).parent().next().find('form').slideToggle();
	});

</script>
	<!-- 读取提示信息开始 -->
  	@if (session('success'))
      	<script type="text/javascript">
      		var layer = layui.layer
				 ,form = layui.form;

	      	layer.msg("{{ session('success')}}");        	
	    </script>;
  	@endif
  	@if (session('error'))
      <script type="text/javascript">
      var layer = layui.layer
		 ,form = layui.form;
	      	layer.msg("{{ session('error')}}");        	
	    </script>;
  	@endif
	<!-- 读取提示信息结束 -->

	<!-- 显示验证错误信息 开始 -->
    @if (count($errors) > 0)
    <div class="">
        <ul> 
        @foreach ($errors->all() as $k=>$v)
	        <script type="text/javascript">
	        var layer = layui.layer
				,form = layui.form;
	        	if('{{ $k }}' == 0){
	        		layer.msg('{{ $v }}')
	        	}		        	
	        </script>;
     	@endforeach
       </ul>
    </div>
    @endif
	<!-- 显示验证错误信息 结束 -->
@endsection