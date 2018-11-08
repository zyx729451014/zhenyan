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
    <link rel="stylesheet" type="text/css" href="/home/css/styles1.css" />

    <link rel="stylesheet" type="text/css" href="/home/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/home/css/nprogress.css">
    <link rel="stylesheet" type="text/css" href="/home/css/font-awesome.min.css">
    <script src="/home/js/jquery-2.1.4.min.js"></script>
    <script src="/home/js/nprogress.js"></script>
    <script src="/home/js/jquery.lazyload.min.js"></script>
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
<title></title>
<link href="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/jquery.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/personalPublic20180626.css">
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
<link type="text/css" rel="stylesheet" href="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/laydate.css"><link type="text/css" rel="stylesheet" href="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/laydate_002.css" id="LayDateSkin"></head>
<body>
<!--吸顶-->
<link rel="stylesheet" href="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/20171109AllbbsHead.css">
<link rel="stylesheet" type="text/css" href="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/black.css">
<script src="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/push.js"></script><script src="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/hm.js"></script><script src="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/jquery-1.js"></script>
<script language="JavaScript" type="text/javascript" src="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/go_wap.js"></script>
<script language="JavaScript" type="text/javascript" src="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/pv.js"></script><script type="text/javascript" id="pv_d" src="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/p.js"></script><img id="fn_dot_pvm" style="display:none" src="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/dot.gif" width="1" height="1" border="0"><img style="display:none" src="FNYX11008815%E7%9A%84%E8%B5%84%E6%96%99-FNYX11008815%E7%9A%84%E4%B8%BB%E9%A1%B5_files/pvhit0001.gif" width="1" height="1" border="0">
<!--blackHead-->
<div class="personalBox wrapper1380" style="margin-top:100px;height:630px;">
    <!--personalSide-->
    <div class="personalSide">
    <dl class="headerPer yuanYin clearfix">
        <dt>
        	<a href="/home/user/userdateail">
            	<img class="img" src="{{ $userinfo['face'] }}" width="90" height="90">
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
            <a href="" target="_self" class="">我的帖子</a>
            <a href="" target="_self" class="">我的回复</a>
            <a href="" target="_self" class="">我的收藏</a>
        </li>
    </ul>
</div>
    <!--personalMain-->
    <div class="personalMain">
        <h3 class="yuanYin">个人资料</h3>
        <dl class="yuanYin">
            <dt>基本信息</dt>
            <form action="/home/user/update/{{ session('user')->uid }}" method='post' enctype="multipart/form-data">
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
									<input type="file" name='face' style='padding-top:30px;'>
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
									男<input type="radio" name='sex' value='m'>&nbsp&nbsp&nbsp
									女<input type="radio" name='sex' value='w'>&nbsp&nbsp&nbsp
									未知<input type="radio" name='sex' value='x' checked>
	                            </span>
	                         </div>
	                    </li>
	                    <!--性别 end-->

	                    <!--用户名积分 begin-->
	                    <li class="mList">
	                        <span class="module-tit">
	                            用户积分
	                        </span>
	                        <div class="module-main">
	                            <span>{{ $userinfo->point }}</span>
	                        </div>
	                    </li>
	                    <!--用户名积分 end-->

	                    <!--生日 begin-->
	                    <li class="mList">
	                        <span class="module-tit">生日</span>
	                        <div class="module-main">
	                            <label class="inputText">    
	                               <input type="date" name='birthdate' value='1990-01-01' style="height:40px;">
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
</div>
</body>
</html>

            <!-- 读取提示信息开始 -->
        @if (session('success'))
            <script type="text/javascript">
                alert('发表成功');          
            </script>;
        @endif
        @if (session('error'))
          <div class="alert alert-error">
              {{ session('error') }}
          </div>
        @endif
    <!-- 读取提示信息结束 -->

    <!-- 显示验证错误信息 开始 -->
        @if (count($errors) > 0)
        <div class="">
            <ul> 
            @foreach ($errors->all() as $k=>$v)
                <script type="text/javascript">
                    if('{{ $k }}' == 0){
                        alert('{{ $v }}')
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