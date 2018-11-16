<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>臻妍论坛-获取验证码</title>
	<style type="text/css">
		*{margin: 0px;padding: 0px;}
		.content{width: 500px;height: 400px;margin: 0px auto;border: 1px solid #ccc;}
		.content .top{height: 100px;background-color: #18bd9b;color: #fff;line-height: 100px;text-align: center;}
		.content div{display: block;width: 360px;margin: 50px auto;}
	</style>
</head>
<body>
	<div class="content">
		<h3 class="top">臻妍论坛-获取验证码</h3>
		<div>您好！您成功获取了验证码。账号为{{ $email }}
		<br><br>请点击<a href="http://www.zhenyan.com/home/user/activation"></a>您的验证码为：{{ $str_rand }}
		<p>请不要泄露给其他人</p>
	</div>
		
	</div>
</body>
</html>