<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>臻妍论坛注册</title>
 
        <!-- CSS -->
        <link rel="stylesheet" href="/home/user/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/home/user/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/home/user/assets/css/form-elements.css">
        <link rel="stylesheet" href="/home/user/assets/css/style.css">
        <link rel="stylesheet" href="/home/user/assets/css/register.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/home/user/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/home/user/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/home/user/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/home/user/assets/ico/apple-touch-icon-57-precomposed.png">
        <style type="text/css">
            .reg h3{width: 120px;text-align: center;float: left;margin-left: 30px;cursor: pointer;margin-bottom: 5px;border-bottom: 2px solid rgba(0,0,0,0);}

        </style>
    </head>

    <body>


        <!-- Top content -->
        <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>臻妍</strong> Registration </h1>
                            <div class="description">
                                <p>
                                    This is the registration page of the Zhen Yan forum. You are welcome to join us.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 book">
                            <img src="assets/img/ebook-reg.png" alt="">
                        </div>
                        <div class="col-sm-5 form-box">
                            <div class="form-top">
                                <div class="form-top-left reg">
                                    <h3 class="email" style="border-bottom:2px solid #999;">邮箱注册</h3>

                                    <h3 class="phone">手机注册</h3>
                                    <em>Fill in the form below to get instant access:</em>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </div>
                            <div class="form-bottom" id="email">
                                <form role="form" action="/home/user/doregister" method="post" class="registration-form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="sr-only" for="form-first-name">邮箱</label>
                                        <input type="text" name="email" placeholder="请输入邮箱" class="form-first-name form-control" id="uname">
                                        <div class="col-sm-10">
                                             <span style='color:#333;'></span>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">密码</label>
                                        <input type="password" name="upass" placeholder="请输入密码" class="form-last-name form-control" id="upass">
                                        <ul>
                                            <li>弱</li>
                                            <li>中</li>
                                            <li>强</li>
                                            <li>特别强</li>
                                        </ul>
                                        <div class="col-sm-10">
                                             <span style='color:#333;'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">确认密码</label>
                                        <input type="password" name="upassok" placeholder="请输入确认密码" class="form-email form-control" id="upassok">
                                    </div>
                                    <div class="col-sm-10">
                                             <span style='color:#333;'></span>
                                        </div>
                                    <button type="submit" class="btn">注  册</button>

                                </form>
                                <h5 style="float:right;">已有账号?点击去<a href="/home/user/login">登录</a>吧!</h5>
                            </div>
                            <div class="form-bottom" id="phone" style="display:none;">
                                <form role="form" action="/home/user/doregister" method="post" class="registration-form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="sr-only" for="form-first-name">手机号</label>
                                        <input type="text" name="phone" placeholder="请输入手机号" class="form-first-name form-control" id="uname">
                                        <div class="col-sm-10">
                                             <span style='color:#333;'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-first-name">验证码</label>
                                        <input type="text" name="phonecode" placeholder="请输入手机验证码" class="form-first-name form-control"  style="float:left;width:255px;">
                                        <button style="width:150px;height:51px;float:left;" onclick="sendmobilecode()" class="code">获取验证码</button> 
                                        <div style="clear:both;"></div>
                                    </div>
                                    <script type="text/javascript">
                                        function sendmobilecode()
                                        {
                                            var phone_vals=$('input[name=phone]').val();
                                            $.get('/home/user/sendmobilecode',{'phone':phone_vals},function(msg){
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
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">密码</label>
                                        <input type="password" name="upass" placeholder="请输入密码" class="form-last-name form-control" id="upass">
                                        <ul>
                                            <li>弱</li>
                                            <li>中</li>
                                            <li>强</li>
                                            <li>特别强</li>
                                        </ul>
                                        <div class="col-sm-10">
                                             <span style='color:#333;'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">确认密码</label>
                                        <input type="password" name="upassok" placeholder="请输入确认密码" class="form-email form-control" id="upassok">
                                    </div>
                                    <div class="col-sm-10">
                                             <span style='color:#333;'></span>
                                        </div>
                                    <button type="submit" class="btn">注  册</button>

                                </form>
                                <h5 style="float:right;">已有账号?点击去<a href="/home/user/login">登录</a>吧!</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Javascript -->
        <script src="/home/user/assets/js/jquery-1.11.1.min.js"></script>
        <script src="/home/user/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/home/user/assets/js/jquery.backstretch.min.js"></script>
        <script src="/home/user/assets/js/retina-1.1.0.min.js"></script>
        <script src="/home/user/assets/js/scripts.js"></script>
        <script src='/home/user/assets/js/register.js'></script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
        <script type="text/javascript">
        $('.email').click(function(){
            $('#email').show();
            $('#phone').hide();
            $(this).css('border-bottom','2px solid #999');
            $('.phone').css('border-bottom','');
        });
        $('.phone').click(function(){
            $('#email').hide();
            $('#phone').show();
            $(this).css('border-bottom','2px solid #999');
            $('.email').css('border-bottom','');
        })
        </script>
        
    </body>

</html>