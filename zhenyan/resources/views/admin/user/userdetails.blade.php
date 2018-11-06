@extends('admin/layout/layout')
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
    <div class="personalMain" style='margin-left:-20px;margin-top:-65px;'>
        <h3 class="yuanYin">用户详情</h3>
        <dl class="yuanYin">
            <dt>个人资料</dt>
            <form action="" method='post' enctype="multipart/form-data">
            	{{ csrf_field() }}
				<dd>
	                <ul class="module-box">
	                    <!--头像 begin-->
	                    <li class="mList headerEdit">
	                        <span class="module-tit">头像</span>
	                        <div>
	                            <span>
									<img class="img" src="{{ $user->userinfo->face }}" width="90" height="90">
	                            </span>
	                       	</div>
	                    </li>
	                    <!--头像 end-->

	                    <!--用户名 begin-->
	                    <li class="mList" style='margin-top:40px;'>
	                        <span class="module-tit">用户名</span>
	                        <div>
	                            <span>{{ $user->uname }}</span>
	                        </div>
	                    </li>
	                    <!--用户名 end-->

	                    <!--身份 begin-->
	                    <li class="mList" style='padding-top:10px;'>
	                        <span class="module-tit">身份</span>
	      	                <div class="module-main">
	                            <span style='padding-top:20px;'> 
									@if($user->identity == 1)管理员
									@else($user->identity == 0)普通用户
									@endif
	                            </span> 
	                         </div>
	                    </li>
	                    <!--份箱 end-->

	                    <!--性别 begin-->
	                    <li class="mList" style='padding-top:10px;'>
	                        <span class="module-tit">性别</span>
	                        <div class="module-main">
	                            <span> 
									@if($user->userinfo->sex == 'w')女
									@elseif($user->userinfo->sex == 'm')男
									@else($user->userinfo->sex == 'x')保密
									@endif
								
	                            </span>
	                         </div>
	                    </li>
	                    <!--性别 end-->

						<!--手机号 begin-->
	                    <li class="mList" style='padding-top:10px;'>
	                        <span class="module-tit">手机号</span>
	      	                <div class="module-main">
	                            <span> 
									{{ $user->phone }} 
	                            </span>
	                         </div>
	                    </li>
	                    <!--手机号 end-->

	                    <!--邮箱 begin-->
	                    <li class="mList" style='padding-top:10px;'>
	                        <span class="module-tit">邮箱</span>
	      	                <div class="module-main">
	                            <span> 
									{{ $user->email }} 
	                            </span>
	                         </div>
	                    </li>
	                    <!--邮箱 end-->

	                    <!--用户名积分 begin-->
	                    <li class="mList" style='padding-top:20px;'>
	                        <span class="module-tit">
	                            用户积分
	                        </span>
	                        <div class="module-main">
	                            <span >
									{{ $user->userinfo->point }}
	                            </span>
	                        </div>
	                    </li>
	                    <!--用户名积分 end-->

	                    <!--生日 begin-->
	                    <li class="mList" style='margin-top:20px;'>
	                        <span class="module-tit">生日</span>
	                        <div class="module-main">
	                            <span>
									{{ $user->userinfo->birthdate }}
	                            </span>
	                        </div>
	                    </li>
	                    <!--生日 end-->
	                </ul>
	                <div class="subBtn">
	                </div>
	            </dd>
            </form>
        </dl>
    </div>
</div>
</body>
</html>
@endsection