<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="www.zhenyan.com">
    <?php $web = \App\Models\Web::find(1); ?>
    <title>{{ $web->name }}</title>

        <!-- 首页 -->
        <link rel="stylesheet" type="text/css" href="/home/css/style2.css">
        <link rel="stylesheet" href="/home/css/zerogrid.css">
        <link rel="stylesheet" href="/home/css/style.css">
        <link rel="stylesheet" href="/home/css/responsive.css">
        <link rel="stylesheet" href="/home/css/responsiveslides.css" />
        <link href='/home/images/favicon.ico' rel='icon' type='image/x-icon'/>
        <script src="/home/layui/layui.all.js"></script>
        <script src="/home/js/responsiveslides.js"></script>
        <script>
        $(function () {
          $("#slider").responsiveSlides({
            auto: true,
            pager: true, 
            nav: true,
            speed: 500,
            maxwidth: 800,
            namespace: "centered-btns"
          });
        });
      </script>
      <!-- 轮播图 -->
     <link rel="stylesheet" type="text/css" href="/home/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/home/css/default.css">
    <link rel="stylesheet" href="/home/css/style1.css">

    <link href="/home/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/home/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/home/css/flexible-bootstrap-carousel.css" />
    <link rel="stylesheet" href="/home/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="/home/css/style1.css" />

    <link rel="stylesheet" type="text/css" href="/home/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/home/css/nprogress.css">
    <link rel="stylesheet" type="text/css" href="/home/css/font-awesome.min.css">
    <script src="/home/js/jquery-2.1.4.min.js"></script>
    <script src="/home/js/nprogress.js"></script>

</head>
<body>
<!-- 导航 -->
    <header>
    <?php
        $cates = \App\Models\Cates::select()->where('pid','=',0)->get();
        /**
         * 
         *cates 类别分类
         *advers 推荐位广告
         *slid  轮播图
         */
        $cates = \App\Models\Cates::getCates();
        $advers  = \App\Models\Adver::select()->where('status','=',1)->get();
        $slids  = \App\Models\Slid::select()->where('status','=',1)->get();
    ?>
        <nav style="background:#fff url({{ $web->logo }}) no-repeat -15px;">
            <ul>            
                <li><a href="/">首页</a></li>
                @foreach($cates as $k=>$v)
                <li><a href="/home/invitation/{{ $v['cid'] }}">{{ $v['cname'] }}</a></li>
                @endforeach
                <li><a href="/home/glossary">图集</a></li>
                <li><a href="#">问答</a></li>
            </ul>
            @if (session()->has('user'))
            <button style='height:75px;float: right;line-height: 75px;' class="navbut">欢迎您：{{ session('user')->uname }}</button>
                <div class="person" style="display: none;height:120px;">
                    <li><a href="/home/user/userdateail" style='text-decoration:none;color:#333;'>个人中心</a></li>
                    <li style="border-bottom:1px solid #ccc;"><a href="/home/user/userdateail" style='text-decoration:none;color:#333;'>我的私信</a></li>
                    <li style="border"><a href="/home/user/logout" style='text-decoration:none;color:#333;'>退出</a></li>
                </div>
            @else
           <a href="/home/user/register" style='float: right;line-height:75px;'>注册</a>  
            <a href="/home/user/login" style='float: right;line-height:75px;margin-right:10px;'>登录</a>
            @endif
        </nav>
    </header>
    <script type="text/javascript">
            $('.navbut').click(function(){
                // 停止正在执行的动画  并且隐藏
                $('.person:animated').stop().hide();
                // 切换滑动效果
                $('.person').slideToggle('slow');
            });
    </script>


<!-- 内容 -->

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
 <meta name="csrf-token" content="{{ csrf_token() }}">
<title></title>
<link href="/home/user/css/jquery.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/home/user/css/personalPublic20180626.css">
<style>
    .ui-datepicker .ui-datepicker-title select {
        float: left !important;
        font-size: 1em !important;
        margin: 1px 0 !important;
    }
    .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
        width: 45%  !important;
    }
    .ui-datepicker select.ui-datepicker-year {
        margin-right: 5px  !important;
    }
</style>
<link type="text/css" rel="stylesheet" href="/home/user/css/laydate.css">
<link type="text/css" rel="stylesheet" href="/home/user/css/laydate_002.css" id="LayDateSkin"></head>
<body>
<!--吸顶-->
<link rel="stylesheet" href="/home/user/css/20171109AllbbsHead.css">
<link rel="stylesheet" type="text/css" href="/home/user/css/black.css">
<link rel="stylesheet" type="text/css" href="/home/layui-v2.4.5/layui/css/layui.css">
<script src="/home/user/css/push.js"></script>
<script src="/home/user/css/hm.js"></script>
<script src="/home/user/css/jquery-1.js"></script>
<script language="JavaScript" type="text/javascript" src="/home/user/css/go_wap.js"></script>
<script language="JavaScript" type="text/javascript" src="/home/user/css/pv.js"></script>
<script type="text/javascript" id="pv_d" src="/home/user/css/p.js"></script>
<script src="/home/js/jquery.lazyload.min.js"></script>
<script src="/home/layui-v2.4.5/layui/layui.all.js"></script>
<img id="fn_dot_pvm" style="display:none" src="/home/user/css/dot.gif" width="1" height="1" border="0">
<img style="display:none" src="/home/user/css/pvhit0001.gif" width="1" height="1" border="0">
    <link rel="stylesheet" type="text/css" href="/home/user/pass/TY.css">
    <link rel="stylesheet" type="text/css" href="/home/user/pass/change-password_ed8d7e7.css">
<link type="text/css" charset="utf-8" rel="stylesheet" href="/home/user/pass/nav2_0.css">
<!--blackHead-->
<div class="personalBox wrapper1380" style="margin-top:100px;height:790px;">
    <!--personalSide-->
    <div class="personalSide">
    <dl class="headerPer yuanYin clearfix">
        <dt>
        	<a href="/home/user/userdateail">
                @if(!empty($userinfo['face']))
            	<img class="img" src="{{ $userinfo['face'] }}" width="90" height="90">
                @endif
            </a>
        <h4 class="tit"><b></b></h4>
        <span class="grade">普通会员</span>
        </dt>
        <dd class="rightBorder">
            <span>关注</span>
           <a href="#">{{ $idol }}</a>
        </dd>
        <dd>
            <span>粉丝</span>
            <a href="#">{{ $fans }}</a>
        </dd>
    </dl>
    <ul class="menuPer yuanYin">
        <li>
            <a href="#" target="_self" class="info" style="color:#0f0f0f;">资料编辑</a>
            <a href="#" target="_self" class="pass" style="color:#0f0f0f;">密码修改</a>
        </li>
    </ul>
</div>
    <script type="text/javascript">
        {{ csrf_field() }}
    </script>
    <!--personalMain-->
    <div class="personalMain" id="infomation">
        <h3 class="yuanYin">个人资料</h3>
        <dl class="yuanYin">
            <dt>基本信息</dt>
            <form action="/home/user/update/{{ $userinfo->uid }}" method='post' enctype="multipart/form-data">
            	{{ csrf_field() }}
				<dd>
	                <ul class="module-box">
	                    <!--头像 begin-->
	                    <li class="mList headerEdit">
	                        <span class="module-tit">
	                            <em class="red">*</em>
	                            头像
	                        </span>
	                        <div>
	                            <span>
                                    <label class='users' for="test1">
                                        <img src="{{ $userinfo['face'] }}" style='width:90px;height:90px;border-radius:50%'>
                                        <input type="hidden" name="face">
                                    </label>
									<button type="button" class="layui-btn" id="test1" style='display:none;margin-top:30px;'>
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                    <script>
                                        layui.use('upload', function(){
                                          var upload = layui.upload;
                                          //执行实例
                                          var uploadInst = upload.render({
                                            elem: '#test1' //绑定元素
                                            ,url: '/home/user/uploads' //上传接口
                                            ,data: {'_token':$('input[name=_token').eq(0).val()}
                                            ,field:'face'
                                            ,done: function(res){
                                                  //上传完毕回调
                                                  if(res.code == 1){
                                                    // 修改头像
                                                    $('.users img').eq(0).attr('src',res.data.src);
                                                    $('.users input[type=hidden]').val(res.data.src);
                                                  }
                                            }
                                            ,error: function(){
                                              //请求异常回调
                                            }
                                          });
                                        });
                                    </script>
	                            </span>
	                       	</div>
	                    </li>
	                    <!--头像 end-->
	                    <!--用户名 begin-->
	                    <li class="mList" style='margin-top:40px;'>
	                        <span class="module-tit">
	                            <em class="red">*</em>
	                            用户名
	                        </span>
	                        <div>
	                            <span><input type="text" name='uname' style='width:100px;margin-top:10px;' value="{{ session('user')->uname }}" readonly></span>
	                         </div>
	                    </li>
	                    <!--用户名 end-->
	                    <!--性别 begin-->
	                    <li class="mList" style='padding-top:10px;'>
	                        <span class="module-tit">
	                            <em class="red">*</em>
	                            性别
	                        </span>
	                        <div class="module-main">
	                            <span> 
                                   
									男<input type="radio" name='sex' value='m' @if($userinfo->sex=='m')
                                    checked @endif>&nbsp&nbsp&nbsp
                                   
									女<input type="radio" name='sex' value='w' @if($userinfo->sex=='w')
                                    checked @endif>&nbsp&nbsp&nbsp
                                    
									未知<input type="radio" name='sex' value='x' @if($userinfo->sex=='x')
                                    checked @endif>
                                    
	                            </span>
	                         </div>
	                    </li>
	                    <!--性别 end-->
                        
                        <!--手机号 begin-->
                        <li class="mList" style='padding-top:10px;'>
                            <span class="module-tit">
                                <em class="red">*</em>
                                手机号
                            </span>
                            <div class="module-main">
                                <span id="phone"> 
                                    <input type="tel" name='phone' style='width:200px;height:30px;margin-top:10px;border:1px solid #ccc;' value="{{ session('user')->phone }}">
                                    <span></span>
                                </span>
                             </div>
                        </li>
                        <!--手机号 end-->
	                    
                        <!--邮箱 begin-->
                        <li class="mList" style='padding-top:10px;'>
                            <span class="module-tit">
                                <em class="red">*</em>
                                邮箱
                            </span>
                            <div class="module-main" >
                                <span id="email"> 
                                    <input type="text" name='email' style='width:200px;height:30px;margin-top:10px;border:1px solid #ccc;' value="{{ session('user')->email }}">
                                    <span></span>
                                </span>
                             </div>
                        </li>
                        <script type="text/javascript">
                            $('input[name=phone]').blur(function(){
                            var phone_preg = /^1{1}[3-9]{1}[0-9]{9}$/;
                            var phone_vals = $(this).val();
                            if(phone_preg.test(phone_vals)){
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

                                        }else{
                                            $('#phone span:eq(0)').html('<font color="red">手机号已经存在</font>') ;
                                        }
                                    },
                                    dataType:'html',
                                    async:false
                                });
                                
                            }else{
                                $('#phone span:eq(0)').html('<font color="red">手机号格式错误</font>');
                            }
                        });
                            $('input[name=email]').blur(function(){
                                var email_preg = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
                                var email_vals = $(this).val();
                                if(email_preg.test(email_vals)){
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

                                            }else{
                                                $('#email span:eq(0)').html('<font color="red">邮箱号已经存在</font>') ;
                                            }
                                        },
                                        dataType:'html',
                                        async:false
                                    });
                                    
                                }else{
                                    $('#email span:eq(0)').html('<font color="red">邮箱格式错误</font>');
                                }
                            });
                        </script>
                        <!--邮箱 end-->
    
	                    <!--生日 begin-->
	                    <li class="mList" style='padding-top:10px;'>
	                        <span class="module-tit">生日</span>
	                        <div class="module-main">
	                            <label class="inputText">    
	                               <input type="date" name='birthdate' value='{{ $userinfo->birthdate }}' style="height:40px;">
	                            </label>
	                        </div>
	                    </li>
	                    <!--生日 end-->
	                </ul>
	                <div class="subBtn">
	                   <button type='submit' class="btnPer redBtn" id="saveUserBaseInfo">保存</button>
	                </div>
	            </dd>
            </form>
            
        </dl>
    </div>
    <div class="personalMain" id="password" style="display:none">
        <dl class="yuanYin">
            <dt>修改密码</dt>
            <form action="#" method='post' enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="fowardURL" value="http://passport.tianya.cn/safe.do">
                <input type="hidden" name="source" value="">
                    <div class="form-item">
                        <label class="label" for="oldpassword">当前密码：</label>
                        <div class="field">
                            <input type="password" placeholder="" class="form-input" name="oldpassword" id="oldpassword">
                            <span id="oldpassword_tips" class="form-tips tips-info"></span>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="label" for="password">新密码：</label>
                        <div class="field">
                            <input type="password" placeholder="" class="form-input" name="upass" id="password">
                            <span id="password_tips" class="form-tips tips-info">大小写字母、数字、字符组合更安全</span>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="label" for="password2">确认密码：</label>
                        <div class="field">
                            <input type="password" placeholder="" class="form-input" name="upassok" id="password2">
                            <span id="password2_tips" class="form-tips tips-info">请再输入一遍</span>
                        </div>
                    </div>    
                    <div class="subBtn">
                       <button type='submit' class="btnPer redBtn" id="saveUserBaseInfo">保存</button>
                    </div>              
                </dd>
            </form>
            <script type="text/javascript">
    $('input[name=upass]').keyup(function(){
        var pass_vals = $(this).val();
        if(pass_vals.length < 6){
            $('#password_tips').html( '✖ 密码长度为6-16位');

            return;
        }
        if(pass_vals.length > 16){
            $('#password_tips').html( '✖ 密码长度为6-16位');
            return;
        }
    });
     $('input[name=upassok]').keyup(function(){
        var passok_vals = $(this).val();
        if (passok_vals==$('input[name=upass]').val()) {
            $('#password2_tips').html('<font color="green">两次密码输入一致</font>');
        }else{
            $('#password2_tips').html('<font color="red">两次密码输入不一致</font>');
        };
    });
</script>
            
        </dl>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $('.pass').click(function(){
        $('#password').show();
        $('#infomation').hide();     
    });
    $('.info').click(function(){
        $('#password').hide();
        $('#infomation').show();     
    });
</script>


        <!-- 读取提示信息开始 -->
        @if (session('success'))
        <script type="text/javascript">
            var layer = layui.layer
                 ,form = layui.form;

            layer.msg("{{ session('success')}}");           
        </script>;
        @endif
        @if (session('error'))
          <script type="text/javascript">
          var layer = layui.layer
             ,form = layui.form;
                layer.msg("{{ session('error')}}");         
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
                        layer.msg('{{ $v }}')
                    }                   
                </script>;
            @endforeach
           </ul>
        </div>
        @endif
        <!-- 显示验证错误信息 结束 -->
<!-- 尾部 -->
    <footer>
        <div class="footer-top">
            <?php
                $links = \App\Models\Link::where('status',1)->get();
            ?>
            <ol>
                <h4>友情链接：</h4>
                @foreach ($links as $k=>$v)
                <li><a href="{{ $v->lurl }}">{{ $v->lname }}</a></li>
                @endforeach
            <ol>
        </div>
        <div class="footer-bottom">
            <ul>
                <li><a href="">关于臻妍 </a></li>
                <li><a href="">| </a></li>
                <li><a href="">广告服务 </a></li>
                <li><a href="">| </a></li>
                <li><a href="">臻妍客服 </a></li>
                <li><a href="">| </a></li>
                <li><a href="">隐私和版权 </a></li>
                <li><a href="">| </a></li>
                <li><a href=""> </a></li>
                <li><a href="">联系我们 </a></li>
                <li><a href="">加入臻妍 </a></li>
                <li><a href="">| </a></li>
                <li><a href="">手机版 </a></li>
                <li><a href="">| </a></li>
                <li><a href="">隐私和版权 </a></li>
            </ul>
        <p>© 1999 - 2018 臻妍论坛</p>
        </div>
        
    </footer>

</body>
</html>