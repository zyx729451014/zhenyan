@extends('home/layout/layout')
@section('content-wrapper')
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title></title>
<link rel="shortcut icon" href="https://cms.qn.img-space.com/favicon.ico">
<link rel="bookmark" href="https://cms.qn.img-space.com/favicon.ico">
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
<div class="personalBox wrapper1380">
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
            <a href="https://my.fengniao.com/friend.php?action=friend">0</a>
        </dd>
        <dd>
            <span>粉丝</span>
            <a href="https://my.fengniao.com/friend.php?action=fans">0</a>
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
	                            <span><input type="text" name='point' value='50'></span>
	                        </div>
	                    </li>
	                    <!--用户名积分 end-->

	                    <!--生日 begin-->
	                    <li class="mList">
	                        <span class="module-tit">生日</span>
	                        <div class="module-main">
	                            <label class="inputText">    
	                               <input type="text" name='birthdate' value='1990-01-01'>
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
@endsection