@extends('home/layout/layout')
@section('content-wrapper')
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>个人中心-空白页</title>
<link rel="shortcut icon" href="https://cms.qn.img-space.com/favicon.ico">
<link rel="bookmark" href="https://cms.qn.img-space.com/favicon.ico">
<link href="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/jquery.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/headList20180626.css">
</head>
<body>
<!--吸顶-->
<link rel="stylesheet" href="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/20171109AllbbsHead.css">
<link rel="stylesheet" type="text/css" href="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/black.css">
<script src="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/push.js"></script><script src="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/hm.js"></script><script src="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/jquery-1.js"></script>
<script language="JavaScript" type="text/javascript" src="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/go_wap.js"></script>
<script language="JavaScript" type="text/javascript" src="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/pv.js"></script><script type="text/javascript" id="pv_d" src="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/p.js"></script><img id="fn_dot_pvm" style="display:none" src="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/dot.gif" width="1" height="1" border="0"><img style="display:none" src="%E4%B8%AA%E4%BA%BA%E4%B8%AD%E5%BF%83-%E7%A9%BA%E7%99%BD%E9%A1%B5_files/pvhit0001.gif" width="1" height="1" border="0">
<div class="personalHead clearfix">
    <div class="personalInfor" style='margin-top:-50px;'>
        <p class='touxiang' style='width:100px;height:100px;margin-left:670px'>
            @if(!empty($userinfo->face))
            <img src="{{ $userinfo->face }}" alt="" style='width:100%;height:100%;border-radius:50%;'>
            @endif
        </p>
        @if($user->identity == 0)
        <span class="nameLabel banZhu" style='margin-left:30px;'>普通用户</span>
        @else
        <span class="nameLabel banZhu" style='margin-left:30px;'>管理员</span>
        @endif
        <div class="btnBox headerFollow">
                <a class="editBtn defaultA" href="/home/user/information"><i class="bBg">0</i>编辑</a>
        </div>
        <span class="autograph">签名  |   暂无</span>
    </div>
    <div class="menuBox personalCont">
        <a class="" href="" target="_self">我的帖子<i class="bBg">0</i></a>
        <a class="" href="" target="_self">我的回帖<i class="bBg">0</i></a>
        <a class="" href="" target="_self">我的收藏<i class="bBg">0</i></a>
        <a class="" href="/home/user/information" target="_self">我的资料<i class="bBg">0</i></a>
    </div>
</div>
<!--personalList-->
<div class="personalListBlank personalCont">
    <div class="blankList non-existent show">
        <p class="non-existentTxt">暂时木有内容呀~</p>
    </div>
</div>
</body>
</html>
@endsection