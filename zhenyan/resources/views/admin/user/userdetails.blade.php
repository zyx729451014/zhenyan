@extends('admin/layout/layout')
@section('content-wrapper')

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
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
<script src="/home/user/css/push.js"></script>
<script src="/home/user/css/hm.js"></script>
<script src="/home/user/css/jquery-1.js"></script>
<script language="JavaScript" type="text/javascript" src="/home/user/css/go_wap.js"></script>
<script language="JavaScript" type="text/javascript" src="/home/user/css/pv.js"></script>
<script type="text/javascript" id="pv_d" src="/hone/user/css/p.js"></script>
<img id="fn_dot_pvm" style="display:none" src="/home/user/css/dot.gif" width="1" height="1" border="0">
<img style="display:none" src="/home/user/css/pvhit0001.gif" width="1" height="1" border="0">
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
						@if($user->identity == 0)
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
	                    @endif
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
						@if($user->identity == 0)
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
	                    @endif
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