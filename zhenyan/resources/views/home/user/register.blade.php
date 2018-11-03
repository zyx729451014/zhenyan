<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>臻妍论坛注册</title>
 
        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/register.css">

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
                                <div class="form-top-left">
                                    <h3>注册</h3>
                                    <p>Fill in the form below to get instant access:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="/home/user/doregister" method="post" class="registration-form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="sr-only" for="form-first-name">用户名</label>
                                        <input type="text" name="uname" placeholder="请输入用户名" class="form-first-name form-control" id="uname">
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
        <script src="assets/js/scripts.js"></script>
        <script src='assets/js/register.js'></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>