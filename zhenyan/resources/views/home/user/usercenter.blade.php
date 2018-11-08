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
            <a href="/home/user/login">登录</a>
            <a href="/home/user/register">注册</a>
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
    .ui-datepicker .ui-datepicker-title select { float: left !important;font-size: 1em !important;margin: 1px 0 !important;}
    .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {width: 45%  !important;}   
    .ui-datepicker select.ui-datepicker-year {margin-right: 5px  !important;}    
    .content{width: 980px;height: auto;margin: 0px auto;margin-top: 90px;}
	.grade{color: #252727;text-align: center;}	   
    form{width: 120px;float: left;margin-left: 10px;} 
    form button{background-color: #f2fbfd;width: 80px;height: 45px;margin-left: 10px;padding: 10px;margin-bottom: 10px; margin-top: 10px;font-size: 13px;}
    .yuanYin dd{line-height: 35px;}
    .yuanYin dd span{width: 120px;display:line-block;float: right;}
    textarea{border:1px solid #ccc;width: 280px;height: 230px;text-indent: 1em;font-size: 14px;margin-top: 20px;}   
    #private{position: absolute;height: 330px;width: 300px;background-color: #f2fbfd;top: 30px;left:350px;display: none;}
    #private span{width: 30px;font-size: 20px;float: right;}
    #private button{background-color: #e4e7e7;margin-top: 10px;}
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
<div class="content" style="margin-top:100px;height:auto;">
    <!--personalSide-->
    <div class="personalSide">
	    <dl class="headerPer yuanYin clearfix">
	        <dt>
	        	<a href="/home/user/userdateail">
	            	<img class="img" src="{{ $user->userinfo->face }}" width="90" height="90">
	            </a>
	        <h4 class="tit"><b></b></h4>
	        <span class="grade">{{ $user->uname }}</span>
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
	    <div class="menuPer yuanYin">
            <?php 
                $friend = App\Models\Friending::where('uid',session('user')->uid)->where('idol',$user->uid)->first();
            ?>
            @if(count($friend) != 1)
	    	<form style="margin-left:10px;" method="post" action="/home/friending">
                {{ csrf_field() }}
		        <button type="submit" name="id" value="{{ $user->uid }}">+关注</button>
		    </form>
            @else
            <form style="margin-left:10px;" method="post" action="/home/friending/{{ $friend->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit">取消关注</button>
            </form>
            @endif
		    <form>
		        <button id="pri"><a href="#">发私信</a></button>
		    </form>
	    </div>
	    <div class="menuPer yuanYin " id="private">
	    	<span id="x"><a href="#">x</a></span>
	    	<form style="margin-top:10px;">
		      	<textarea placeholder="给用户发私信:"></textarea>
		      	<button>发送</button>
		    </form>
	    </div>
	    <ul class="menuPer yuanYin">
	        <li>
	            <a href="#" class="invi">Ta的帖子</a>
	            <a href="#" class="comm">Ta的回复</a>
	            <a href="#" class="coll">Ta的收藏</a>
	        </li>
	    </ul>
	</div>
	<div class="personalMain" id="index">
		<h3 class="yuanYin">Ta 的帖子</h3>
        <dl class="yuanYin">
            @foreach($invitation as $k=>$v)
				<dd>
	              <a href="/home/invitation/show/{{ $v['id'] }}">{{ $v->title }}</a></a><span>{{ $v->created_at }}</span>
	            </dd>
            @endforeach      
        </dl>
        <h3 class="yuanYin">Ta 的收藏</h3>
        <dl class="yuanYin">
			@foreach($invicollect as $k=>$v)
                <dd>
                  <a href="/home/invitation/show/{{ $v['id'] }}">{{ $v->invi_collectinvi->title }}</a></a><span>{{ $v->created_at }}</span>
                </dd>
            @endforeach   
        </dl>
	</div>
	<div class="personalMain" id="invi" style="display:none">
		<h3 class="yuanYin">Ta 的帖子</h3>
        <dl class="yuanYin">
			@foreach($invitations as $k=>$v)
                <dd>
                  <a href="/home/invitation/show/{{ $v['id'] }}">{{ $v->title }}</a></a><span>{{ $v->created_at }}</span>
                </dd>
            @endforeach     
        </dl>
	</div>
	<div class="personalMain" id="comm" style="display:none">
		<h3 class="yuanYin">Ta 的回复</h3>
        <dl class="yuanYin"
			<dd> 
            @foreach($invicomments as $k=>$v)
              	<li style="border-bottom:1px solid #c1c9cb;line-height:40px;padding:10px;margin:10px;">
	                回复内容 :<em style="font-size:13px;color:#babebf;cleal:both;font-style:normal;"> &nbsp {{ $v->content }}</em>
	                <br>
	                <a href="/home/invitation/show/{{ $v['id'] }}" style="color:#47494a;">{{ $v->invi_commentinvi->title }}</a>
        		</li>
            @endforeach
            </dd>       
        </dl>
	</div>
	<div class="personalMain" id="coll" style="display:none">
		<h3 class="yuanYin">Ta 的收藏</h3>
        <dl class="yuanYin">
			@foreach($invicollects as $k=>$v)
                <dd>
                  <a href="/home/invitation/show/{{ $v['id'] }}">{{ $v->invi_collectinvi->title }}</a></a><span>{{ $v->created_at }}</span>
                </dd>
            @endforeach  
        </dl>
	</div>
</div>
<script type="text/javascript">
	$('.invi').click(function(){
		$('#invi').show();
		$('#index').hide();		
		$('#comm').hide();
		$('#coll').hide();
	});
	$('.comm').click(function(){
		$('#comm').show();
		$('#invi').hide();
		$('#index').hide();		
		$('#coll').hide();
	});
	$('.coll').click(function(){
		$('#coll').show();
		$('#invi').hide();
		$('#index').hide();		
		$('#comm').hide();
	});
	$('#pri').click(function(){

		$('#private').css('display','block');
	});
	$('#x').click(function(){
        $('#index').show()
		$('#private').hide();
	});

</script>
</body>
</html>

        <!-- 读取提示信息开始 -->
        @if (session('success'))
            <script type="text/javascript">
                alert("{{ session('success') }}");          
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