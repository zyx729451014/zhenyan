/**
 * Created by demonsleep on 2018/3/28.
 */
!function(){
    laydate.skin('yahui');//切换皮肤，请查看skins下面皮肤库
    laydate({elem: '#birthday',max:laydate.now()});//绑定元素
}();
$(function () {
    editData.init();
})
var PROJECT_DOMAIN = 'https://my.fengniao.com/';
var JS_URL = PROJECT_DOMAIN  + 'icon/js/';
var IMG_URL = PROJECT_DOMAIN  + 'icon/images/';

var _time=10;//定时器时间
var _codeTime=10;//修改密码时初始的时间为60S
var _codeTimeIn;//修改密码定时器
var regEmail = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ;
var regCode = /^[0-9]{6}$/;
var regPhone = /^1\d{10}$/;
var regCodeCommon = /^[0-9a-zA-Z]{4}$/m;
var regPw = /^[0-9a-zA-Z!@#$%^&*()_+|?/\-=]{6,16}$/m;
var regPwNum = /^[0-9]{6,16}$/m;

var editData={
    //初始化
    init: function () {
        var _this = editData;
        var weiXinBind = 0;//未位未绑定微信，1位绑定了微信号
        var weiXinBindID = 'woshiweixinhao';//如果已经绑定微信，则显示微信号
        var phoneBind = phoneBindOut;//0未绑定手机号，1绑定了手机号
        var phoneBindID = phoneBindIDOut;//如果已经绑定手机号，则显示手机号
        var emailBind = emailBindOut;//0未绑定手机号，1绑定了手机号
        var emailBindID = emailBindIDOut;//如果已经绑定手机号，则显示手机号
        // _this.editHeadImg();//修改头像
        //初始化上传按钮
        editData.uploadPic();
        _this.inputFocus();//初始化文本框聚焦失焦
        $('.selectDefault').unbind('click').on('click', function () {
            editData.selectAssembly($(this).parents('.selectBox'));
        });
        _this.editWeiXinBind(weiXinBind,weiXinBindID);//初始化微信绑定状态
        _this.editPhone(phoneBind,phoneBindID);//初始化手机号绑定状态
        _this.editEmail(emailBind,emailBindID);//初始化邮箱绑定状态
        _this.refreshCodeCommon();//刷新图片验证码
        $('#signText').keyup(function () {//实时监测签名输入
            editData.textUpNum($('.signEdit'),'signText',40);
        });
        $('.personalMain .module-box .headerEdit .labelBox').bind('click', function () {//编辑头像
            _this.editHeadImg($(this).siblings('span'));
        });
        $('.editUserNameBtn').bind('click', function () {//点击修改用户名
            _this.editUserName($(this).siblings('span'));
        });
        $('.editNicknameBtn').bind('click', function () {//点击修改昵称
            _this.editNickname($(this).siblings('span'));
        });
        $('.editPassWordBtn').bind('click', function () {//点击修改密码
            // var userPhone='183****9011';
            if(editPasswordType == 0){
                var addTxtCont='<span class="point"> '+editPasswordShowTxt+' </span> <div class="labelInputBox"><span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>';
                editData.showTan(addTxtCont,'修改密码');
            }else{
                _this.editPassWord($(this).siblings('span'),editPasswordShowTxt);
            }
        });
        $('.getCity').bind('click', function(){
            var provinceid = $(this).attr('data-value');
            $('#showCityPre').html('请选择城市');
            _this.getCity(provinceid);
        });
        $('#domainName').focus(function(){
            $(this).val(PROJECT_DOMAIN);
        }).blur(function(){
            if($(this).val() == PROJECT_DOMAIN){
                $(this).val('');
            }
        });

        $('#saveUserBaseInfo').bind('click', function(){
            var sex = 0;
            $('.sex').each(function (){
                if($(this).hasClass('act')){
                    sex = $(this).attr('data-value');
                }
            });
            var provinceid = $('#getProvinceid').attr('data-value');
            var cityid = $('#getCityid').attr('data-value');
            var address = $('#address').val();
            var birthday = $('#birthday').val();
            var cardnum = $('#cardnum').val();
            var sign = $('#signText').val();

            $.ajax({
                'url':PROJECT_DOMAIN + '/ajax/ajaxRestUserInfo.php',
                'data':'from='+'updateUserBaseInfo'+'&sex='+sex+ '&provinceid='+provinceid+'&cityid='+cityid+'&address='+address+'&birthday='+birthday+'&cardnum='+cardnum+'&sign='+sign,
                'type':'POST',
                'dataType':'jsonp',
                'success':function(data) {
                    if (data['code'] == 1) {
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });

        $('#saveQqWbDomain').bind('click', function () {
            var qq = $('#qqName').val();
            var weibo = $('#weibo').val();
            var domain = '';
            if($('#domainName').length > 0){
                domain = $('#domainName').val();
                var regOne = /(\d{4,10}(qq|qiuqiu|quan|qu)|(qq|qiuqiu|quan|qu)\d{4,10})/i; //过滤个性域名中含有qq与数字的一系列组合
                var regTwo = /^[0-9]*$/; //个性域名不能为纯数字
                var regThree = /^[a-zA-Z0-9]{4,12}$/; //个性域名必须由4-12位英文字母和数字组成
                if(!domain || domain == PROJECT_DOMAIN){
                    domain = '';
                }else{
                    if(domain.indexOf(PROJECT_DOMAIN) != 0){
                        alert('域名格式不正确');
                        return;
                    }
                    domain = domain.replace(PROJECT_DOMAIN, '');
                    if(!domain){
                        alert('域名格式不正确');
                        return;
                    }
                    if(regTwo.test(domain)){
                        alert('个性域名不能为纯数字');
                        return;
                    }
                    if(!regThree.test(domain)){
                        alert('个性域名必须由4-12位英文字母和数字组成');
                        return;
                    }
                    if(regOne.test(domain)){
                        alert('个性域名不能含有敏感字符');
                        return;
                    }
                }
            }
            var regqq = /^[1-9]\d{4,11}$/;
            if(qq && !regqq.test(qq)){
                alert('qq号格式不正确');
                return;
            }
            // var regweibo = /[weibo]+\.+[com]+\/+[\w-]/;
            // if(weibo && !regweibo.test(weibo)){
            //     alert('微博格式不正确');
            //     return;
            // }
            $.ajax({
                'url':PROJECT_DOMAIN + 'ajax/ajaxRestUserInfo.php',
                'data':'from='+'updateUserQqWbDomain'+'&qq='+qq+'&weibo='+weibo+'&domain='+domain,
                'type':'POST',
                'dataType':'jsonp',
                'success':function(data) {
                    if(data.code > 0){
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });
    },
    //编辑上传头像
    editHeadImg: function (userId) {
        // var addTxtCont='<div class="headImgPre"> <span class="preImg"> <img class="imgLOgo" src="'+headpic+'" width="106" height="106"> </span> <p>头像预览</p> </div> <div class="fileBox"> <label for="fileImg" class="inputFileBtn perBg"> <input type="file" name="fileImg" id="fileImg"  class="fileImg" value="选择图片"> </label> <div class="editBtnBox"> <span class="rotateBtn imgEditBtn perBg">旋转</span> <span class="narrowBtn imgEditBtn perBg">缩小</span> <span class="enlargeBtn imgEditBtn perBg">放大</span> </div> <a class="reFileBtn" href="javascript:;" target="_self">重新上传<input type="file" name="fileImg" id="fileImgRe" class="fileImg" value="选择图片"></a> </div> ';
        var addTxtCont='<div class="headImgPre"> <span class="preImg"> <img class="imgLOgo" src="'+headpic+'" width="106" height="106"> </span> <p>头像预览</p> </div> <div class="fileBox"> <label for="fileImg" class="inputFileBtn perBg"> <input type="file" name="fileImg" id="swf-button" class="fileImg"  value="选择图片" /> </label> <div class="editBtnBox"> <span class="rotateBtn imgEditBtn perBg">旋转</span> <span class="narrowBtn imgEditBtn perBg">缩小</span> <span class="enlargeBtn imgEditBtn perBg">放大</span> </div> <a class="reFileBtn" href="javascript:;" target="_self">重新上传<input type="file" name="fileImg" id="fileImgRe" class="fileImg" value="选择图片"></a> </div> ' +
            '<div style="display:none;"  id="fsUploadProgress1"></div><div style="display:none;"  id="btnCancel1"></div><input id="btnCancel" type="button" value="Cancel All Uploads" onClick="swfu.cancelQueue();"  style="display:none;" />';
        var reShowTan = editData.showTan(addTxtCont,'上传头像');
        if(reShowTan){
            editData.uploadPic();
        }
        $('.personalTan dd').addClass('editHeadImg');
    },
    //修改用户名
    editUserName: function (name) {
        var addTxtCont='<span class="hint">提示:  蜂鸟用户名只能够修改一次，所以请谨慎输入一个新名称。</span> <div class="labelInputBox"> <label class="labelInput"> <input type="text" class="reSetName" name="reSetName" placeholder="请输入新用户明" value="'+name.html()+'"> </label> <span class="errorBox">*</span> </div>';
        editData.showTan(addTxtCont,'修改用户名');
        $('.saveBtn').bind('click', function () {
            var newName=$('.reSetName').val();
            if(newName){
                if(newName==name.html()){
                    $('.reSetName').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*您的用户名没有变化！');
                }else{
                    $.ajax({
                        type:'POST',
                        url: PROJECT_DOMAIN + 'ajax/ajaxRestUserInfo.php',
                        dataType:'jsonp',
                        data:'from='+'updateUsername'+'&username='+newName,
                        success:function(data) {
                            if(data.code == 1){
                                location.reload();
                                // name.text(newName);
                                // editData.closeEditTan();
                            }else{
                                $('.reSetName').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*'+data.msg);
                            }
                        }
                    });
                }
            }else{
                $('.reSetName').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入新的蜂鸟用户名');
            }
        });
    },
    //修改昵称
    editNickname: function (name) {
        var addTxtCont='<span class="point">提示:  请填写您的新昵称</span> <div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>新昵称：</span><label class="labelInput"> <input type="text" class="reSetName" name="reSetName" placeholder="请输入新昵称" value="'+name.html()+'"> </label> <span class="errorBox">*</span> </div>';
        editData.showTan(addTxtCont,'修改昵称');
        $('.saveBtn').bind('click', function () {
            var newName=$('.reSetName').val();
            if(newName){
                if(newName==name.html()){
                    $('.reSetName').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*您的昵称没有变化！');
                }else{
                    $.ajax({
                        type:'POST',
                        url: PROJECT_DOMAIN + 'ajax/ajaxRestUserInfo.php',
                        dataType:'jsonp',
                        data:'from='+'updateNickname'+'&nickname='+newName,
                        success:function(data) {
                            if(data['code'] == 1){
                                location.reload();
                                // name.text(newName);
                                // editData.closeEditTan();
                            }else{
                                $('.reSetName').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*' + data.msg);
                            }
                        }
                    });
                }
            }else{
                $('.reSetName').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入新的昵称');
            }
        });
    },
    //修改密码
    editPassWord: function (box,phone) {
        var addTxtCont='<span class="point"> '+phone+' </span> ' +
            '<div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>右侧验证码：</span><label class="labelInput yzLabelInput"> <input type="text" class="codeCommon" id="codeCommon" name="codeCommon" placeholder="请输入验证码" value=""> </label> <img  src="'+PROJECT_DOMAIN+'ajax/code.php" alt="" id="refreshCodeCommon"/> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>' +
            '<div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>手机验证码：</span><label class="labelInput yzLabelInput"> <input type="text" class="codeNew" name="codeNew" placeholder="请输入验证码" value=""> </label> <a class="getCode redBtn getCodeNew" href="javascript:;" target="_self">获取验证码</a> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>';
        editData.showTan(addTxtCont,'修改密码');
        // editData.getCodeTime($('.getCode'));
        editData.refreshCodeCommon();
        $('body').on('click','.getCodeNew', function () {
            var _codeCommon = $('#codeCommon').val();
            if(!regCodeCommon.test(_codeCommon)){
                $('#codeCommon').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请先输入图片中的验证码');
                return false;
            }
            //    此处写ajax,判断发送成功之后执行验证码定时器
            $.ajax({
                'url':PROJECT_DOMAIN + 'ajax/ajaxUser.php',
                'data':'do='+'getCode'+'&contact='+contact+ '&sendtype='+editPasswordType+'&usetype='+4+'&codeCommon='+_codeCommon,
                'type':'POST',
                'dataType':'jsonp',
                'success':function(data) {
                    if (data['code'] == 1) {
                        editData.getCodeTime($('.getCode'));
                    }else{
                        $('.codeNew').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*'+data.msg);
                    }
                }
            });
        });
        $('.saveBtn').unbind('click').bind('click', function () {
            var _yzmVal=$('.codeNew').val();
            var _yzmCommonVal=$('.codeCommon').val();
            if(_yzmCommonVal){
                if(_yzmVal){//输入的验证码是否合法
                    //如果输入的验证码有效则关闭弹窗
                    $.ajax({
                        'url':PROJECT_DOMAIN + '/ajax/ajaxUser.php',
                        'data':'do='+'checkCode'+'&contact='+contact+ '&usetype='+4+'&sendtype='+editPasswordType+'&code='+_yzmVal,
                        'type':'POST',
                        'dataType':'jsonp',
                        'success':function(data) {
                            if (data['code'] == 1) {
                                editData.closeEditTan();
                                var addTxtCont1='<div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>新密码：</span> <label class="labelInput yzLabelInput"> <input type="password" class="newPassword" id="newPassword" name="newPassword" placeholder="请输入新密码" value=""> </label> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>' +
                                    '<div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>确认密码：</span> <label class="labelInput yzLabelInput"> <input type="password" class="newPassword" id="againNewPassword" name="newPassword" placeholder="请再次确认密码" value=""> </label> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>';
                                editData.showTan(addTxtCont1,'修改密码');
                                //点击保存要执行的代码
                                $('.saveBtn').unbind('click').bind('click', function () {
                                    var newPassword = $("#newPassword").val();
                                    var againNewPassword = $("#againNewPassword").val();

                                    if(!newPassword){
                                        $('#newPassword').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入新密码');
                                        return;
                                    }
                                    if(!againNewPassword){
                                        $('#againNewPassword').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请再次输入新密码');
                                        return;
                                    }
                                    if(againNewPassword != newPassword){
                                        $('#againNewPassword').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*输入的密码和上次输入的新密码不符');
                                        return;
                                    }
                                    if(newPassword.length<6 || newPassword.length>16){
                                        $('#newPassword').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*密码长度为6-16位字符');
                                        return;
                                    }
                                    if(regPwNum.test(newPassword)){
                                        $('#newPassword').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*密码不能全是数字');
                                        return;
                                    }
                                    if(!regPw.test(newPassword)){
                                        $('#newPassword').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*密码不能包含特殊字符');
                                        return;
                                    }
                                    var newpwd = hex_md5(newPassword);
                                    $.ajax({
                                        'url':PROJECT_DOMAIN + 'ajax/ajaxUser.php',
                                        'data':'do='+'changePwd'+'&newpwd='+newpwd,
                                        'type':'POST',
                                        'dataType':'json',
                                        'success':function(data) {
                                            if (data['code'] == 1) {
                                                $('#oldPassword, #newPassword, #againNewPassword').removeClass('error').next().text("").hide();
                                                $('#tipsInfo').show();
                                                $('#updatePassword').unbind('click');
                                                setTimeout('location.reload()', 2000);
                                            }else{
                                                $("#oldPassword").next().text(data['msg']).show();
                                                $("#oldPassword").addClass('error');
                                            }
                                        }
                                    });
                                })
                            }else{
                                $('.codeNew').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*'+data.msg);
                            }
                        }
                    });
                }else{//验证码为空
                    $('.codeNew').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入您收到的验证码');
                }
            }else{
                $('.codeCommon').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入右侧的验证码');
            }

        });
    },
    //绑定微信
    editWeiXinBind: function (weiXinBind,weiXinBindID) {
        //判断是否已经绑定微信
        // if(weiXinBind==0){
        //     $('.weiXinEdit').find('.module-main span').text('暂无绑定账号');
        //     $('.weiXinEditBtn').removeClass('act').text('绑定');
        // }else if(weiXinBind==1){
        //     $('.weiXinEdit').find('.module-main span').text(weiXinBindID);
        //     $('.weiXinEditBtn').addClass('act').text('解绑');
        // }
        //解绑与绑定
        $('.weiXinEditBtn').unbind('click').on('click', function () {
            if($(this).hasClass('act')){
                var addTxtCont='<p class="txt">解除绑定后将不能使用该微信登录蜂鸟网，您确定要解除绑定吗？</p>';
                editData.showTan(addTxtCont,'解绑微信');
                $('.personalTan').addClass('personalTan300');
                $('.personalTan').find('.saveBtn').text('确定');
                $('.saveBtn').bind('click', function () {//点击确定解绑
                    $.ajax({
                        url:PROJECT_DOMAIN + 'ajax/ajaxUser.php',
                        type:'post',
                        data:'do='+'unBindWeiXin'+'&type='+0+'&t='+new Date().getTime(),
                        dataType:'jsonp',
                        success:function(data){
                            if(data.code == 1){
                                location.reload();
                                // weiXinBind=0;
                                // $('.weiXinEdit').find('.module-main span').text('暂无绑定账号');
                                // $('.weiXinEditBtn').removeClass('act').text('绑定');
                                // editData.closeEditTan();
                            }else{
                                alert('解绑失败');
                            }
                        }
                    });
                });
            }else{
                // weiXinBind=1;
                // weiXinBindID='newWeixin';
                // $('.weiXinEdit').find('.module-main span').text(weiXinBindID);
                // $('.weiXinEditBtn').addClass('act').text('解绑');
            }
        })
    },
    //绑定修改手机号码
    editPhone: function (phoneBind,phoneBindID) {
        //判断是否已经绑定微信
        if(phoneBind==0){
            $('.editPhone').find('.module-main span').text('暂无绑定手机号');
            $('.editPhoneBtn').removeClass('act').text('绑定');
        }else if(phoneBind==1){
            $('.editPhone').find('.module-main span').text(phoneBindID);
            $('.editPhoneBtn').addClass('act').text('修改');
        }
        $('.editPhoneBtn').unbind('click').on('click', function () {
            var _phoneOld=$('.editPhone').find('.module-main span').text();
            if($(this).hasClass('act')){//修改已绑定手机号码
                var addTxtCont='<span class="point">您已绑定的手机号码： '+_phoneOld+'</span> <div class="labelInputBox"> <span class="titleSmall"><i class="red">*</i>新手机号码：</span><label class="labelInput"> <input type="text" class="phone" name="phone" placeholder="请输入手机号码" value="" data-isUpdate="1"> </label> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div> ' +
                    '<div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>右侧验证码：</span><label class="labelInput yzLabelInput"> <input type="text" class="codeCommon" id="codeCommon" name="codeCommon" placeholder="请输入验证码" value=""> </label> <img  src="'+PROJECT_DOMAIN+'ajax/code.php" alt="" id="refreshCodeCommon"/> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>' +
                    '<div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>手机验证码：</span><label class="labelInput yzLabelInput"> <input type="text" class="codeNew" name="codeNew" placeholder="请输入验证码" value=""> </label> <a class="getCode getCodeNew redBtn" href="javascript:;" target="_self">获取验证码</a> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>';

            }else{//绑定手机号码
                var addTxtCont='<span class="point">请输入您要绑定的手机号</span> <div class="labelInputBox"> <label class="labelInput"> <input type="text" class="phone" name="phone" placeholder="请输入手机号码" value="" data-isUpdate="0"> </label> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div> ' +
                    '<div class="labelInputBox"> <label class="labelInput yzLabelInput"> <input type="text" class="codeCommon" id="codeCommon" name="codeCommon" placeholder="请输入验证码" value=""> </label> <img  src="'+PROJECT_DOMAIN+'ajax/code.php" alt="" id="refreshCodeCommon"/> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>' +
                    '<div class="labelInputBox"> <label class="labelInput yzLabelInput"> <input type="text" class="codeNew" name="codeNew" placeholder="请输入验证码" value=""> </label> <a class="getCode getCodeNew redBtn" href="javascript:;" target="_self">获取验证码</a> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>';
            }
            editData.showTan(addTxtCont,'绑定手机号');
            editData.refreshCodeCommon();

            $('.getCodeNew').unbind('click').on('click', function () {
                var _phoneNew=$('.phone').val();
                var _codeCommon = $('#codeCommon').val();
                $('.personalTan dd .labelInputBox .errorBox').hide()
                if(_phoneNew){
                    //    此处写ajax,判断发送成功之后执行验证码定时器
                    if(!regPhone.test(_phoneNew)){
                        $('.phone').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入正确的手机号');
                        return false;
                    }
                    if(!regCodeCommon.test(_codeCommon)){
                        $('#codeCommon').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请先输入图片中的验证码');
                        return false;
                    }
                    $.ajax({
                        'url':PROJECT_DOMAIN + '/ajax/ajaxUser.php',
                        'data':'do='+'getCode'+'&contact='+_phoneNew+ '&usetype='+5+'&sendtype='+1+'&codeCommon='+_codeCommon,
                        'type':'POST',
                        'dataType':'jsonp',
                        'success':function(data) {
                            if (data['code'] == 1) {
                                editData.getCodeTime($('.getCode'));
                                $('.phone').parents('.labelInput').siblings('.errorBox').hide();
                            }else{
                                $('.phone').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*'+data.msg);
                            }
                        }
                    });
                }else{
                    $('.phone').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入您要绑定的手机号');
                }

            });
            $('.saveBtn').unbind('click').bind('click', function () {
                var _phoneNew=$('.phone').val();
                var _yzmVal=$('.codeNew').val();
                var isUpdate = $('.phone').attr('data-isUpdate');
                if(_phoneNew){
                    if(!regPhone.test(_phoneNew)){
                        $('.phone').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入正确的手机号');
                        return false;
                    }
                    if(!regCode.test(_yzmVal)){//输入的验证码是否合法
                        $('.codeNew').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入正确的验证码');
                        return false;
                    }
                    //如果输入的验证码有效则关闭弹窗
                    if(isUpdate == 0){
                        var params = 'do='+'bindContact'+'&contact='+_phoneNew+ '&sendType='+1+'&code='+_yzmVal;
                    }else{
                        var params = 'do='+'bindNewContact'+'&contact='+_phoneNew+ '&sendType='+1+'&code='+_yzmVal;
                    }
                    $.ajax({
                        'url':PROJECT_DOMAIN + '/ajax/ajaxUser.php',
                        'data':params,
                        'type':'POST',
                        'dataType':'jsonp',
                        'success':function(data) {
                            if (data['code'] == 1) {
                                editData.closeEditTan();
                                $('.editPhone').find('.module-main span').text(_phoneNew);
                                $('.editPhoneBtn').addClass('act').text('修改');
                                _codeTime=_time;
                            }else{
                                $('.codeNew').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*'+data.msg);
                            }
                        }
                    });
                }else{
                    $('.phone').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入您要绑定的手机号');
                }
            });
        });
    },
    //绑定修改手机号码
    editEmail: function (emailBind,emailBindID) {
        //判断是否已经绑定微信
        if(emailBind==0){
            $('.editEmail').find('.module-main span').text('暂无绑定邮箱号');
            $('.editEmailBtn').removeClass('act').text('绑定');
        }else if(emailBind==1){
            $('.editEmail').find('.module-main span').text(emailBindID);
            $('.editEmailBtn').addClass('act').text('修改');
        }
        $('.editEmailBtn').unbind('click').on('click', function () {
            var _emailOld=$('.editEmail').find('.module-main span').text();
            if($(this).hasClass('act')){//修改已绑定手机号码
                var addTxtCont='<span class="point">您已绑定的邮箱： '+_emailOld+'</span> <div class="labelInputBox"> <label class="labelInput"> <input type="text" class="email" name="email" placeholder="请输入新邮箱地址" value="" data-isUpdate="1"> </label> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div> ' +
                    '<div class="labelInputBox"> <label class="labelInput yzLabelInput"> <input type="text" class="codeCommon" id="codeCommon" name="codeCommon" placeholder="请输入验证码" value=""> </label> <img  src="'+PROJECT_DOMAIN+'ajax/code.php" alt="" id="refreshCodeCommon"/> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>' +
                    '<div class="labelInputBox"> <label class="labelInput yzLabelInput"> <input type="text" class="codeNew" name="codeNew" placeholder="请输入邮箱验证码" value=""> </label> <a class="getCode getCodeNew redBtn" href="javascript:;" target="_self">获取邮箱验证码</a> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>';

            }else{//绑定手机号码
                var addTxtCont='<span class="point">请输入你要绑定的邮箱地址</span> <div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>新邮箱地址：</span><label class="labelInput"> <input type="text" class="email" name="email" placeholder="请输入邮箱地址" value="" data-isUpdate="0"> </label> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div> ' +
                    '<div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>右侧验证码：</span><label class="labelInput yzLabelInput"> <input type="text" class="codeCommon" id="codeCommon" name="codeCommon" placeholder="请输入验证码" value=""> </label> <img  src="'+PROJECT_DOMAIN+'ajax/code.php" alt="" id="refreshCodeCommon"/> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>' +
                    '<div class="labelInputBox"><span class="titleSmall"><i class="red">*</i>邮箱验证码：</span><label class="labelInput yzLabelInput"> <input type="text" class="codeNew" name="codeNew" placeholder="请输入邮箱验证码" value=""> </label> <a class="getCode getCodeNew redBtn" href="javascript:;" target="_self">获取邮箱验证码</a> <span class="errorBox">*蜂鸟用户名只能够修改一次</span> </div>';
            }
            editData.showTan(addTxtCont,'修改邮箱');
            editData.refreshCodeCommon();
            $('.getCodeNew').unbind('click').on('click', function () {
                var _phoneNew=$('.email').val();
                var _codeCommon = $('#codeCommon').val();
                if(_phoneNew){
                    if(!regEmail.test(_phoneNew)){
                        $('.email').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入正确的邮箱地址');
                        return false;
                    }
                    if(!regCodeCommon.test(_codeCommon)){
                        $('#codeCommon').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请先输入图片中的验证码');
                        return false;
                    }
                    //    此处写ajax,判断发送成功之后执行验证码定时器
                    $.ajax({
                        'url':PROJECT_DOMAIN + '/ajax/ajaxUser.php',
                        'data':'do='+'getCode'+'&contact='+_phoneNew+ '&usetype='+5+'&sendtype='+2+'&codeCommon='+_codeCommon,
                        'type':'POST',
                        'dataType':'jsonp',
                        'success':function(data) {
                            if (data['code'] == 1) {
                                editData.getCodeTime($('.getCode'));
                                $('.email').parents('.labelInput').siblings('.errorBox').hide();
                            }else{
                                $('.email').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*' + data.msg);
                            }
                        }
                    });
                }else{
                    $('.email').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入您要绑定的邮箱地址');
                }

            });
            $('.saveBtn').bind('click', function () {
                var _phoneNew=$('.email').val();
                var _yzmVal=$('.codeNew').val();
                var isUpdate = $('.email').attr('data-isUpdate');
                if(!regEmail.test(_phoneNew)){
                    $('.email').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入正确的邮箱地址');
                    return false;
                }
                if(!regCode.test(_yzmVal)) {//输入的验证码是否合法
                    $('.codeNew').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*请输入您收到的验证码');
                    return false;
                }
                //如果输入的验证码有效则关闭弹窗
                if(isUpdate == 0){
                    var params = 'do='+'bindContact'+'&contact='+_phoneNew+ '&sendType='+2+'&code='+_yzmVal;
                }else{
                    var params = 'do='+'bindNewContact'+'&contact='+_phoneNew+ '&sendType='+2+'&code='+_yzmVal
                }
                $.ajax({
                    'url':'/ajax/ajaxUser.php',
                    'data':params,
                    'type':'POST',
                    'dataType':'jsonp',
                    'success':function(data) {
                        if (data['code'] == 1) {
                            editData.closeEditTan();
                            $('.editEmail').find('.module-main span').text(_phoneNew);
                            $('.editEmailBtn').addClass('act').text('修改');
                            _codeTime=_time;
                        }else{
                            $('.codeNew').parents('.labelInput').siblings('.errorBox').css({display:'block'}).text('*'+data.msg);
                        }
                    }
                });
            });
        });
    },
    //获取验证码定时器，时间均为60S
    getCodeTime: function (btn) {
        btn.removeClass('getCodeNew').addClass('act');
        btn.html('<i class="timeS">'+_codeTime+'</i>s后可重发');
        _codeTimeIn=setInterval(function () {
            _codeTime--;
            if(_codeTime==0){
                clearInterval(_codeTimeIn);//修改密码倒计时结束清楚定时器
                btn.removeClass('act').addClass('getCodeNew').text('获取验证码');
                _codeTime=_time;
            }else{
                btn.find('.timeS').text(_codeTime);
            }
        },1000);
    },
    //写入弹窗
    showTan: function (tanCont,titNew,hint) {
        if(hint){//弹窗标题旁边是否显示注释
            hint='<span class="hint">仅支持JPG、PNG图片文件，且文件小于5M</span>';
        }else{
            hint='';
        }
        var tanBox='<div class="personalTanBox"> <div class="heiBg"></div> <dl class="personalTan"> <dt> <a class="personalTanClose perBg" href="javascript:;" onclick="editData.closeEditTan()" target="_self"></a> <b>'+titNew+'</b> '+hint+' </dt> <dd class=""> <div class="cont">'+tanCont+'</div> <div class="labelBoxBottom"> <a href="javascript:;" class="saveBtn redBtn" target="_self">确定</a> <a href="javascript:;" onclick="editData.closeEditTan()" class="cancelBtn whiteBtn" target="_self">取消</a> </div> </dd> </dl> </div>';
        $('body').append(tanBox);
        editData.inputFocus();
        return true;
    },
    //input
    inputFocus: function () {
        $(".labelInput input").focus(function () {
            $(this).parents('.labelInput').siblings('.errorBox').hide();
        });
        $(".labelInput input").blur(function () {

        });
    },
    //select
    selectAssembly: function (_this) {
        //$('body').on('click',box, function () {
        $('.selectOptionBox').removeClass('isShow');
        console.log(4);
        _this.find('.selectOptionBox').addClass('isShow');
        _this.find('.selectOptionBox li').click(function () {
            var _liTxt=$(this).html();
            var _liTxtVal=$(this).attr('data-value');
            //必填时打开
            //if(_liTxtVal=="0"){
            //    _this.addClass('error');
            //}else{
            //    _this.removeClass('error');
            //}
            _this.find('.selectOptionBox').removeClass('isShow');
            _this.find('.selectDefault').find('span').html(_liTxt);
            _this.find('.selectDefault').attr('data-value',_liTxtVal);
        });

    },
    //计数器
    textUpNum: function (textBox,textId,maxNum) {
        var s =$('#'+textId).val();
        if (s.length > maxNum) {
            document.getElementById(textId).value = s.substring(0, maxNum);
        }
        textBox.find('.isNum').html(s.length);
    },
    //清空定时器
    clearTimeIn: function () {
        clearInterval(_codeTimeIn);//修改密码倒计时结束清楚定时器
    },
    //点击关闭弹窗
    clickCloseTan: function (btn) {
        btn.bind('click', function () {
            editData.closeEditTan();
        });
    },
    //关闭弹窗
    closeEditTan: function () {
        editData.clearTimeIn();
        $('.swfupload').show()
        $('.personalTanBox').remove();//移除所有弹窗
        $('.personalTanBox *').unbind();//移除所有弹窗绑定事件
    },
    //省市的二级联动
    getCity:function (id, cityId) {
        $.ajax({
            type:'get',
            url: PROJECT_DOMAIN + 'ajax/ajaxRestUserInfo.php',
            data:'from='+'city'+'&id='+id+'&n='+Math.random(),
            dataType:'jsonp',
            success:function(data){
                $("#showCity").empty();
                var html = '<ul class="selectOption">';
                html += '<li data-value="0">请选择城市</li>';
                $.each(data,function(key,val){
                    html += '<li data-value="'+val['id']+'">'+val['name']+'</li>';
                });
                html += '</ul>';
                $(html).appendTo("#showCity");
            }
        });
    },
    //更新图片验证码
    refreshCodeCommon:function(){
        $('#refreshCodeCommon').unbind('click').bind('click', function(){
            var date = Math.round(new Date().getTime());
            var url = PROJECT_DOMAIN+'ajax/code.php';
            url = url + '?' + date;
            $("#refreshCodeCommon").attr('src', url);
        });
    },

    //上传图片
    uploadPic:function() {
        var settings = {
            flash_url : JS_URL + "swfupload/swfupload.swf",
            upload_url: PROJECT_DOMAIN + "user_setting/head_upload.php",	// Relative to the SWF file
            post_params: {
                "action" : "head_upload",
                "userid" : userId
            },
            file_size_limit : "5 MB",
            file_types : "*.jpg;*.png",
            file_types_description : "JPG Images; PNG Image;",
            file_upload_limit : 0,
            file_queue_limit : 1,
            custom_settings : {
                progressTarget : "fsUploadProgress",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            // button_image_url: IMG_URL + "icon-set-head-2.jpg",	// Relative to the Flash file
            button_image_url: IMG_URL + "upBtn.png",	// Relative to the Flash file
            button_width: "88",
            button_height: "24",
            button_placeholder_id: "swf-button",

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued,
            file_queue_error_handler : editData.fileQueueError_user_head,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : editData.uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : editData.uploadSuccess_user_head,
            upload_complete_handler : uploadComplete
            // queue_complete_handler : queueComplete	// Queue plugin event
        };

        swfu = new SWFUpload(settings);
    },
    //头像加载中
    uploadStart: function () {
        $('body').append('<div class="upLoading">头像加载中...</div>');
    },
    uploadSuccess_user_head:function (file, data){
        var data = eval('('+data+')');
        $('.swfupload').hide()
        if(data.status == true){
            $('.upLoading').remove()
            $('.imgLOgo').attr('src', data.pic_src);
            var addTxtCont='<div class="headImgPre"> <span class="preImg"> <img id="preview_box_180" class="imgLOgo" src="'+data.pic_src+'" width="106" height="106"> </span> <p>头像预览</p> </div><div class="fileBox">'
                +'<img src="'+data.pic_src+'" id="img_Jcrop_id">'
                +'<form name="thumbnail" action="head_upload.php" id="thumbnail" method="post" onSubmit="return false">'
                + '<input type="hidden" name="x1" value="" id="x1" />'
                + '<input type="hidden" name="y1" value="" id="y1" />'
                + '<input type="hidden" name="x2" value="" id="x2" />'
                + '<input type="hidden" name="y2" value="" id="y2" />'
                + '<input type="hidden" name="w" value="" id="w" />'
                + '<input type="hidden" name="h" value="" id="h" />'
                + '<input id="userid" type="hidden" name="userid" value="'+userId+'" />'
                + '<input type="hidden" name="time" value="" id="timefield" />'
                + '<input type="hidden" name="code" value="" id="codefield" />'
                + '<input type="hidden" name="rate" value="" id="ratefield" />'
                + '<input type="hidden" name="filename" value="" id="filenamefield" />'
                //+ '<input  type="submit" value="保存"  class="submit" name="upload_thumbnail" />'
                + '</form></div>';
            var reShowTan = editData.showTan(addTxtCont,'裁切头像');
            $('.personalTan dd').addClass('editHeadImg');
            if(reShowTan){
                if('width' == data.style){
                    $("#img_Jcrop_id").css({"width":"240px"});//定宽
                }else{
                    $("#img_Jcrop_id").css({"height":"300px"});//定高
                }
                //editData.addImagePreview(pic_src);//载入裁剪预览图
                //添加表单数据
                $("#codefield").val(data.code);
                $("#timefield").val(data.time);
                $("#ratefield").val(data.rate);
                $("#filenamefield").val(data.filename);
                editData.jcropInit();
            }
            $('.personalTan dd').addClass('editHeadImgJcrop');
            editData.savePic();
        }else{

        }
    },
    fileQueueError_user_head:function (file, errorCode, message) {
        try {
            if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
                alert('抱歉,上传次数太多');
                return;
            }
            switch (errorCode) {
                case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                    alert("抱歉，您选择的照片过大");
                    this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                    break;
                case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                    alert("不能上传空文件");
                    this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                    break;
                case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
                    alert("文件类型不符要求");
                    this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                    break;
                default:
                    if (file !== null) {
                        alert("服务器忙,请稍后再试");
                    }
                    this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
                    break;
            }
        } catch (ex) {
            this.debug(ex);
        }
    },
    addImagePreview: function (src) {
        var newImg_180 = document.createElement("img");
        newImg_180.id="crop_preview_180";

        var divPreview_180 = document.getElementById("preview_box_180");
        divPreview_180.insertBefore(newImg_180, divPreview_180.firstChild);
        if (newImg_180.filters) {
            try {
                newImg_180.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 0;
            } catch (e) {
                // If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
                newImg_180.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + 0 + ')';
            }
        } else {
            newImg_180.style.opacity = 0;
        }

        newImg_180.onload = function () {
            editData.fadeIn(newImg_180, 0);
        };
        newImg_180.src = src;
    },
    fadeIn: function(element, opacity) {
        var reduceOpacityBy = 5;
        var rate = 30;	// 15 fps


        if (opacity < 100) {
            opacity += reduceOpacityBy;
            if (opacity > 100) {
                opacity = 100;
            }

            if (element.filters) {
                try {
                    element.filters.item("DXImageTransform.Microsoft.Alpha").opacity = opacity;
                } catch (e) {
                    // If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
                    element.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + opacity + ')';
                }
            } else {
                element.style.opacity = opacity / 100;
            }
        }

        if (opacity < 100) {
            setTimeout(function () {
                editData.fadeIn(element, opacity);
            }, rate);
        }

    },
    jcropInit:function(){
        $(document).ready(function(){
            //记得放在jQuery(window).load(...)内调用，否则Jcrop无法正确初始化
            $("#img_Jcrop_id").Jcrop({
                onChange:showPreview,
                onSelect:showPreview,
                aspectRatio:1,
                minSize:[30, 30],
                maxSize:[300, 300],
                setSelect: [0,0,120,120],
                //setSelect: [0,0,20,20],
                allowSelect:false
            });
            //简单的事件处理程序，响应自onChange,onSelect事件，按照上面的Jcrop调用
            function showPreview(coords){
                if(parseInt(coords.w) > 0){
                    //计算预览区域图片缩放的比例，通过计算显示区域的宽度(与高度)与剪裁的宽度(与高度)之比得到
                    var rx = 106 / coords.w;
                    var ry = 106 / coords.h;
                    //通过比例值控制图片的样式与显示
                    $("#preview_box_180").css({
                        width:Math.round(rx * $("#img_Jcrop_id").width()) + "px",	//预览图片宽度为计算比例值与原图片宽度的乘积
                        height:Math.round(rx * $("#img_Jcrop_id").height()) + "px",	//预览图片高度为计算比例值与原图片高度的乘积
                        marginLeft:"-" + Math.round(rx * coords.x) + "px",
                        marginTop:"-" + Math.round(ry * coords.y) + "px"
                    });
                }
                $("#x1").val(coords.x);
                $("#y1").val(coords.y);
                $("#x2").val(coords.x2);
                $("#y2").val(coords.y2);
                $("#w").val(coords.w);
                $("#h").val(coords.h);
            }
        });
    },
    //保存图片
    savePic:function(){
        $('.editHeadImgJcrop').find('.saveBtn').bind('click',function(){
            $('body').append('<div class="upLoading">头像上传中...</div>');
            $('.swfupload').show()
            if($(this).parent().parent().hasClass('editHeadImgJcrop')){
                $.ajax({
                    url: PROJECT_DOMAIN + "user_setting/head_upload.php",
                    cache: false,
                    type: "POST",
                    data: ({x1 : $("#x1").val(),y1 : $("#y1").val(),x2 : $("#x2").val(),y2 : $("#y2").val(),w : $("#w").val(), h : $("#h").val(),
                        userid : $("#userid").val(),time : $("#timefield").val(),code : $("#codefield").val(),
                        rate : $("#ratefield").val(),rate : $("#ratefield").val(),filename : $("#filenamefield").val()}),
                    async:false,
                    dataType:'jsonp',
                    success: function(data){
                        if(data.status == 1){
                            location.reload();
                        }else{
                            alert(data.msg);
                        }
                    }
                });
            }else{
                alert('error');
            }
        })
    }
}