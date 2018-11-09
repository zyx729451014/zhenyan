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
                    <li><a href="/home/private" style='text-decoration:none;color:#333;'>我的私信</a></li>
                    <li><a href="/home/user/logout" style='text-decoration:none;color:#333;'>退出</a></li>
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
<link href="/home/user/style/jquery.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/home/user/style/headList20180626.css">
</head>
<body>
<!--吸顶-->
<link rel="stylesheet" href="/home/user/style/20171109AllbbsHead.css">
<link rel="stylesheet" type="text/css" href="/home/user/style/black.css">
<script src="/home/user/style/push.js"></script>
<script src="/home/user/style/hm.js"></script>
<script src="/home/user/style/jquery-1.js"></script>
<script language="JavaScript" type="text/javascript" src="/home/user/style/go_wap.js"></script>
<script language="JavaScript" type="text/javascript" src="/home/user/style/pv.js"></script>
<script type="text/javascript" id="pv_d" src="/home/user/style/p.js"></script>
<img id="fn_dot_pvm" style="display:none" src="/home/user/style/dot.gif" width="1" height="1" border="0">
<img style="display:none" src="/home/user/style/pvhit0001.gif" width="1" height="1" border="0">
<div class="personalHead clearfix">
    <div class="personalInfor">
        <p class='touxiang' style='width:100px;height:100px;margin:0px auto;'>
            @if(!empty($userinfo->face))
            <img src="{{ $userinfo->face }}" alt="" style='width:100%;height:100%;border-radius:50%;'>
            @endif
        </p>
        @if($user->identity == 0)
        <span class="nameLabel banZhu">普通用户</span>
        @else
        <span class="nameLabel banZhu">管理员</span>
        @endif
        <div class="btnBox headerFollow">
                {{ $user->uname }}
                <a class="editBtn defaultA" href="/home/user/information"><i class="bBg">0</i>编辑</a>
        </div>
        <span class="autograph">积分  |   {{ $user->userinfo->point }}</span>
    </div>
    <div class="menuBox personalCont">
        <a class="invi" href="#" target="_self" style="border-bottom:2px solid #333;">我的帖子</a>
        <a class="glo" href="#" target="_self">我的图集</a>
        <a class="ans" href="#" target="_self">我的问答</a>
    </div>
</div>
<!--personalList-->
<!-- 我的帖子 -->
<div class="personalListBlank personalCont" id="invi">
    <div style="text-align:center;line-height:40px;">
        <a class="invitation" href="#" target="_self" style="margin-right:20px;color:#07aacd;">我的帖子</a>
        <a class="comment" href="#" target="_self" style="margin-right:20px;">我的回帖</a>
        <a class="collect" href="#" target="_self">我的收藏</a>
    </div>


    <div class="personalListBlank" id="invitation" style="width:970px;margin:0px auto;">
       @if($invitations->isEmpty())
            <div class="blankList non-existent show">
                <p class="non-existentTxt">暂时木有内容呀~</p>
            </div>
        @else  
        <h4>我发布的帖子</h4>
        <ol>
            @foreach($invitations as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/invitation/show/{{ $v->id }}" style="font-size:13px;line-height:30px;">{{ $v->title }}</a>               
                    <a href="/home/invitation/destroy/{{ $v->id }}" style="float:right;width:70px;"><button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" >删除</button></a>
                    <a href="/home/invitation/{{$v->id}}/edit" style="float:right;width:70px;"><button style="background:#cccccc;color:#fff;;" class="btn btn-default btn-search">编辑</button> </a>                  
            </li>            
            @endforeach
           
        </ol> 
        @if(count($invitations) >=15)
        <div style="margin-left:450px;">
            <a href="#" id="invi_qb">点击查看全部</a>
        </div>
        @endif
        @endif
    </div>

     <div class="personalListBlank" id="invitations" style="width:970px;margin:0px auto;display:none;">
        <ol>
            @foreach($invitations1 as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/invitation/show/{{ $v->id }}" style="font-size:13px;line-height:30px;">{{ $v->title }}</a>               
                    <a href="/home/invitation/destroy/{{ $v->id }}" style="float:right;width:70px;"><button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" >删除</button></a>
                    <a href="/home/invitation/{{$v->id}}/edit" style="float:right;width:70px;"><button style="background:#cccccc;color:#fff;;" class="btn btn-default btn-search">编辑</button> </a>                  
            </li>            
            @endforeach
        </ol>
    </div>
    <div class="personalListBlank" id="comment" style="width:970px;margin:0px auto;display:none;">
        @if($invi_comments->isEmpty())
            <div class="blankList non-existent show">
                <p class="non-existentTxt">暂时木有内容呀~</p>
            </div>
        @else  
        <h4>我的回帖</h4>
        <ol style="margin-left:20px;">
            @foreach($invi_comments as $k=>$v)
            <li style="border:1px solid #c1c9cb;line-height:40px;padding:10px;margin:10px;">
                回复内容 : {{ $v->content }} :<span style="font-size:13px;color:#babebf;"> &nbsp{{ $v->created_at }}</span>
                <br>
                <a href="" style="color:#47494a;">{{ $v->invi_commentinvi->title }}</a>
                <span style="color:#abafb0;font-size:15px;"> {{ $v->invi_commentuser->uname }}</span>
            </li>
             @endforeach          
        </ol>
        @if(count($comments) >= 5)
        <div style="margin-left:450px;">
            <a href="#" id="comm_qb">点击查看全部</a>
        </div>
        @endif
        @endif
    </div>
    <div class="personalListBlank" id="comments" style="width:970px;margin:0px auto;display:none;">
        <ol style="margin-left:20px;">
            @foreach($comments as $k=>$v)
            <li style="border:1px solid #c1c9cb;line-height:40px;padding:10px;margin:10px;">
                回复内容 : {{ $v->content }} :<span style="font-size:13px;color:#babebf;"> &nbsp{{ $v->created_at }}</span>
                <br>
                <a href="" style="color:#47494a;">{{ $v->invi_commentinvi->title }}</a>
                <span style="color:#abafb0;font-size:15px;"> {{ $v->invi_commentuser->uname }}</span>
            </li>
             @endforeach          
        </ol>
    </div>
    <div class="personalListBlank" id="collect" style="width:970px;margin:0px auto;display:none;">
        @if($invi_collects->isEmpty())
            <div class="blankList non-existent show">
                <p class="non-existentTxt">暂时木有内容呀~</p>
            </div>
        @else  
        <h4>帖子收藏</h4>
        <ol>
            @foreach($invi_collects as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/invitation/show/{{ $v->id }}">{{ $v->invi_collectinvi->title }}</a>
            <form action="/home/Invi_collect/{{ $v->id }}" method="post" style="float:right;width:70px;margin-right:20px;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}   
                <button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" type="submit">取消收藏</button>           
            </form>
            </li> 
            @endforeach
        </ol>
        @if(count($collects) >=15)
        <div style="margin-left:450px;">
            <a href="#" id="coll_qb">点击查看全部</a>
        </div>
        @endif
        @endif
    </div>
        <div class="personalListBlank" id="collects" style="width:970px;margin:0px auto;display:none;">
        <ol>
            @foreach($collects as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/invitation/show/{{ $v->id }}">{{ $v->invi_collectinvi->title }}</a>
            <form action="/home/Invi_collect/{{ $v->id }}" method="post" style="float:right;width:70px;margin-right:20px;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}   
                <button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" type="submit">取消收藏</button>           
            </form>
            </li> 
            @endforeach
        </ol>
    </div>
</div>
<!-- 我的图集  -->
<div class="personalListBlank personalCont" id="glo" style="display:none;">
    <div style="text-align:center;line-height:40px;">
        <a class="glossary" href="#" target="_self" style="margin-right:20px;color:#07aacd;">我的图集</a>
        <a class="gcomment" href="#" target="_self" style="margin-right:20px;">我的评论</a>
        <a class="gcollect" href="#" target="_self">我的收藏</a>
    </div>
    <div class="personalListBlank" id="glossary" style="display:block;width:970px;margin:0px auto;">
        @if($glossary->isEmpty())
            <div class="blankList non-existent show">
                <p class="non-existentTxt">暂时木有内容呀~</p>
            </div>
        @else
        <h4>我发布的图集</h4>
        <ol>
            @foreach($glossary as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/glossary/{{ $v->id }}" style="font-size:13px;line-height:30px;">{{ $v->title }}</a>               
                <form style="float:right;width:70px;" action="/home/glossary/{{ $v->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" >删除</button>
                </form>  
                    <a href="/home/glossary/{{$v->id}}/edit" style="float:right;width:70px;"><button style="background:#cccccc;color:#fff;;" class="btn btn-default btn-search">编辑</button> </a>                  
            </li>
            
            @endforeach
        </ol>
         @if(count($glossary) >= 15)
        <div style="margin-left:450px;">
            <a href="#" id="glo_qb">点击查看全部</a>
        </div>
        @endif
        @endif
    </div>
    <div class="personalListBlank" id="glossaries" style="width:970px;margin:0px auto;display:none;">
        <ol>
            @foreach($glossaries as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/glossary/{{ $v->id }}" style="font-size:13px;line-height:30px;">{{ $v->title }}</a>               
                <form style="float:right;width:70px;" action="/home/glossary/{{ $v->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" >删除</button>
                </form>  
                    <a href="/home/glossary/{{$v->id}}/edit" style="float:right;width:70px;"><button style="background:#cccccc;color:#fff;;" class="btn btn-default btn-search">编辑</button> </a>                  
            </li>           
            @endforeach
        </ol>
    </div>
    <div class="personalListBlank " id="gcomment" style="width:970px;margin:0px auto;display:none;">
        @if($glossary->isEmpty())
            <div class="blankList non-existent show">
                <p class="non-existentTxt">暂时木有内容呀~</p>
            </div>
        @else
        <h4>我的评论</h4>
        <ol style="margin-left:20px;">
            @foreach($glocomment as $k=>$v)
            <li style="border:1px solid #c1c9cb;line-height:40px;padding:10px;margin:10px;">
                回复内容 : {{ $v->content }} :<span style="font-size:13px;color:#babebf;"> &nbsp{{ $v->created_at }}</span>
                <br>
                <a href="/home/glossary/{{ $v->commentglo->id }}" style="color:#47494a;">{{ $v->commentglo->title }}</a>
                <span style="color:#abafb0;font-size:15px;float:right;"> {{ $v->commentuser->uname }}</span>
            </li>
             @endforeach          
        </ol>
        @if(count($glocomment) >= 5)
        <div style="margin-left:450px;">
            <a href="#" id="glocom_qb">点击查看全部</a>
        </div>
        @endif
        @endif
    </div>
    <div class="personalListBlank" id="gcomments" style="width:970px;margin:0px auto;display:none;">
        <ol style="margin-left:20px;">
            @foreach($glocomments as $k=>$v)
            <li style="border:1px solid #c1c9cb;line-height:40px;padding:10px;margin:10px;">
                回复内容 : {{ $v->content }} :<span style="font-size:13px;color:#babebf;"> &nbsp{{ $v->created_at }}</span>
                <br>
                <a href="/home/glossary/{{ $v->commentglo->id }}" style="color:#47494a;">{{ $v->commentglo->title }}</a>
                <span style="color:#abafb0;font-size:15px;float:right;"> {{ $v->commentuser->uname }}</span>
            </li>
             @endforeach          
        </ol>
    </div>


    <div class="personalListBlank" id="gcollect" style="width:970px;margin:0px auto;display:none;">
         @if($glossary->isEmpty())
            <div class="blankList non-existent show">
                <p class="non-existentTxt">暂时木有内容呀~</p>
            </div>
        @else
        <h4>图集收藏</h4>
        <ol>
            @foreach($glocollect as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/glossary/{{ $v->collectglo->id }}">{{ $v->collectglo->title }}</a>
                <form action="/home/glossary/collect/{{ $v->id }}" method="post" style="float:right;width:70px;margin-right:20px;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}   
                <button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" type="submit">取消收藏</button>           
                </form>

            </li>
            @endforeach
        </ol>
         @if(count($glocollect) >= 15)
        <div style="margin-left:450px;">
            <a href="#" id="glocol_qb">点击查看全部</a>
        </div>
        @endif
        @endif
    </div>
    <div class="personalListBlank" id="gcollects" style="width:970px;margin:0px auto;display:none;">
        <ol style="margin-left:20px;">
            @foreach($glocollects as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/glossary/{{ $v->collectglo->id }}">{{ $v->collectglo->title }}</a>
                <form action="/home/glossary/collect/{{ $v->id }}" method="post" style="float:right;width:70px;margin-right:20px;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}   
                <button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" type="submit">取消收藏</button>           
                </form>

            </li>
             @endforeach          
        </ol>
    </div>
    
</div>
<!-- 我的问答 -->

<div class="personalListBlank personalCont" id="ans" style="display:none;">
    <div style="text-align:center;line-height:40px;">
        <a class="question" href="#" target="_self" style="margin-right:20px;color:#07aacd;">我的问题</a>
        <a class="answer" href="#" target="_self" style="margin-right:20px;">我的回答</a>
    </div>
    <!-- 我的问题 5条 -->
    <div class="personalListBlank" id="question" style="display:block;width:970px;margin:0px auto;">
        @if($answer->isEmpty())
            <div class="blankList non-existent show">
                <p class="non-existentTxt">暂时木有内容呀~</p>
            </div>
        @else
        <h4>我的问题</h4>
        <ol>
            @foreach($answer as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/answer/{{ $v->id }}" style="font-size:13px;line-height:30px;">{{ $v->title }}</a>               
                <form style="float:right;width:70px;" action="/home/answer/{{ $v->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" >删除</button>
                </form>  
                    <a href="/home/answer/{{$v->id}}/edit" style="float:right;width:70px;"><button style="background:#cccccc;color:#fff;;" class="btn btn-default btn-search">编辑</button> </a>                  
            </li>
            
            @endforeach
        </ol>
         @if(count($answer) >= 5)
        <div style="margin-left:450px;">
            <a href="#" id="questionss">点击查看全部</a>
        </div>
        @endif
        @endif
    </div>

     <!-- 我的问题  全部 -->
    <div class="personalListBlank" id="questions" style="display:block;width:970px;margin:0px auto;">
        <ol>
            @foreach($answers as $k=>$v)
            <li style="line-height:30px;margin-left:10px;border:1px solid #c1c9cb;padding:10px;margin:10px;">{{ $k+1 }}.&nbsp <a href="/home/answer/{{ $v->id }}" style="font-size:13px;line-height:30px;">{{ $v->title }}</a>               
                <form style="float:right;width:70px;" action="/home/answer/{{ $v->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button style="background:#07aacd;color:#fff;"class="btn btn-default btn-search" >删除</button>
                </form>  
                    <a href="/home/answer/{{$v->id}}/edit" style="float:right;width:70px;"><button style="background:#cccccc;color:#fff;;" class="btn btn-default btn-search">编辑</button> </a>                  
            </li>
            @endforeach
        </ol>
    </div>

    <!-- 我的回答 5条-->
    <div class="personalListBlank " id="answer" style="width:970px;margin:0px auto;display:none;">
        @if($answer_comment->isEmpty())
            <div class="blankList non-existent show">
                <p class="non-existentTxt">暂时木有内容呀~</p>
            </div>
        @else
        <h4>我的回答</h4>
         <ol style="margin-left:20px;">
            @foreach($answer_comment as $kk=>$vv)
            <li style="border:1px solid #c1c9cb;line-height:40px;padding:10px;margin:10px;">
                回复内容 : {{ $vv->content }} :<span style="font-size:13px;color:#babebf;"> &nbsp{{ $vv->created_at }}</span>
                <br>
                <a href="/home/answer/{{ $vv->id }}" style="color:#0f3e6f;">{{ $vv->answeruser_comment['title'] }}</a><i style='color:#aaa;'>{{ $vv->answer_commentuser->uname }}</i>
            </li>

            @endforeach          
        </ol>
        @if(count($answer_comment) >= 5)
        <div style="margin-left:450px;">
            <a href="#" id="answerss">点击查看全部</a>
        </div>
        @endif
        @endif 
    </div>

    <!-- 我的回答 全部-->
    <div class="personalListBlank " id="answers" style="width:970px;margin:0px auto;display:none;">
         <ol style="margin-left:20px;">
            @foreach($answer_comments as $kk=>$vv)
            <li style="border:1px solid #c1c9cb;line-height:40px;padding:10px;margin:10px;">
                回复内容 : {{ $vv->content }} :<span style="font-size:13px;color:#babebf;"> &nbsp{{ $vv->created_at }}</span>
                <br>
                <a href="/home/answer/{{ $vv->id }}" style="color:#0f3e6f;">{{ $vv->answeruser_comment['title'] }}</a><i style='color:#aaa;'>{{ $vv->answer_commentuser->uname }}</i>
            </li>
            @endforeach          
        </ol>
    </div>
</div>

<script type="text/javascript">
    $('.invi').click(function(){
        $(this).css('border-bottom','2px solid #333');
        $('.glo').css('border-bottom','');
        $('.ans').css('border-bottom','');
        $('#invi').show();
        $('#glo').hide();
        $('#ans').hide();
    });
    $('.glo').click(function(){
        $(this).css('border-bottom','2px solid #333');
        $('.invi').css('border-bottom','');
        $('.ans').css('border-bottom','');
        $('#glo').show();
        $('#invi').hide();
        $('#ans').hide();
    });
    $('.ans').click(function(){
        $(this).css('border-bottom','2px solid #333');
        $('.invi').css('border-bottom','');
        $('.glo').css('border-bottom','');
        $('#ans').show();
        $('#invi').hide();
        $('#glo').hide();
    });
    $('.collect').click(function(){
        $('#collect').css('display','block');
        $('#collects').css('display','none');
        $('#invitation').css('display','none');
        $('#invitations').css('display','none');
        $('#comment').css('display','none');
        $('#comments').css('display','none');
        $(this).css('color','#07aacd');
        $('.invitation').css('color','');
        $('.comment').css('color','');
    });
     $('.invitation').click(function(){
        $('#invitation').css('display','block');
        $('#invitations').css('display','none');
        $('#collect').css('display','none');
        $('#collects').css('display','none');
        $('#comment').css('display','none');
        $('#comments').css('display','none');
        $(this).css('color','#07aacd');
        $('.collect').css('color','');
        $('.comment').css('color','');
    });
    $('.comment').click(function(){
        $('#comment').css('display','block');
        $('#comments').css('display','none');
        $('#invitation').css('display','none');
        $('#invitations').css('display','none');
        $('#collect').css('display','none');
        $('#collects').css('display','none');
        $(this).css('color','#07aacd');
        $('.invitation').css('color','');
        $('.collect').css('color','');
    });
    $('.gcollect').click(function(){
        $('#gcollect').css('display','block');
        $('#glossary').css('display','none');
        $('#gcomment').css('display','none');
        $(this).css('color','#07aacd');
        $('.glossary').css('color','');
        $('.gcomment').css('color','');
    });
     $('.glossary').click(function(){
        $('#glossary').css('display','block');
        $('#gcollect').css('display','none');
        $('#gcomment').css('display','none');
        $(this).css('color','#07aacd');
        $('.gcollect').css('color','');
        $('.gcomment').css('color','');
    });
      $('.gcomment').click(function(){
        $('#gcomment').css('display','block');
        $('#glossary').css('display','none');
        $('#gcollect').css('display','none');
        $(this).css('color','#07aacd');
        $('.gcollect').css('color','');
        $('.glossary').css('color','');
    });
      $('.answer').click(function(){
        $('#answer').css('display','block');
        $('#answers').css('display','none');
        $('#question').css('display','none');
        $('#questions').css('display','none');
        $(this).css('color','#07aacd');
        $('.question').css('color','');
    });
     $('.question').click(function(){
        $('#question').css('display','block');
        $('#questions').css('display','none');
        $('#answer').css('display','none');
        $('#answers').css('display','none');
        $(this).css('color','#07aacd');
        $('.answer').css('color','');
    });
    $('#invi_qb').click(function(){
        $('#invitation').css('display','none');
        $('#invitations').css('display','block');
    });
     $('#comm_qb').click(function(){
        $('#comment').css('display','none');
        $('#comments').css('display','block');
    });
      $('#coll_qb').click(function(){
        $('#collect').css('display','none');
        $('#collects').css('display','block');
    });
      $('#glo_qb').click(function(){
        $('#glossary').css('display','none');
        $('#glossaries').css('display','block');
    });
     $('#glocom_qb').click(function(){
        $('#gcomment').css('display','none');
        $('#gcomments').css('display','block');
    });
      $('#glocol_qb').click(function(){
        $('#gcollect').css('display','none');
        $('#gcollects').css('display','block');
    });
      $('#questionss').click(function(){ 
        $('#question').css('display','none');
        $('#questions').css('display','block');
    });
    $('#answerss').click(function(){ 
        $('#answer').css('display','none');
        $('#answers').css('display','block');
    });
    $('.ans').click(function(){ 
        $('#questions').css('display','none');
        $('#question').css('display','block');
    });



</script><style type="text/css">
    {
        display: none;
    }
</style>
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