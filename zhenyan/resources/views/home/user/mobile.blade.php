<!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>取回密码_手机取回</title>
	<link rel="stylesheet" type="text/css" href="/home/user/pass/TY.css">
    <link rel="stylesheet" type="text/css" href="/home/user/pass/fp_d771aab.css">
	<script type="text/javascript" charset="utf-8" src="/home/user/pass/json.html"></script>
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
			<div class="form-wrapper">
				<div class="form-title">请输入认证手机号码</div>
                    <div class="form-item">
						<label class="form-label" for="mobile">手机号码</label>
						<div class="form-field">
							<div class="mobile-text">
								<span class="area-code">+86</span>
								<input type="text" class="form-text" name="mobile" id="mobile">
								<input type="hidden" name="countryCode" id="area_code" value="">
							</div>
							<span id="mobile_tips" class="form-tips tips-des">请填写手机号。</span>
						</div>
					</div>
					<div id="mobile_vcode_item" class="form-item" style="display: block;">
						<label class="form-label" for="mobileVcode">校验码</label>
						<div class="form-field">
							<div class="mobile-vcode-text">
								<input type="text" class="form-text" name="mobileVcode" id="mobileVcode">
								<a id="get_mobile_vcode" class="get-mobile-vcode" href="javascript:void(0);">获取手机检验码<!-- 重新发送(60) --></a>
							</div>
							<span id="mobileVcode_tips" class="form-tips tips-des">请填写手机校验码。</span>
						</div>
					</div>
                    <div class="form-action">
                    	<button type="button" id="mobile_btn" class="mobile-btn btn btn-blue">确认</button>
                    	<span class="action-tips">如无法验证，请联系客服 <a>0898-68582666</a></span>
                    </div>
				</form>
			</div>
		</div>
		<div class="footer"><p><a target="_blank" href="#">关于臻妍</a> | <a target="_blank" href="#">广告服务</a> | <a target="_blank" href="http://service.tianya.cn/">臻妍客服</a> | <a target="_blank" href="http://help.tianya.cn/about/ystl.html">隐私和版权</a> | <a target="_blank" href="http://help.tianya.cn/about/contact.html">联系我们</a> | <a target="_blank" href="http://join.tianya.cn/">加入臻妍</a> | <a target="_blank" href="http://www.tianya.cn/mobile/">手机版</a> | <a target="_blank" href="http://service.tianya.cn/alarm/jbts.do">举报投诉</a></p><p>© 1999 - 2018 臻妍社区</p></div>
	</div>
	
	<script type="text/javascript" charset="utf-8" src="/home/user/pass/TY.js"></script>
    <script type="text/javascript" charset="utf-8" src="/home/user/pass/fp_9be0c51.js"></script>
	<script type="text/javascript">
		var FpType = "mobile";
		
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