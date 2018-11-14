<!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>取回密码_邮箱取回_天涯社区</title>
	<link rel="stylesheet" type="text/css" href="/home/user/pass/TY.css">
    <link rel="stylesheet" type="text/css" href="/home/user/pass/fp_d771aab.css">
</head>

<body>
	<div id="container">
		<script type="text/javascript">
			var headerType = "fp";
		</script>
		<div class="header clearfix"><div class="logo cf"><a href="#" target="_blank"></a><h1>取回密码</h1></div><div class="meta"><p class="link"><a href="/home/user/register">注册帐号</a> | <a href="/home/user/login">登录</a> | <span>取回密码</span> | <a href="/">返回首页</a></p></div></div>
		<div class="content clearfix">
			<div class="headline">
				<h2>邮箱取回</h2>
			</div>
			<div class="form-wrapper">
				<form id="form" name="form" action="/ps?action=email" method="post">
					<div class="form-item">
						<label class="form-label" for="email">已绑定邮箱</label>
						<div class="form-field">
							<input type="email" class="form-text" name="email" id="email">
							<span id="email_tips" class="form-tips tips-des"></span>
						</div>
					</div>
					<div class="form-item">
	                	<label class="form-label" for="mobileVcode">校验码</label>
						<div class="form-field">
							<div class="mobile-vcode-text">
								<input type="text" class="form-text" name="mobileVcode" id="mobileVcode">
								<a id="get_mobile_vcode" class="get-mobile-vcode" href="#" onclick="sendmobilecode()">获取邮箱检验码<!-- 重新发送(60) --></a>
							</div>
							<span id="mobileVcode_tips" class="form-tips tips-des">请填写邮箱校验码。</span>
						</div>
					</div>
                    <div class="form-action">
                    	<button type="button" id="email_btn" class="email-btn btn btn-blue">下一步</button>
                    </div>
				</form>
			</div>
		</div>
		<div class="footer"><p><a target="_blank" href="#">关于臻妍</a> | <a target="_blank" href="#">广告服务</a> | <a target="_blank" href="http://service.tianya.cn/">臻妍客服</a> | <a target="_blank" href="http://help.tianya.cn/about/ystl.html">隐私和版权</a> | <a target="_blank" href="http://help.tianya.cn/about/contact.html">联系我们</a> | <a target="_blank" href="http://join.tianya.cn/">加入臻妍</a> | <a target="_blank" href="http://www.tianya.cn/mobile/">手机版</a> | <a target="_blank" href="http://service.tianya.cn/alarm/jbts.do">举报投诉</a></p><p>© 1999 - 2018 臻妍社区</p></div>
	</div>
	
	<script type="text/javascript" charset="utf-8" src="/home/user/pass/TY.js"></script>
    <script type="text/javascript" charset="utf-8" src="/home/user/pass/fp_9be0c51.js"></script>
    <script src="/home/layui/layui.all.js"></script>
	<script type="text/javascript">
		var FpType = "email";
		
	</script>
	<script type="text/javascript">
        function sendmobilecode()
        {
            var phone_vals=$('input[name=email]').val();
            $.get('/home/userndmobilecode',{'email':phone_vals},function(msg){
                if(msg.SubmitResult.code == 2){
                    alert('验证码发送成功');
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


</body></html>