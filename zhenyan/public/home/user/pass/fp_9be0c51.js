!function(e){
	var i={vcodeTpl:function(){
		return['<div id="mobile_validate_pop">','<div class="hd"><a class="pop-close-btn closeBtn" title="关闭" href="javascript:void(0);">&times;</a></div>','<div class="bd">','<div class="vcode-form">','<div class="form-item cf">','<label class="form-label" for="vcode">验证码</label>','<div class="form-field">','<input type="text" class="form-text" name="vcode" id="vcode" />',"</div>","</div>",'<div class="form-item cf">','<div class="form-field">','<img src="//imgcode.tianya.cn/services/ImageCodeService?_r='+(new Date).getTime()+'" class="vcode-img" />',"</div>","</div>",'<div class="form-action">','<button type="button" class="vcode-btn btn btn-blue">确定</button>',"</div>","</div>","</div>","</div>"].join("")},smsTpl:function(e,i,s,t,c){return['<div id="mobile_validate_pop">','<div class="hd"><a class="pop-close-btn closeBtn" title="关闭" href="javascript:void(0);">&times;</a></div>','<div class="bd">','<h4 class="title">验证手机：'+e+" "+i+"</h4>",'<div class="mobile-sms-message">','<p class="send-way">请用手机编写短信发送验证码<strong>'+s+"</strong><br />到特服号码<strong>"+t+"</strong></p>",'<p class="redirect">回复短信后，页面将自动刷新完成认证</p>',"</div>",'<p class="prompt">温馨提示：'+c+'<br />如您发送短信时有“号码错误”的提示，建议你咨询所在地手机卡运营商，如何发送短信到特服号码<strong style="color:#648cb9;">'+t+"</strong></p>","</div>","</div>"].join("")}},s={tyTips:function(e){TY.loader("Qing.ui.tips",function(){new TY.ui.tips({position:"midCenter",el:e.$el||null,type:e.type||"success",msg:e.msg||"成功",time:e.time||2e3,callback:function(){e.cb&&e.cb()}})})},showTipsMsg:function(e,i,s){var t="";switch(i){case"des":t="form-tips tips-des";break;case"error":t="form-tips tips-error";break;case"success":t="form-tips tips-success"}e.attr("class",t).html(s)},checkPhone:function(){var i=e("#mobile").val(),s=e("#mobile_tips");return""==e.trim(i)?(this.showTipsMsg(s,"error","请输入手机号码"),!1):/\D/.test(i)?(this.showTipsMsg(s,"error","请输入正确的手机号码"),!1):""!=e("#area_code").val()&&"+86"!=e("#area_code").val()||/^1([3,4,5,6,7,8,9])\d{9}$/.test(i)?i.length<6||i.length>16?(this.showTipsMsg(s,"error","请输入正确的手机号码"),!1):(""==e("#area_code").val()?this.showTipsMsg(s,"success",'<a href="javascript:void(0);" id="change_code">收不到校验码？换种方式。</a>'):this.showTipsMsg(s,"success",""),!0):(this.showTipsMsg(s,"error","请输入正确的手机号码"),!1)},checkEmail:function(i,s){return""==e.trim(i.val())?(this.showTipsMsg(s,"error","请输入邮箱"),!1):/^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]+$/.test(i.val())?(this.showTipsMsg(s,"success",""),!0):(this.showTipsMsg(s,"error","请输入正确的邮箱"),!1)},checkPwd:function(){var i=function(e){var i=e.charAt(0),s=new RegExp("^["+i+"]+$","gi");if(s.test(e))return"密码不能为重复的字符";for(var t=e.charCodeAt(0),c=e.length-1;c>=0&&e.charCodeAt(c)==t+c--;);if(-1==c)return"密码不能为连续的字符";var o=["1234qwer","5201314"];for(var n in o)if(o[n]==e)return"该密码过于简单";return""==e.replace(/\d+/,"")?"密码不能为纯数字":""==e.replace(/[a-z]+/,"")?"密码不能为纯小写字母":""};return function(){var s=e("#password").val(),t=e("#password_tips"),c="";return 0==s.length?(this.showTipsMsg(t,"error","请输入密码"),!1):s.length<6?(this.showTipsMsg(t,"error","密码不能小于6位"),!1):""!=(c=i(s))?(this.showTipsMsg(t,"error",c),!1):(this.showTipsMsg(t,"success",""),!0)}}(),checkPwd2:function(){var i=e("#password").val(),s=e("#password2").val(),t=e("#password2_tips");return this.checkPwd()?0==s.length?(this.showTipsMsg(t,"error","请再次输入密码"),!1):i!==s?(this.showTipsMsg(t,"error","两次输入密码不一致"),!1):(this.showTipsMsg(t,"success",""),!0):(this.showTipsMsg(t,"error","请先设置正确的密码"),!1)},checkEmpty:function(i,s,t){return""==e.trim(i.val())?(this.showTipsMsg(s,"error",t),!1):(this.showTipsMsg(s,"success",""),!0)},validateName:function(i,t,c){e.getJSON("/fp/validusername.do",{userName:i,_r:(new Date).getTime()},function(e){1==e.success?(s.showTipsMsg(c,"success",""),t.data("available",!0)):(s.showTipsMsg(c,"error",e.message||"验证用户名出错"),t.data("available",!1))})},codeFix:function(e){""==e&&(e="0086");for(var i=8-e.length,s=0;i>s;s++)e+="&nbsp;&nbsp;";return"+"+e}},t={getAreaData:function(){for(var i,t="",c=0,o=countryCodes.length;o>c;c++)i=countryCodes[c],t+='<option value="'+i.countryCode+'">'+s.codeFix(i.countryCode)+i.ChineseName+"("+i.nativeName+")</option>";e("#area").html(t).val(e("#area_code").val()).trigger("change")},showVcodePop:function(){var t=this,c=null;TY.loader("TY.ui.popV2",function(){c=new TY.ui.pop({isShowHead:!1,isShowButton:!1,isPadding:!1,isDrag:!1,fixed:!1,body:i.vcodeTpl(),render:function(){e(".vcode-img").bind("click",function(){e(this).attr("src","//imgcode.tianya.cn/services/ImageCodeService"),e("#vcode").val("")}),e(".vcode-btn").bind("click",function(){e.getJSON("/fp/sendsms.do",{mobile:e("#mobile").val(),imgCode:e("#vcode").val(),_r:(new Date).getTime()},function(i){1==i.success?(t.cdGetMobileVcodeBtn(),s.tyTips({type:"success",msg:"手机验证码已成功发送到您的手机",time:3e3}),c.remove()):0==i.code?s.tyTips({$el:e("#mobile_validate_pop"),type:"warn",msg:"验证码输入有误，请重新输入"}):(t.cdGetMobileVcodeBtn(),s.tyTips({type:"warn",msg:i.message}),c.remove())})})}})})},cdGetMobileVcodeBtn:function(i){function s(){0>=i?(clearInterval(c),t.data("cd",!1),t.html("重新发送")):t.html("重新发送("+i+")"),i--}var t=e("#get_mobile_vcode"),c=null,i=i||60;t.data("cd",!0),s(),c=setInterval(function(){s()},1e3)},showSmsPop:function(){function t(){e.getJSON("/fp/verifysms.do",{countryCode:o,mobile:n,code:r,__sid:e("#__sid").val(),_r:(new Date).getTime()},function(i){1==i.success&&(clearInterval(d),e("#form").submit())})}function c(){e.getJSON("/fp/createsms.do",{countryCode:o,mobile:n,_r:(new Date).getTime()},function(c){1==c.success?(r=c.data.validateCode,l="+86"==o?c.data.specialMobile:"+86 "+c.data.specialMobile,m="+86"==o?"如果操作未成功，请检查短信中验证码是否输入正确，或者换个手机号码尝试":"如果操作未成功，请检查您填入的手机号码前面是否带0，去掉0后重新点击注册按钮，或尝试发送验证码到 <strong style='color:#648cb9;'>0086 "+c.data.specialMobile+"</strong>",TY.loader("TY.ui.popV2",function(){new TY.ui.pop({isShowHead:!1,isShowButton:!1,isPadding:!1,isDrag:!1,fixed:!1,body:i.smsTpl(o,n,r,l,m),render:function(){e("#mobileVcode").val(r),a=setTimeout(function(){t(),d=setInterval(function(){t()},3e3)},5e3)},closeHandler:function(){clearTimeout(a),clearInterval(d)}})})):s.tyTips({type:"warn",msg:c.message})})}var o=e("#area_code").val(),n=e("#mobile").val(),r="",a=null,d=null,l="+86"==o?"1069 0133051331":"+86 18976373566",m="+86"==o?"如果操作未成功，请检查短信中验证码是否输入正确，或者换个手机号码尝试":"如果操作未成功，请检查您填入的手机号码前面是否带0，去掉0后重新点击注册按钮，或尝试发送验证码到 <strong style='color:#648cb9;'>0086 18976373566</strong>";e("#mobileVcode").val()?e.getJSON("/identityapi/verifysms.do",{countryCode:o,mobile:n,code:e("#mobileVcode").val(),__sid:e("#__sid").val(),_r:(new Date).getTime()},function(i){1==i.success?e("#form").submit():c()}):c()},bindEvents:function(){var i=this;e("#area").bind("change",function(){e(".area-code").html(e(this).val()),e("#area_code").val(e(this).val()),""==e(this).val()?(e("#mobile_vcode_item").show().find("#mobileVcode").val(""),e(".area-code").html("+86")):e("#mobile_vcode_item").hide(),e("#mobile").val()&&s.checkPhone()}),e("#mobile").bind("blur",function(){s.checkPhone()}),e("#get_mobile_vcode").bind("click",function(){s.checkPhone()&&!e(this).data("cd")&&i.showVcodePop()}),e("#mobileVcode").bind("blur",function(){s.checkEmpty(e(this),e("#mobileVcode_tips"),"请输入校验码")}),e("#mobile_tips").delegate("#change_code","click",function(){e("#area_code").val("+86"),e("#mobile_vcode_item").hide(),e(this).hide()}),e("#mobile_btn").bind("click",function(){""==e("#area_code").val()?s.checkPhone()&&s.checkEmpty(e("#mobileVcode"),e("#mobileVcode_tips"),"请输入校验码")&&e("#form").submit():s.checkPhone()&&i.showSmsPop()})},init:function(){this.bindEvents(),this.getAreaData(),e("#form input").each(function(){e(this).val()&&e(this).trigger("blur")}),window.errorMsg&&""!=errorMsg&&s.tyTips({type:"warn",msg:errorMsg,time:3e3})}},c={bindEvents:function(){e("#userName").bind("blur",function(){s.checkEmpty(e(this),e("#userName_tips"),"请输入用户名")&&s.validateName(e(this).val(),e(this),e("#userName_tips"))}),e("#email").bind("blur",function(){s.checkEmail(e(this),e("#email_tips"))}),e("#emailVcode").bind("blur",function(){s.checkEmpty(e(this),e("#emailVcode_tips"),"请输入校验码")}),e(".change-vcode-img").bind("click",function(){e(".vcode-img").attr("src","//imgcode.tianya.cn/services/ImageCodeService?_r="+(new Date).getTime()),e("#emailVcode").val("")}),e("#email_btn").bind("click",function(){e("#userName").size()?(e("#userName").triggerHandler("blur"),s.checkEmpty(e("#emailVcode"),e("#emailVcode_tips"),"请输入校验码")&&e("#userName").data("available")&&e("#form").submit()):s.checkEmail(e("#email"),e("#email_tips"))&&s.checkEmpty(e("#emailVcode"),e("#emailVcode_tips"),"请输入校验码")&&e("#form").submit()})},init:function(){this.bindEvents(),e("#form input").each(function(){e(this).val()&&e(this).trigger("blur")}),window.errorMsg&&""!=errorMsg&&s.tyTips({type:"warn",msg:errorMsg,time:3e3})}},o={bindEvents:function(){e("#regUserName").bind("blur",function(){s.checkEmpty(e(this),e("#regUserName_tips"),"请输入用户名")&&s.validateName(e(this).val(),e(this),e("#regUserName_tips"))}),e("#regAddress").bind("blur",function(){s.checkEmpty(e(this),e("#regAddress_tips"),"请输入注册地点")}),e("#regEmail").bind("blur",function(){s.checkEmail(e(this),e("#regEmail_tips"))}),e("#hisLoginMsg1").bind("blur",function(){s.checkEmpty(e(this),e("#hisLoginMsg1_tips"),"请输入历史时间和地点1")}),e("#hisLoginMsg2").bind("blur",function(){s.checkEmpty(e(this),e("#hisLoginMsg2_tips"),"请输入历史时间和地点2")}),e("#contactEmail").bind("blur",function(){s.checkEmail(e(this),e("#contactEmail_tips"))}),e("#contactPhone").bind("blur",function(){s.checkEmpty(e(this),e("#contactPhone_tips"),"请输入联系电话")}),e("#serviceVcode").bind("blur",function(){s.checkEmpty(e(this),e("#serviceVcode_tips"),"请输入校验码")}),e(".change-vcode-img").bind("click",function(){e(".vcode-img").attr("src","//imgcode.tianya.cn/services/ImageCodeService?_r="+(new Date).getTime()),e("#emailVcode").val("")}),e("#service_btn").bind("click",function(){e("#regUserName").triggerHandler("blur"),s.checkEmpty(e("#regAddress"),e("#regAddress_tips"),"请输入注册地点")&&s.checkEmail(e("#regEmail"),e("#regEmail_tips"))&&s.checkEmpty(e("#hisLoginMsg1"),e("#hisLoginMsg1_tips"),"请输入历史时间和地点1")&&s.checkEmpty(e("#hisLoginMsg2"),e("#hisLoginMsg2_tips"),"请输入历史时间和地点2")&&s.checkEmail(e("#contactEmail"),e("#contactEmail_tips"))&&s.checkEmpty(e("#contactPhone"),e("#contactPhone_tips"),"请输入联系电话")&&s.checkEmpty(e("#serviceVcode"),e("#serviceVcode_tips"),"请输入校验码")&&e("#regUserName").data("available")&&e("#form").submit()})},init:function(){this.bindEvents(),e("#form input").each(function(){e(this).val()&&e(this).trigger("blur")}),window.errorMsg&&""!=errorMsg&&s.tyTips({type:"warn",msg:errorMsg,time:3e3})}},n={checkPswStrength:function(){var i=e("#password").val(),s=0;/\d/.test(i)&&s++,/[a-z]/.test(i)&&s++,/[A-Z]/.test(i)&&s++,/\W/.test(i)&&s++,s>3?s=3:void 0,e(".password-strength").attr("class","password-strength cf lv"+s)},bindEvents:function(){var i=this;e("#userName").bind("blur",function(){s.checkEmpty(e(this),e("#userName_tips"),"请输入用户名")&&s.validateName(e(this).val(),e(this),e("#userName_tips"))}),e("#password").bind("blur",function(){s.checkPwd(),e("#password2").val()&&s.checkPwd2()}).bind("keyup change",function(){i.checkPswStrength()}),e("#password2").bind("blur",function(){s.checkPwd2()}),e("#reset_btn").bind("click",function(){e("#userName").size()?(e("#userName").triggerHandler("blur"),s.checkPwd()&&s.checkPwd2()&&e("#userName").data("available")&&e("#form").submit()):s.checkPwd()&&s.checkPwd2()&&e("#form").submit()})},init:function(){this.bindEvents(),window.errorMsg&&""!=errorMsg&&s.tyTips({type:"warn",msg:errorMsg,time:3e3})}};e(function(){switch(window.FpType){case"mobile":t.init();break;case"email":c.init();break;case"service":o.init();break;case"resetPsw":n.init()}})}(jQuery);