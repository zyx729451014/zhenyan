<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>臻妍论坛登录</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/login.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>


        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>臻妍</strong> Login </h1>
                            <div class="description">
                            	<p>
                                    This is the login page of the Zhen Yan forum. You are welcome to come back.
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-6 book">
                    		<img src="assets/img/ebook-login.png" alt="">
                    	</div>
                        <div class="col-sm-5 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>登录</h3>
                            		<p>Fill in the form below to get instant access:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="/home/user/dologin" method="post" class="registration-form">
                                    {{ csrf_field() }}
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-first-name">用户名</label>
			                        	<input type="text" name="uname" placeholder="请输入用户名/手机号/邮箱" class="form-first-name form-control" id="form-first-name">
			                        </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-first-name">密码</label>
                                        <input type="password" name="upass" placeholder="请输入密码" class="form-first-name form-control" id="form-first-name">
                                    </div>
			                        <button type="submit" class="btn">登 录</button>
			                    </form>
                                <h5 style="float:right;">还没有账号?赶快去<a href="/home/user/register">注册</a>吧!</h5>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script>
                /*
                    Fullscreen background
                */    
                $.backstretch("assets/img/backgrounds/1.jpg");
                
                $('#top-navbar-1').on('shown.bs.collapse', function(){
                    $.backstretch("resize");
                });
                $('#top-navbar-1').on('hidden.bs.collapse', function(){
                    $.backstretch("resize");
                });
                
                /*
                    Form validation
                */
                $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
                    $(this).removeClass('input-error');
                });
                
                $('.registration-form').on('submit', function(e) {
                    
                    $(this).find('input[type="text"], textarea').each(function(){
                        if( $(this).val() == "" ) {
                            e.preventDefault();
                            $(this).addClass('input-error');
                        }
                        else {
                            $(this).removeClass('input-error');
                        }
                    });
                    
                });

        </script>
        <script src="assets/js/login.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
    </body>

</html>
