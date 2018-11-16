<!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>取回密码_手机取回</title>
	<link rel="stylesheet" type="text/css" href="/home/user/pass/TY.css">
    <link rel="stylesheet" type="text/css" href="/home/user/pass/fp_d771aab.css">
	<script type="text/javascript" charset="utf-8" src="/home/user/pass/json.html"></script>
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="/layui/css/layui.css" media="all">
    <script src="/layui/layui.all.js"></script>
	
</head>
 
<body>
	<div id="container">
		<script type="text/javascript">
			var headerType = "fp";
		</script>
		<div class="header clearfix"><div class="logo cf"><a href="#" target="_blank"></a><h1>取回密码</h1></div><div class="meta"><p class="link"><a href="/home/user/register">注册帐号</a> | <a href="/home/user/login">登录</a> | <span>取回密码</span> | <a href="/">返回首页</a></p></div></div>
		<div class="content clearfix">
			<div class="headline">
				<h2>通过手机号修改密码</h2>
			</div>
			<form action="/home/user/updatephone2" method='post'>
				{{ csrf_field() }}
				<div class="form-wrapper">
	                    <div class="form-item">
							<label class="form-label" for="mobile">手机号码</label>
							<div class="form-field">
								<div class="mobile-text">
									<span class="area-code">+86</span>
									<input type="text" class="form-text" placeholder="请输入手机号" name="phone" id="phone" value="{{ session('phone') }}">
									<input type="hidden" name="countryCode" id="area_code" value="">
								</div>
								
			 				</div>
						</div>
						<div class="form-item">
							<label class="form-label" for="mobile">新密码</label>
							<div class="form-field">
								<div class="mobile-text" id="password_tips">
									<input type="password" name="upass" placeholder="请输入新密码"  style='width:275px;height:35px;border:1px solid #ddd;font-size:16px;' id="upass">
									<span><font color="#CBCBCB">请输入6-16位的密码</font></span>
								</div>
	                            <div class="col-sm-10">
	                                 <span style='color:#333;'></span>
	                            </div>
			 				</div>
						</div>
						<div class="form-item">
							<label class="form-label" for="mobile">确认密码</label>
							<div class="form-field">
								<div class="mobile-text" id="password2_tips">
									<input type="password" name="upassok"   style='width:275px;height:35px;border:1px solid #ddd;font-size:16px;' placeholder="请再次输入密码" id="upassok">
									<span></span>
								</div>
								
			 				</div>
						</div>
	                    <div class="form-action">
	                    	<button type="submit" id="mobile_btn" class="mobile-btn btn btn-blue">确认</button>
	                    </div>
				</div>
			</form>
		</div>
		<div class="footer"><p><a target="_blank" href="#">关于臻妍</a> | <a target="_blank" href="#">广告服务</a> | <a target="_blank" href="http://service.tianya.cn/">臻妍客服</a> | <a target="_blank" href="http://help.tianya.cn/about/ystl.html">隐私和版权</a> | <a target="_blank" href="http://help.tianya.cn/about/contact.html">联系我们</a> | <a target="_blank" href="http://join.tianya.cn/">加入臻妍</a> | <a target="_blank" href="http://www.tianya.cn/mobile/">手机版</a> | <a target="_blank" href="http://service.tianya.cn/alarm/jbts.do">举报投诉</a></p><p>© 1999 - 2018 臻妍社区</p></div>
	</div>
	 <script type="text/javascript">
 	$('input[name=upass]').focus(function()
	{	
		$('#password_tips span:eq(1)').html('<font color="#CBCBCB">请输入6-16位的密码</font>');
	});
    $('input[name=upass]').keyup(function(){
        var pass_vals = $(this).val();
        if(pass_vals.length < 6){
            $('#password_tips  span').html( '<font color="#CBCBCB">请输入6-16位的密码</font>');

            return;
        }
        if(pass_vals.length > 16){
            $('#password_tips  span').html( '✖ 密码长度为6-16位');
            return;
        }else{
            $('#password_tips  span').html( '');

        }
    });
     $('input[name=upassok]').keyup(function(){
        var passok_vals = $(this).val();
        if (passok_vals==$('input[name=upass]').val()) {
            $('#password2_tips span').html('<font color="green">两次密码输入一致</font>');
        }else{
            $('#password2_tips span').html('<font color="red">两次密码输入不一致</font>');
        };
    });
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
</body>
</html>