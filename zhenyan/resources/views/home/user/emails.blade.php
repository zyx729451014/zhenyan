<!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>取回密码_邮箱取回</title>
	<link rel="stylesheet" type="text/css" href="/home/user/pass/TY.css">
    <link rel="stylesheet" type="text/css" href="/home/user/pass/fp_d771aab.css">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <form action="/home/user/checkemailcode" method="post">
                    {{ csrf_field() }}
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
								<input type="text" class="form-text" name="emailcode" id="mobilecode">
								<button  type="button" id="get_mobile_vcode"  class="get-mobile-vcode code" onclick="sendemailcode()">获取邮箱校验码<!-- 重新发送(60) --></button>
							</div>
							<span id="mobileVcode_tips" class="form-tips tips-des">请填写邮箱校验码。</span>
						</div>
					</div>
                    <div class="form-action">
                    	<input type="submit" value="下一步" id="email_btn" class="email-btn btn btn-blue" >
                    </div>
                    </form>
				
			</div>
		</div>
		<div class="footer"><p><a target="_blank" href="#">关于臻妍</a> | <a target="_blank" href="#">广告服务</a> | <a target="_blank" href="http://service.tianya.cn/">臻妍客服</a> | <a target="_blank" href="http://help.tianya.cn/about/ystl.html">隐私和版权</a> | <a target="_blank" href="http://help.tianya.cn/about/contact.html">联系我们</a> | <a target="_blank" href="http://join.tianya.cn/">加入臻妍</a> | <a target="_blank" href="http://www.tianya.cn/mobile/">手机版</a> | <a target="_blank" href="http://service.tianya.cn/alarm/jbts.do">举报投诉</a></p><p>© 1999 - 2018 臻妍社区</p></div>
	</div>
	
	/
    <script type="text/javascript" charset="utf-8" src="/home/user/pass/fp_9be0c51.js"></script>
     <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="/home/layui/layui.all.js"></script>
	<script type="text/javascript">
		var FpType = "email"; 
		
	</script>
	<script type="text/javascript">
        function sendemailcode()
        {
            var email_vals=$('input[name=email]').val();
            $.get('/home/user/sendemailcode',{'email':email_vals},function(msg){
                if (msg=='success') {
                    layer.alert('验证码发送成功');
                     var i=60;
                    time=setInterval(function(){
                        $('.code').html('发送成功('+i+'秒)');
                        $('.code').attr('disabled',true);

                        i--;
                        if (i==0) {
                            clearInterval(time);
                            $('.code').html('获取验证码');
                            $('.code').attr('disabled',false);
                        };
                    },1000);
                }
               
            },'html');

           
        }
    </script>
    <script type="text/javascript">
        $('input[name=email]').blur(function(){
                var email_vals = $(this).val();
                var email_code = $('input[name=emailcode]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'/home/user/checkemail',
                        type:'post',
                        data:{'email':email_vals},
                        success:function(msg){
                            if(msg == 'success'){
                                $('#email_tips').html('<font color="#CBCBCB">邮箱不存在</font>');
                            }else{
                                $('#email_tips').html('') ;
                            }
                        },
                        dataType:'html',
                        async:false
                    });

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