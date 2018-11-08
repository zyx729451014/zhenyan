@extends('home/layout/layout')
@section('content-wrapper')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Document</title>
	<style type="text/css">
		.content{width: 980px;height:auto;margin: 0px auto;margin-top: 150px;}
		.header{width: 890px;height: 60px;background-color: #babcbc;margin: 0px auto;opacity: 0.6;}
		.header>img{width: 120px;height: 120px;margin-top: -70px;margin-left: 30px;}
		.header>a{line-height: 60px;display: inline-block;width: 150px;text-align: center;text-decoration: none;}
		.header>span{line-height: 60px;display: inline-block;width: 420px;}
		.header>.cot{line-height: 60px;display:block;width: 100px;float: right;}
		.bottom{height: auto;margin-top: 50px;}
		.bottom ul{height: 60px;border-bottom: 1px solid #ccc;width: 850px;margin: 0px auto;}
		.bottom ul li:first-child{width: 850px;line-height: 30px;font-size: 13px;}
		.bottom ul li:first-child span{margin-left: 50px;}
		.bottom ul li button{width: 70px;height: 35px;float: right;margin-top: -35px;border: none;}
    	.bottom ul li a{width:800px;text-decoration: none;font-size: 14px;display: inline-block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    	#private{width: 500px;height: 150px;background-color:#f2fafc;position: absolute;top: 100px;left:200px;display: none;}
    	#private>span{width: 30px;font-size: 20px;display: block;float: right;}
    	#x a{text-decoration: none;}
    	#private>div{width: 450px;height: 100px;margin-top: 30px;margin-left: 20px;background-color: #fff;overflow: scroll;}
	</style>
</head>
<body>
	<div class="content">
		<div class="header">
			<img src="{{ $user->userinfo->face }}">
			<a href="">用户名:{{ $user->uname }}</a>
			<span>最近登录时间 : {{ $user->updated_at }}</span>
			<a href="/home/user/logout" class="out">退出</a>
		</div>
			

			
			<div class="bottom">
				@foreach($private as $k=>$v)
				<form action="/home/private/{{ $v->id }}" method="post">
					{{ csrf_field() }}
            		{{ method_field('DELETE') }}
				<ul>
					<li><input type="checkbox" name="" value="{{ $v->id }}">私信人:{{ $v->privateuser->uname }}<span>私信时间:{{ $v->created_at }}</span></li>
					<li><a href="#" class="pri">私信内容:{{ $v->content }}</a>
						<button style="submit">删除</button>
					</li>
				</ul>
				</form>
				<div id="private">
					<span id="x"><a href="#">X</a></span>
					<div>{{ $v->content }}</div>
				</div>
		
				@endforeach
			</div>
			@if(!$private->isEmpty())
			<div class="buttons">
				<a href="javascript:;" style="width: 70px;height: 35px;border: none;background:#07aacd;display: inline-block;text-align:center;line-height:35px;color:#fff;margin-left:50px;">删除选中</a>
			</div>
			@else
			<div style="width: 980px;text-align:center;font-size:18px;">
				还没有人给你发私信哟~
			</div>
			@endif
			<ul class="pagination">
				{!! $private->render() !!}
  			</ul>
		
		</div>
	<script type="text/javascript">
		$('.pri').click(function(){
			$('#private').css('display','block');
		});
		$('#x').click(function(){
	        $('#index').show()
			$('#private').hide();
		});
			$('.buttons a').eq(0).click(function(){
				var sel = $('input[type=checkbox]:checked');
				if(sel.length <= 0){
					return;
				}
				var ids = [];
				// 获取被选中元素的id
				$.each(sel,function(){
					var id = $(this).val();
					// 压入数组中
					ids.push(id);
				});
				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
				});
				// 执行删除
				$.post('/home/private/delall',{'ids':ids},function(msg){
					if(msg == 'success'){
						//删除选中的元素
						$('input[type=checkbox]:checked').parent().parent().remove();
					}else{
						alert('删除失败');
					}
				},'html');
				
			});

	</script>
</body>
</html>

@endsection