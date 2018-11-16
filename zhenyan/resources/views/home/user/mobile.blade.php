<!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>取回密码_手机取回</title>
	<link rel="stylesheet" type="text/css" href="/home/user/pass/TY.css">
    <link rel="stylesheet" type="text/css" href="/home/user/pass/fp_d771aab.css">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all">
	<script type="text/javascript" charset="utf-8" src="/home/user/pass/json.html"></script>
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="/home/layui/layui.all.js"></script>


</head>
 
<body>
	<div id="container">
		<script type="text/javascript">
			var headerType = "fp";
		</script>
		<div class="header clearfix"><div class="logo cf"><a href="#" target="_blank"></a><h1>取回密码</h1></div><div class="meta"><p class="link"><a href="/home/user/register">注册帐号</a> | <a href="/home/user/login">登录</a> | <span>取回密码</span> | <a href="/">返回首页</a></p></div></div>
		<div class="content clearfix">
			<div class="headline">
				<h2>认证手机取回</h2>
			</div>
                <form action="/home/user/checkmobilecode" method="post">
                	{{ csrf_field() }}
				<div class="form-wrapper">
				<div class="form-title">请输入认证手机号码</div>
                    <div class="form-item">
						<label class="form-label" for="mobile">手机号码</label>
						<div class="form-field">
							<div class="mobile-text">
								<span class="area-code">+86</span>
								<input type="text" class="form-text" name="phone" id="mobile">
							</div>
							<span id="mobile_tips" class="form-tips tips-des">请填写手机号。</span>
		 				</div>
					</div>
					<div id="mobile_vcode_item" class="form-item" style="display: block;">
						<label class="form-label" for="mobileVcode">校验码</label>
						<div class="form-field">
							<div class="mobile-vcode-text">
								<input type="text" class="form-text" name="phonecode" id="phone_code">
								<a id="get_mobile_vcode" onclick='sendmobilecode()' class="get-mobile-vcode" href="javascript:void(0);">获取手机校验码<!-- 重新发送(60) --></a>
							</div>
							<span id="mobileVcode_tips" class="form-tips tips-des">请填写手机校验码。</span>
						</div>
					</div>
                    <div class="form-action">
                    		<button type="submit" id="mobile_btn" class="mobile-btn btn btn-blue" style="border:none;">确认</button>
                    </div>
				</div>
			</form>
		</div>
		<div class="footer"><p><a target="_blank" href="#">关于臻妍</a> | <a target="_blank" href="#">广告服务</a> | <a target="_blank" href="http://service.tianya.cn/">臻妍客服</a> | <a target="_blank" href="http://help.tianya.cn/about/ystl.html">隐私和版权</a> | <a target="_blank" href="http://help.tianya.cn/about/contact.html">联系我们</a> | <a target="_blank" href="http://join.tianya.cn/">加入臻妍</a> | <a target="_blank" href="http://www.tianya.cn/mobile/">手机版</a> | <a target="_blank" href="http://service.tianya.cn/alarm/jbts.do">举报投诉</a></p><p>© 1999 - 2018 臻妍社区</p></div>
	</div>
	<script type="text/javascript">
		var FpType = "phone";
		
	</script>
	<script type="text/javascript">
		$('input[name=phone]').blur(function(){
				var phone_vals = $(this).val();
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});
					$.ajax({
						url:'/home/user/checkphone',
						type:'post',
						data:{'phone':phone_vals},
						success:function(msg){
							if(msg == 'success'){
								$('#mobile_tips').html('<font color="#CBCBCB">手机号不存在</font>');
							}else{
								$('#mobile_tips').html('') ;
							}
						},
						dataType:'html',
				 		async:false
					});
			});

	</script>
	<script type="text/javascript">
        function sendmobilecode()
        {
            var phone_vals=$('input[name=phone]').val();
            $.get('/home/user/sendmobilecode',{'phone':phone_vals},function(msg){
                if(msg.SubmitResult.code == 2){
                    layer.alert('验证码发送成功');
                     var i=60;
                    time=setInterval(function(){
                        $('.code').attr('disabled',true);
                        $('.code').html('发送成功('+i+'秒)');
                        i--;
                        if (i==0) {
                            clearInterval(time);
                            $('.code').attr('disabled',false);
                            $('.code').html('获取验证码');
                        };
                    },1000);
                }else{
                    alert(msg.SubmitResult.msg);
                } 
            },'json');

           
        }
    </script>
             <!-- 读取提示信息开始 -->
    @if (session('success'))
        <script type="text/javascript">
            var layer = layui.layer
                 ,form = layui.form;

            layer.alert("{{ session('success') }}");           
        </script>;
    @endif
    @if (session('error'))
      <script type="text/javascript">
      var layer = layui.layer
         ,form = layui.form;
            layer.alert("{{ session('error') }}");         
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
                    layer.alert('{{ $v }}')
                }                   
            </script>;
        @endforeach
       </ul>
    </div>
    @endif
    <!-- 显示验证错误信息 结束 -->
</body></html>