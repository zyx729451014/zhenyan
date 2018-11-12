$(function () {
    $.fn.initOne("bbusername");
    JPlaceHolder.init()
});
var JPlaceHolder = {
    _check: function () {
        return "placeholder" in document.createElement("input")
    }, init: function () {
        if (document.all) {
            $('input[type="text"]').each(function () {
                var b = this;
                if (this.attachEvent) {
                    this.attachEvent("onpropertychange", function (a) {
                        if (a.propertyName != "value") {
                            return
                        }
                        $(b).trigger("input")
                    })
                }
            })
        }
        if (!this._check()) {
            this.fix()
        }
    }, fix: function () {
        jQuery(":input[placeholder]").each(function (m, n) {
            var p = $(this), j = p.attr("placeholder");
            p.wrap($("<div></div>").css({
                position: "relative",
                zoom: "1",
                border: "none",
                background: "none",
                padding: "none",
                margin: "none"
            }));
            var k = p.position(), l = p.outerHeight(true), h = p.css("padding-left");
            var o = $("<span></span>").text(j).css({
                position: "absolute",
                left: k.left,
                top: k.top,
                height: l,
                lienHeight: l,
                paddingLeft: h,
                color: "#aaa"
            }).appendTo(p.parent());
            p.focusin(function (a) {
                o.hide()
            }).focusout(function (a) {
                if (!p.val()) {
                    o.show()
                }
            });
            o.click(function (a) {
                o.hide();
                p.focus()
            })
        })
    }
};
(function (Q) {
    var O;
    var x = Q("#captcha-box");
    var y = "https://my.fengniao.com";
    var E = 300;
    var A;
    var M;
    var S;
    var K;
    var N;
    var z = 60;
    var R = 60;
    var I = 0;
    var B = Q(".loginNewBox");
    var G = Q(".logonList");
    var P = window.location.href;
    var D = Q(".userName5").val();
    var C = Q(".password").val();
    var J = Q(".phone").val();
    var F = Q(".phoneCode").val();
    var codeCommon='';
    var keySecond;
    var keySecond1;
    var L = '<div class="loginShareBox"><a href="javascript:;" target="_self" class="weiXin loginIcon toLoginErweima01">微信登录</a> <a href="https://my.fengniao.com/loginThirdParty.php?id=1&url=' + P + '" target="_self"  class="weiBo loginIcon">微博登录</a><a href="https://my.fengniao.com/loginThirdParty.php?id=3&url=' + P + '" target="_self" class="qqLogin loginIcon">qq登录</a> </div>';
    var H = '<span class="global-weclome-tip">您好，</span><ul id="globaSitePersonNav" class="global-sitenav J_globalSitenav"><li class="global-item"><span class="trigger user-name" id="user-name">' + O + '<i class="triangle-icon"></i></span><div class="dropdown-items" style="display: none;"><ul class="global-site-items"><li class="global-site-item"><a href="https://my.fengniao.com/">个人中心</a></li><li class="global-site-item"><a href="https://my.fengniao.com/album.php">我的相册</a></li><li class="global-site-item"><a href="https://my.fengniao.com/thread.php">我的论坛</a></li><li class="global-site-item"><a href="https://my.fengniao.com/friend.php">我的好友</a></li><li class="global-site-item"><a href="https://my.fengniao.com/photoCollection.php">我的收藏</a></li><li class="global-site-item"><a href="http://huodong.fengniao.com/my">我的活动</a></li><li class="global-site-item"><a href="http://2.fengniao.com/user/index">我的二手</a></li><li class="global-site-item"><a href="https://my.fengniao.com/myOrder.php">我的严选</a></li></ul></div></li><li class="global-item" id="xiaoxi_num"><span class="global-num" style="display:none" id="global-num"><i class="global-icon"></i></span><span class="trigger" id="xiaoxi_nums">提醒<i class="triangle-icon"></i></span><div class="dropdown-items" style="display: none;"><ul class="global-site-items"><li class="global-site-item"><a href="https://my.fengniao.com/messages.php" class="priv">我的私信<em id="priy"></em></a></li><li class="global-site-item"><a href="https://my.fengniao.com/messages.php?type=2" class="reply">论坛回复<em id="reply"></em></a></li><li class="global-site-item"><a href="https://my.fengniao.com/messages.php?type=3" class="station">全站通知<em id="station"></em></a></li><li class="global-site-item"><a href="https://my.fengniao.com/messages.php?type=4" class="pm">系统消息<em id="pm"></em></a></li><li class="global-site-item"><a href="https://my.fengniao.com/messages.php?type=5" class="integral">积分提醒<em id="integral"></em></a></li><li class="global-site-item"><a href="https://my.fengniao.com/messages.php?type=6" class="integral">金币记录</a></li></ul></div></li></ul><a href="javascript:;" id="logout" class="global-login-out" target="_self">退出</a>';
    var T = {
        TanBox: ".loginTanBox",
        Box: ".loginNewBox",
        List: ".logonList",
        hintWord: ".hintWord",
        picErWeiM: ".picErWeiM",
        loginBtnChange: ".loginBtnChange",
        changeTxtUl: '<ul class="loginBtnChange isPc"> <li class="pcIcon">切换至账号登录</li> <li class="erweimaIcon">切换至二维码登录</li> </ul>',
        loginErWeiMBox: '<div class="loginErWeiM logonList"> <b class="tit">微信扫码  安全登录</b> <span class="picErWeiM"> <img src="https://icon.fengniao.com/login/images/erweima001.png" width="222" height="222"> </span> <p>请打开微信  扫一扫登录</p> <a href="javascript:;" target="_self" class="refreshBtn"><i class="loginIcon">刷新</i>刷新二维码</a> <a href="javascript:;" target="_self" class="changeTxtBtn toRegister">注册新账号</a> </div>',
        loginNumBox: '<div class="loginNum logonList"> <h4 class="titLineBox"> <hr> <b class="txt">推荐使用<a class="toLoginErweima01" href="javascript:;" target="_self"><i class="loginIcon">0</i>微信扫码</a>  登录 , 安全快捷</b> </h4> <a href="javascript:;" target="_self" class="markTit toLoginPhone">短信快速登录</a> <ul class="labelBox"> <li> <input type="text" class="userName userName2 userName5" name="userName" value="手机号/用户名/邮箱"> <div class="hintWord">用户名长度为2-14位字符或1-7个汉字</div> </li> <li> <input type="password" class="password password2" name="password"  placeholder="" value=""> <div class="hintWord"></div> </li> <li class="txtBox"> <a  href="javascript:;" target="_self" class="forgetPassW">忘记密码？</a> <input type="checkbox" value="" id="isRemember"> <label for="isRemember">记住我</label> </li> <li class="submitBtnBox"> <input type="submit" class="loginSubmitBtn loginBtn01" value="登录"> </li> </ul> <h4 class="titLineBox"> <hr> <b class="txt">第三方登录</b> </h4> ' + L + ' <a href="javascript:;" target="_self" class="changeTxtBtn toRegister">注册新账号</a> </div>',
        loginPhoneBox: '<div class="loginPhone logonList"> <h4 class="titLineBox"> <hr> <b class="txt">推荐使用<a class="toLoginErweima01" href="javascript:;" target="_self"><i class="loginIcon">0</i>微信扫码</a>  登录 , 安全快捷</b> </h4> <a href="javascript:;" target="_self" class="markTit toLoginNum">账号密码登录</a> <ul class="labelBox"> <li> <input type="text" class="phone phone2" name="phone" value="请输入大陆手机号"> <div class="hintWord">用户名长度为2-14位字符或1-7个汉字</div> </li> <li class="phoneCodeLi"> <a href="javascript:;" target="_self" data-id="3" class="getPhoneCode">获取验证码</a> <input type="text" class="phoneCode" name="phoneCode" value="请输入短信验证码"> <div class="hintWord"></div> </li> <li class="txtBox"> 注意：如果您已注册过蜂鸟账号，请确认该手机号和账号做了绑定，否则系统将自动创建新账号 </li> <li class="submitBtnBox"> <input type="submit" class="loginSubmitPhoneBtn loginBtn01" value="登录"> </li> </ul> <h4 class="titLineBox"> <hr> <b class="txt">第三方登录</b> </h4> ' + L + ' <a href="javascript:;" target="_self" class="changeTxtBtn toRegister">注册新账号</a> <input name="onlycode" id="onlycode" type="hidden" value="" class="text"></div>',
        loginRegisterBox: '<div class="loginRegister logonList"> <h4 class="titLineBox"> <hr><b class="txt">快速注册</b> </h4> <ul class="labelBox"> <li> <input type="text" class="userName userName5 userName1" name="userName" value="请输入用户名"> <div class="hintWord">用户名长度为2-14位字符或1-7个汉字</div> </li> <li> <input type="password" class="password password1" name="password" placeholder="" value=""> <div class="hintWord"></div> </li> <li> <input type="text" class="phone phone1" name="phone" value="请输入大陆手机号"> <div class="hintWord">用户名长度为2-14位字符或1-7个汉字</div> </li> <li class="phoneCodeLi"> <a href="javascript:;" target="_self" class="getPhoneCode" data-id="1">获取验证码</a> <input type="text" class="phoneCode" name="phoneCode" value="请输入短信验证码"> <div class="hintWord"></div> </li> <li class="txtBox isAgreeTxtBtn"> <input type="checkbox" value="" id="isAgree"> <label for="isAgree">我已阅读并同意 <a href="http://www.fengniao.com/law.html" target="_blank">《蜂鸟用户注册协议》</a> </label><div class="hintWord"></div> </li> <li class="submitBtnBox"> <input type="submit" class="registerSubmitBtn registerSubmitBtnNo loginBtn01" value="注册"> </li> </ul> <span class="isHaveToLogin">已有账号？返回 <a href="javascript:;" target="_self">登录</a></span> </div>',
        loginForget: '<div class="loginForget logonList"><h4 class=titLineBox><hr><b class=txt>找回密码</b></h4><ul class=labelBox id=forgetFirst><li><input type=text class=text-long id=name value="请输入已绑定的手机号或邮箱"><div class=hintWord>请输入已绑定的手机号或邮箱</div><li class=phoneCodeLi><img src=' + y + '/ajax/code.php?sdklfdlsf id=refreshCode><input type=text class=duanCode id=code value="请输入右侧验证码"><a href="javascript:;" target="_self" id=changeCode>换一张</a><div class=hintWord></div><li class=submitBtnBox><input type=submit class=loginBtn01 id=forgetFirstBtn value="下一步"><li class=rightTxt><a href="javascript:;" target="_self" id="noGetPhoneEmail">手机或邮箱不可用了？</a></ul><ul class=labelBox id=forgetSecond><li><span class=numberUser>18810827876</span><a href="javascript:;" target=_self class=reWriteNumber>修改</a><li class="phoneCodeLi"><a href="javascript:;" target=_self class="getCode getForgetCode">获取验证码</a><input type=text class=duanCode id=secondCode value="请输入验证码"><div class=hintWord>请输入已绑定的手机号或邮箱</div><li class=submitBtnBox><input type=submit class=loginBtn01 id=forgetSecondBtn value="下一步"><li class=rightTxt><a  href="javascript:;" target="_self"  id="noGetPhoneEmail">手机或邮箱不可用了？</a></ul><ul class=labelBox id=forgetThird><li><input type=password class=text-long id=password placeholder="" value=""><div class=hintWord>请您输入新密码</div><li><input type=password class=text-long id=checkpassword placeholder="" value=""><div class=hintWord>请确认新密码</div><li class=submitBtnBox><input type=submit class=loginBtn01 id=forgetThirdBtn value="重置密码"></ul><span style="cursor: pointer;" class="changeTxtBtn toLogin02">已有账号？返回 <a  href="javascript:;" target="_self" style="color: #ff4b4b;">登录</a></span></div>',
        loginForgetSuccess: '<div class="loginForgetSuccess logonList"><div class=tanTxtIn><span class=loginIcon>0</span><div class=txt01><b>新密码设置成功！</b><span class=red>登录成功</span><span><i class=numSecond>5</i>s后自动登录</span></div></div></div>',
        loginForgetCannot: '<div class="loginForgetCannot logonList"><div class=tanTxtIn><div class="txt01 txtCenter"><span>请联系客服找回密码，或重新注册蜂鸟账号。邮箱 shao.xinmei@fengniao.com</span></div></div><span style="cursor: pointer;" class="changeTxtBtn toLogin02">已有账号？返回 <a  href="javascript:;" target="_self" style="color: #ff4b4b;">登录</a></span></div>'
    };
    Q.fn.extend({
        initOne: function (a) {
            Q.fn.removejscssfile("https://icon.fengniao.com/public/js/public_header.js?2", "js");
            jQuery.getScript("https://static.geetest.com/static/tools/gt.js");
            jQuery.getScript("https://my.fengniao.com/icon/js/md5.js");
            jQuery.getScript("https://my.fengniao.com/icon/js/jquery.cookie.js", function () {
                Q.fn.cleatTime();
                var c = Q.fn.topReadCookie(a);
                if (c) {
                    Q.fn.successLogin(c);
                    Q("#globaSitePersonNav li").hover(function () {
                        Q(this).find(".dropdown-items").show()
                    }, function () {
                        Q(this).find(".dropdown-items").hide()
                    })
                } else {
                    Q("#xiding").html('<ul class="login-box"><li><a href="javascript:;" class="login-link" target="_self"><i class="icon"></i>登录</a></li><li><a href="javascript:;" target="_self" class="registerBtn">免费注册</a></li></ul>');
                    Q(".login-link").showMode("login");
                    Q(".registerBtn").showMode("reg")
                }
                Q(document).on("click", ".isGuoQi", function () {
                    Q(this).attr("src", "https://icon.fengniao.com/login/images/erweima001.png");
                    Q.fn.getErWeiMa()
                });
                Q(document).on("click", ".refreshBtn", function () {
                    Q.fn.getErWeiMa()
                });
                Q(document).on("click", ".isErrorEr", function () {
                    Q.fn.getErWeiMa()
                });
                Q('body').append('<input name="onlycode" id="onlycode" type="hidden" value="" class="text">');
                Q("#weChatBox li").hover(function () {
                    Q(this).find(".QR-code").show()
                }, function () {
                    Q(this).find(".QR-code").hide()
                });
                Q("#globaSiteNav li").hover(function () {
                    Q(this).addClass("hover");
                    Q(this).find(".dropdown-items").show()
                }, function () {
                    Q(this).removeClass("hover");
                    Q(this).find(".dropdown-items").hide()
                });
                b();
                Q(window).scroll(function () {
                    b()
                });
                function b() {
                    if (Q(document).scrollTop() > 0) {
                        Q(".global-topnav").css("position", "fixed")
                    } else {
                        Q(".global-topnav").css("position", "relative")
                    }
                }
            })
        }, showMode: function (c) {
            var b = Q.extend({}, T);
            var a;
            Q.fn.cleatTime();
            this.bind("click", function () {
                if (I == 0) {
                    Q("<link>").attr({
                        rel: "stylesheet",
                        type: "text/css",
                        href: "https://icon.fengniao.com/login/css/loginCss.v1.2.css"
                    }).appendTo("head");
                    Q('body').append('<div class="loginTanBox"><div class="loginBlack"></div><div class="loginNewBox"><div class="loginHeader"> <span class="close loginIcon">0</span> <h3 class="logo1 loginIcon">0</h3> </div></div></div>');
                    I = 1
                }
                switch (c) {
                    case"login":
                        a = 1;
                        Q(b.Box).append(b.loginNumBox);
                        Q(b.Box).append(b.changeTxtUl);
                        //Q.fn.getErWeiMa();
                        break;
                    case"reg":
                        Q(b.Box).append(b.loginRegisterBox);
                        Q(b.Box).append(b.changeTxtUl);
                        Q(".loginBtnChange").hide();
                        a = 2;
                        break
                }
                Q(document).on("click", ".forgetPassW", function () {
                    Q(b.List).remove();
                    Q(b.Box).append(b.loginForget)
                });
                Q.fn.focusBlur(".userName2", "手机号/用户名/邮箱");
                Q.fn.focusBlur(".userName1", "请输入用户名");
                Q.fn.focusBlur(".phone1", "请输入大陆手机号");
                Q.fn.focusBlur(".phone2", "请输入大陆手机号");
                Q.fn.focusBlur(".phoneCode", "请输入短信验证码");
                Q.fn.focusBlur("#name", "请输入已绑定的手机号或邮箱");
                Q.fn.focusBlur("#code", "请输入右侧验证码");
                Q.fn.focusBlur("#secondCode", "请输入验证码");
                Q.fn.focusBlurPass(".password1", "password01.png");
                Q.fn.focusBlurPass(".password2", "password01.png");
                Q.fn.focusBlurPass("#password", "password02.png");
                Q.fn.focusBlurPass("#checkpassword", "password03.png");
                Q(document).on("click", ".loginNewBox .loginHeader .close", function () {
                    Q.fn.closeBox()
                });
                Q(document).on("click", ".loginSubmitBtn", function () {
                    Q.fn.toLogin()
                });
                Q.fn.changeLoginType(".toLogin02", b.loginNumBox, 4);
                Q(document).on("click", ".loginSubmitPhoneBtn", function () {
                    Q.fn.toMessageLogin()
                });
                Q(document).on("click", ".loginBtnChange", function () {
                    Q.fn.changeBtnType()
                });
                Q(document).on("click", ".registerSubmitBtn", function () {
                    Q.fn.registerLogin()
                });
                Q(document).on("click", ".reWriteNumber", function () {
                    Q.fn.forgetPassBackOne()
                });
                Q(document).on("click", "#isAgree", function () {
                    var e = Q(this).parents("li");
                    if (Q(this).hasClass("isAgreeTxtBtnYes")) {
                        Q(this).removeAttr("checked");
                        Q(this).removeClass("isAgreeTxtBtnYes");
                        e.addClass("warnTxt");
                        Q(".loginNewBox .loginRegister").find(".registerSubmitBtn").addClass("registerSubmitBtnNo")
                    } else {
                        Q(this).attr("checked", "checked");
                        Q(this).addClass("isAgreeTxtBtnYes");
                        e.removeClass("warnTxt");
                        e.find(T.hintWord).hide();
                        Q(".loginNewBox .loginRegister").find(".registerSubmitBtn").removeClass("registerSubmitBtnNo")
                    }
                });
                Q.fn.changeLoginType(".toRegister", b.loginRegisterBox, 2);
                Q.fn.changeLoginType(".toLoginPhone", b.loginPhoneBox,5);
                Q.fn.changeLoginType(".toLoginNum", b.loginNumBox);
                Q.fn.changeLoginType(".isHaveToLogin", b.loginNumBox,4);
                Q.fn.changeLoginType(".toLoginErweima01", b.loginErWeiMBox, 1);
                Q.fn.changeLoginType(".forgetPassW", b.loginForget, 3);
                Q(document).on("input propertychange change", ".phone1", Q.fn.phoneTime);
                Q(document).on("input propertychange change", ".phone2", Q.fn.phoneTime);
                var d = function (g) {
                    var e;
                    var h = Q.fn.hintWord;
                    g.appendTo(x);
                    g.onSuccess(function () {
                        var i = g.getValidate();
                        Q.ajax({
                            url: y + "/ajax/SecondVerify.php?keySecond="+keySecond,
                            type: "get",
                            dataType: "jsonp",
                            data: {
                                type: "login",
                                geetest_challenge: i.geetest_challenge,
                                geetest_validate: i.geetest_validate,
                                geetest_seccode: i.geetest_seccode
                            },
                            success: function (k) {
                                if (k.status === "success") {
                                    keySecond1= k.keySecond
                                    Q("#onlycode").val(k.onlycode);
                                    var j = Q(".getPhoneCode");
                                    j.addClass("sendBtnTime");
                                    j.addClass("sendBtnAfterIs");
                                    j.removeClass("sendBtnAfter");
                                    z = 60;
                                    j.html(z + "s");
                                    var l = setInterval(function () {
                                        if (z == 0) {
                                            var m = Q(".phone").val();
                                            if (m == "") {
                                                j.html("获取验证码")
                                            } else {
                                                if (!Q.fn.isPhoneNo(m)) {
                                                    j.addClass("sendBtnNo");
                                                    j.removeClass("sendBtnAfter");
                                                    j.removeClass("sendBtnAfterIs")
                                                } else {
                                                    j.removeClass("sendBtnNo");
                                                    j.addClass("sendBtnAfter")
                                                }
                                            }
                                            j.removeClass("sendBtnTime");
                                            j.html("获取验证码");
                                            clearInterval(l);
                                            z = R
                                        } else {
                                            z--;
                                            j.html(z + "s")
                                        }
                                    }, 1000);
                                    Q.fn.getSendCode(e)
                                } else {
                                    return false
                                }
                            }
                        })
                    });
                    Q(document).on("click", ".getPhoneCode", f);
                    function f() {
                        var j = Q.extend({}, T);
                        var i = Q(".getPhoneCode");
                        var k = Q(".phone").val();
                        var l = j.hintWord;
                        e = parseInt(i.attr("data-id"));
                        if (k) {
                            if (i.hasClass("sendBtnAfter")) {
                                g.show()
                            } else {
                                if (i.hasClass("sendBtnNo")) {
                                    Q(".phone").siblings(l).show().html("*请输入正确手机号码").show()
                                } else {
                                    if (i.hasClass("sendBtnTime")) {
                                        alert("稍等片刻哦~")
                                    } else {
                                        Q(".phone").siblings(l).show().html("*请输入手机号码").show()
                                    }
                                }
                            }
                        } else {
                            Q(".phone").siblings(l).show().html("*请输入手机号码").show()
                        }
                    }
                };
                Q.ajax({
                    url: y + "/ajax/StartCaptchaServlet.php?type=login&t=" + (new Date()).getTime(),
                    type: "get",
                    dataType: "jsonp",
                    jsonpCallback: "dataBox",
                    success: function (e) {
                        keySecond= e.keySecond
                        initGeetest({gt: e.gt, challenge: e.challenge, product: "popup", offline: !e.success}, d)
                    }
                });
                Q(document).on("click", ".hintWord", Q.fn.hintWord)
            })
        }, getErWeiMa: function (d) {
            var b = Q.extend({}, T);
            var a = "";
            var c = Q(b.picErWeiM);
            c.find("img").removeClass("isGuoQi");
            Q.ajax({
                url: y + "/ajax/wechatLoginQrcode.php",
                type: "post",
                data: {type: 1},
                dataType: "jsonp",
                success: function (f) {
                    if (f.code == 1) {
                        a = f.data.ticket;
                        c.find("img").attr("src", f.data.qrcode_url);
                        var e = 0;
                        A = setInterval(function () {
                            e++;
                            if (e == E) {
                                Q.fn.cleatTime();
                                c.find("img").attr("src", "https://icon.fengniao.com/login/images/erweima002.jpg");
                                c.find("img").addClass("isGuoQi");
                                Q.fn.cleatTime()
                            }
                        }, 1000);
                        M = setInterval(function () {
                            Q.ajax({
                                url: y + "/ajax/wechatLoginQrcode.php",
                                type: "post",
                                data: {type: 2, ticket: a},
                                dataType: "jsonp",
                                success: function (g) {
                                    if (g.code == 1) {
                                        Q.fn.successLogin(g.bbusername)
                                    } else {
                                    }
                                },
                                cache: false
                            })
                        }, 2000)
                    } else {
                        if (f.code == -1) {
                            Q.fn.cleatTime();
                            c.find("img").attr("src", "https://icon.fengniao.com/login/images/erweima003.jpg");
                            c.find("img").addClass("isErrorEr")
                        }
                    }
                },
                cache: false
            });
            return false
        }, toLogin: function () {
            Q.fn.checkInputDefaultVal();
            var b = Q(".userName2");
            var c = Q(".password");
            var a = Q.fn.hintWord;
            if (D) {
                if (C) {
                    Q.ajax({
                        url: y + "/ajax/ajaxLogin.php",
                        data: "from=login&name=" + D + "&password=" + hex_md5(C),
                        type: "POST",
                        dataType: "jsonp",
                        jsonpCallback: "dataBox",
                        success: function (d) {
                            if (d.code == 1) {
                                Q.fn.successLogin(D)
                            } else {
                                if (d.code == -1) {
                                    b.siblings(a).show().html("*" + d.msg)
                                } else {
                                    if (d.code == -2) {
                                        c.siblings(a).show().html("*" + d.msg)
                                    } else {
                                        if (d.code == -3) {
                                            b.siblings(a).show().html("*" + d.msg)
                                        } else {
                                            if (d.code == -6) {
                                                b.siblings(a).show().html("*" + d.msg)
                                            } else {
                                                if (d.code == -7) {
                                                    c.siblings(a).show().html("*您输入的密码有误");
                                                    c.val("")
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        cache: false
                    })
                } else {
                    c.siblings(a).show().text("*请您输入密码")
                }
            } else {
                b.siblings(a).show().text("*请您输入手机/用户名/邮箱")
            }
        }, toMessageLogin: function () {
            var b = Q.extend({}, T);
            J = Q(".phone").val();
            F = Q(".phoneCode").val();
            var a = b.hintWord;
            if (J) {
                if (F) {
                    if (/^1\d{10}$/m.test(J)) {
                        if (/^\d{6}$/m.test(F)) {
                            Q.ajax({
                                url: y + "/ajax/ajaxRegister.php",
                                data: "from=phoneLogin&phone=" + J + "&code=" + F,
                                type: "POST",
                                dataType: "jsonp",
                                success: function (c) {
                                    if (c.code == 1 || c.code == 2) {
                                        Q.fn.successLogin(J)
                                    } else {
                                        if (c.code == -1 || c.code == -4) {
                                            Q(".phoneCode").siblings(a).show().html("*" + c.msg)
                                        } else {
                                            if (c.code == -2) {
                                                Q(".phoneCode").siblings(a).show().html("*动态密码不可为空")
                                            } else {
                                                if (c.code == -13 || c.code == -14) {
                                                    Q(".phoneCode").siblings(a).show().html("*动态密码错误");
                                                    Q(".phoneCode").val("")
                                                } else {
                                                    if (c.code == -7 || c.code == -3 || c.code == -10) {
                                                        Q(".phone").siblings(a).show().html("*" + c.msg)
                                                    }
                                                }
                                            }
                                        }
                                    }
                                },
                                cache: false
                            })
                        } else {
                            Q(".phoneCode").siblings(a).show().html("*动态密码错误");
                            Q(".phoneCode").val("")
                        }
                    } else {
                        Q(".phone").siblings(a).show().html("*请输入正确的手机号码")
                    }
                } else {
                    Q(".phoneCode").siblings(a).show().html("*请输入正确的验证码")
                }
            } else {
                Q(".phone").siblings(a).show().html("*请输入手机号")
            }
        }, registerLogin: function () {
            Q.fn.cleatTime();
            var c = Q.extend({}, T);
            var d = Q(".isAgreeTxtBtn");
            var b = Q(".registerSubmitBtn");
            if (b.hasClass("registerSubmitBtnNo")) {
                d.addClass("warnTxt");
                d.find(c.hintWord).show().html("*请先查看并同意蜂鸟注册协议")
            } else {
                var a = c.hintWord;
                Q.fn.checkInputDefaultVal();
                D = Q.trim(D);
                if (D) {
                    if (C) {
                        if (C.length >= 6 && C.length <= 16) {
                            if (/^[0-9a-zA-Z!@#$%^&*()_+|?\/-=]{6,16}$/m.test(C)) {
                                if (!/^[0-9]{6,16}$/m.test(C)) {
                                    if (J) {
                                        if (F) {
                                            Q.ajax({
                                                url: y + "/ajax/ajaxRegister.php",
                                                data: "from=registerPhone&username=" + D + "&password=" + hex_md5(C) + "&phone=" + J + "&code=" + F,
                                                type: "POST",
                                                dataType: "jsonp",
                                                contentType: "application/x-www-form-urlencoded; charset=utf-8",
                                                success: function (e) {
                                                    if (e.code == 1) {
                                                        Q.fn.successLogin(encodeURI(D))
                                                    } else {
                                                        if (e.code == -1) {
                                                            Q(".userName1").siblings(a).show().html("*" + e.msg)
                                                        } else {
                                                            if (e.code == -2) {
                                                                Q(".password").siblings(a).show().html("*" + e.msg)
                                                            } else {
                                                                if (e.code == -3) {
                                                                    Q(".phone").siblings(a).show().html("*" + e.msg)
                                                                } else {
                                                                    if (e.code == -4) {
                                                                        Q(".phoneCode").siblings(a).show().html("*" + e.msg)
                                                                    } else {
                                                                        if (e.code == -5) {
                                                                            Q(".userName1").siblings(a).show().html("*" + e.msg)
                                                                        } else {
                                                                            if (e.code == -6) {
                                                                                Q(".userName1").siblings(a).show().html("*" + e.msg)
                                                                            } else {
                                                                                if (e.code == -7) {
                                                                                    Q(".userName1").siblings(a).show().html("*" + e.msg)
                                                                                } else {
                                                                                    if (e.code == -8) {
                                                                                        Q(".userName1").siblings(a).show().html("*" + e.msg)
                                                                                    } else {
                                                                                        if (e.code == -9) {
                                                                                            Q(".userName1").siblings(a).show().html("*" + e.msg)
                                                                                        } else {
                                                                                            if (e.code == -10) {
                                                                                                Q(".userName1").siblings(a).show().html("*" + e.msg)
                                                                                            } else {
                                                                                                if (e.code == -11) {
                                                                                                    Q(".phone").siblings(a).show().html("*" + e.msg)
                                                                                                } else {
                                                                                                    if (e.code == -12) {
                                                                                                        Q(".phone").siblings(a).show().html("*" + e.msg)
                                                                                                    } else {
                                                                                                        if (e.code == -13) {
                                                                                                            Q(".phoneCode").siblings(a).show().html("*" + e.msg)
                                                                                                        } else {
                                                                                                            if (e.code == -14) {
                                                                                                                Q(".phoneCode").siblings(a).show().html("*" + e.msg)
                                                                                                            } else {
                                                                                                                if (e.code == -16) {
                                                                                                                    Q(".phone").siblings(a).show().html("*" + e.msg)
                                                                                                                } else {
                                                                                                                    if (e.code == -15) {
                                                                                                                        Q(".phone").siblings(a).show().html("*" + e.msg)
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                },
                                                cache: false
                                            })
                                        } else {
                                            Q(".phoneCode").siblings(a).show().html("*请输入验证码")
                                        }
                                    } else {
                                        Q(".phone").siblings(a).show().html("*请输入手机号")
                                    }
                                } else {
                                    Q(".password").siblings(a).show().html("*密码不能为纯数字")
                                }
                            } else {
                                Q(".password").siblings(a).show().html("*密码不能包含特殊字符")
                            }
                        } else {
                            Q(".password").siblings(a).show().html("*密码长度为6-16位字符")
                        }
                    } else {
                        Q(".password").siblings(a).show().html("*请输入密码")
                    }
                } else {
                    Q(".userName1").siblings(a).show().html("*请输入用户名")
                }
            }
        }, checkInputDefaultVal: function () {
            D = Q(".userName5").val();
            C = Q(".password").val();
            J = Q(".phone").val();
            F = Q(".phoneCode").val();
            if (D == "手机号/用户名/邮箱") {
                D = ""
            } else {
                if (D == "请输入用户名") {
                    D = ""
                } else {
                    D = encodeURI(Q(".userName5").val())
                }
            }
            if (C == "请输入密码") {
                C = ""
            }
            if (J == "请输入大陆手机号") {
                J = ""
            }
            if (F == "请输入短信验证码") {
                F = ""
            }
        }, forgetPass: function () {
            var b = Q.extend({}, T);
            N = Q("#name").val();
            var a = Q("#code").val();
            if (N == "请输入已绑定的手机号或邮箱") {
                N = ""
            }
            if (a == "请输入右侧验证码") {
                a = ""
            }
            if (N) {
                if (a) {
                    Q.ajax({
                        url: y + "/ajax/ajaxRegister.php",
                        data: "from=resetOne&name=" + N + "&code=" + a,
                        dataType: "jsonp",
                        type: "POST",
                        success: function (c) {
                            if (c.code == 1) {
                                $name = N;
                                $type = c.content.type;
                                if ($type == 1) {
                                    Q(".getForgetCode").text("获取短信验证码")
                                } else {
                                    Q(".getForgetCode").text("获取邮件验证码")
                                }
                                codeCommon = a;
                                Q(".numberUser").text(N);
                                Q("#forgetFirst").hide();
                                Q("#forgetSecond").show()
                            } else {
                                if (c.code == -1) {
                                    Q("#code").parents("li").find(b.hintWord).show().html("*" + c.msg);
                                    Q("#code").val("");
                                    Q.fn.refreshCode()
                                } else {
                                    Q("#name").parents("li").find(b.hintWord).show().html("*" + c.msg);
                                    Q.fn.refreshCode()
                                }
                            }
                        },
                        cache: false
                    })
                } else {
                    Q("#code").parents("li").find(b.hintWord).show().html("*请填写右侧验证码");
                    Q("#code").val("")
                }
            } else {
                Q("#name").parents("li").find(b.hintWord).show().html("*请填写您的手机号或者邮箱")
            }
        }, forgetPassTwo: function () {
            var b = Q.extend({}, T);
            var a = Q("#secondCode").val();
            if (a) {
                Q.ajax({
                    url: y + "/ajax/ajaxRegister.php",
                    data: "from=resetTwo&type=" + $type + "&contact=" + $name + "&code=" + a,
                    type: "POST",
                    dataType: "jsonp",
                    success: function (c) {
                        console.log(c);
                        if (c.code == 1) {
                            Q("#forgetSecond").hide();
                            Q("#forgetThird").show()
                        } else {
                            Q("#secondCode").parents("li").find(b.hintWord).show().html("*" + c.msg)
                        }
                    },
                    cache: false
                })
            } else {
                Q("#secondCode").parents("li").find(b.hintWord).show().html("*请输入验证码")
            }
        }, forgetPassBackOne: function () {
            Q.fn.refreshCode();
            Q.fn.cleatTime();
            Q(".getForgetCode").removeClass("sendBtnNo");
            Q(".getForgetCode").removeClass("sendBtnAfterIs");
            Q("#forgetSecond").hide();
            Q("#forgetFirst").show();
            Q("#name").focus();
            Q("#code").val("请输入右侧验证码")
        }, forgetPassThree: function () {
            var c = Q.extend({}, T);
            var b = Q("#password").val();
            var d = Q("#secondCode").val();
            var a = Q("#checkpassword").val();
            if (b) {
                if (b.length >= 6 && b.length <= 16) {
                    if (/^[0-9a-zA-Z!@#$%^&*()_+|?/\-=]{6,16}$/m.test(b)) {
                        if (!/^[0-9]{6,16}$/m.test(b)) {
                            if (a) {
                                if (b == a) {
                                    Q.fn.cleatTime();
                                    Q("#checkpassword").parents("li").find(c.hintWord).hide();
                                    Q.ajax({
                                        url: y + "/ajax/ajaxRegister.php",
                                        data: "from=resetThree&type=" + $type + "&contact=" + $name + "&code=" + d + "&password=" + hex_md5(b),
                                        type: "POST",
                                        dataType: "jsonp",
                                        success: function (e) {
                                            if (e.code == 1) {
                                                Q(c.List).remove();
                                                Q(c.Box).append(c.loginForgetSuccess);
                                                O = $name.substring(0, 10);
                                                Q("#xiding").html(H);
                                                Q("#user-name").html(O);
                                                var f = 5;
                                                K = setInterval(function () {
                                                    f--;
                                                    if (f == 0) {
                                                        Q.fn.cleatTime();
                                                        Q.fn.successLogin(N)
                                                    } else {
                                                        Q(".numSecond").html(f)
                                                    }
                                                }, 1000)
                                            } else {
                                                Q("#password").parents("li").find(c.hintWord).show().html("*" + e.msg)
                                            }
                                        },
                                        cache: false
                                    })
                                } else {
                                    Q("#checkpassword").parents("li").find(c.hintWord).show().html("*您输入的密码与确认密码不一致")
                                }
                            } else {
                                Q("#checkpassword").parents("li").find(c.hintWord).show().html("*请您输入确认密码")
                            }
                        } else {
                            Q("#password").parents("li").find(c.hintWord).show().html("*密码不能为纯数字")
                        }
                    } else {
                        Q("#password").parents("li").find(c.hintWord).show().html("*密码不能包含特殊字符")
                    }
                } else {
                    Q("#password").parents("li").find(c.hintWord).show().html("*密码长度为6-16位字符")
                }
            } else {
                Q("#password").parents("li").find(c.hintWord).show().html("*请您输入密码")
            }
        }, forgetPassGetCode: function () {
            var c = Q.extend({}, T);
            var b = Q(".getForgetCode");
            var a = b.text();
            Q(".getForgetCode").text("正在发送..");
            b.unbind("click");
            Q.ajax({
                url: y + "/ajax/ajaxUser.php",
                data: "do=getCode&contact=" + $name + "&usetype=" + 2 + "&sendtype=" + $type+ '&codeCommon=' + codeCommon,
                type: "POST",
                dataType: "jsonp",
                success: function (d) {
                    if (d.code == 1) {
                        b.addClass("sendBtnNo");
                        b.addClass("sendBtnAfterIs");
                        Q("#secondCode").parents("li").find(c.hintWord).hide();
                        Q.fn.countDownTime(b, 60, a)
                    } else {
                        if (d.code == -4) {
                            b.addClass("sendBtnNo");
                            b.addClass("sendBtnAfterIs");
                            Q.fn.countDownTime(b, 60, a);
                            Q(".getForgetCode").html("操作过于频繁");
                            Q("#secondCode").parents("li").find(c.hintWord).show().html("*" + d.msg)
                        } else {
                            if (d.code == -3) {
                                b.addClass("sendBtnNo");
                                Q(".getForgetCode").html("超过7次");
                                Q("#secondCode").parents("li").find(c.hintWord).show().html("*此号验证码超过7次,请明天再试")
                            } else {
                                Q("#secondCode").parents("li").find(c.hintWord).show().html("*" + d.msg)
                            }
                        }
                    }
                    b.unbind("click")
                },
                cache: false
            })
        }, refreshCode: function () {
            var b = Math.round(new Date().getTime());
            var a = y + "/ajax/code.php";
            a = a + "?" + b;
            Q("#refreshCode").attr("src", a)
        }, changeBtnType: function (b) {
            var c = Q(".loginBtnChange");
            var d = Q.extend({}, T);
            var a = Q(this);
            Q.fn.cleatTime();
            if (c.hasClass("isPc")) {
                c.removeClass("isPc").addClass("isErweima");
                Q(d.List).remove();
                Q(d.Box).append(d.loginErWeiMBox);
                Q.fn.getErWeiMa()
            } else {
                Q.fn.cleatTime();
                c.removeClass("isErweima").addClass("isPc");
                Q(d.List).remove();
                Q(d.Box).append(d.loginNumBox)
            }
        }, changeLoginType: function (b, c, a) {
            var d = Q.extend({}, T);
            Q(document).on("click", b, function () {
                Q.fn.cleatTime();
                Q(d.List).remove();
                Q(d.Box).append(c);
                switch (a) {
                    case 1:
                        Q.fn.getErWeiMa();
                        Q(d.loginBtnChange).removeClass("isPc").addClass("isErweima").show();
                        break;
                    case 2:
                        Q(d.loginBtnChange).removeClass("isPc").addClass("isErweima").hide();
                        break;
                    case 3:
                        Q(d.loginBtnChange).removeClass("isPc").addClass("isErweima").hide();
                        Q(document).on("click", "#forgetFirstBtn", function () {
                            Q.fn.forgetPass()
                        });
                        Q(document).on("click", "#refreshCode", function () {
                            Q.fn.refreshCode()
                        });
                        Q(document).on("click", "#changeCode", function () {
                            Q.fn.refreshCode()
                        });
                        Q(document).on("click", "#forgetSecondBtn", function () {
                            Q.fn.forgetPassTwo()
                        });
                        Q(document).on("click", ".getForgetCode", function () {
                            if (Q(this).hasClass("sendBtnNo")) {
                            } else {
                                Q.fn.forgetPassGetCode()
                            }
                        });
                        Q.fn.changeLoginType("#noGetPhoneEmail", d.loginForgetCannot, 2);
                        Q(document).on("click", "#forgetThirdBtn", function () {
                            Q.fn.forgetPassThree()
                        });
                        break;
                    case 4:
                        Q.fn.cleatTime();
                        Q(d.loginBtnChange).show();
                        Q(".numberUser").html("");
                        Q("#code").val("");
                        Q("#name").val("");
                        Q(d.loginBtnChange).removeClass("isErweima").addClass("isPc").show();
                        break;
                    case 5:
                        Q.fn.cleatTime();
                        Q(d.loginBtnChange).show();
                        Q(".numberUser").html("");
                        Q("#code").val("");
                        Q("#name").val("");
                        Q(d.loginBtnChange).removeClass("isPc").addClass("isErweima").show();
                        break;
                    default:
                        Q.fn.cleatTime();
                        Q(d.loginBtnChange).show();
                        Q(".numberUser").html("");
                        Q("#code").val("");
                        Q("#name").val("");
                        break
                }
            })
        }, focusBlurPass: function (a, b) {
            var c = Q.extend({}, T);
            Q(document).on("focus", a, function () {
                var d = Q(this).val();
                Q(this).css("background-image", "none");
                Q(a).siblings(c.hintWord).hide()
            });
            Q(document).on("blur", a, function () {
                var d = Q(this).val();
                if (d) {
                    Q(this).css("background-image", "none")
                } else {
                    Q(this).css("background", "url(https://icon.fengniao.com/login/images/" + b + ") no-repeat 11px center")
                }
                if (a == ".password1") {
                    Q.fn.checkPassword(a)
                }
            })
        }, focusBlur: function (a, b) {
            var c = Q.extend({}, T);
            Q(document).on("focus", a, function () {
                var d = Q(this).val();
                Q(this).addClass("focus");
                if (d == b) {
                    Q(this).val("")
                }
                Q(a).siblings(c.hintWord).hide()
            });
            Q(document).on("blur", a, function () {
                var d = Q(this).val();
                Q(this).removeClass("focus");
                if (d == "") {
                    Q(this).val(b)
                }
                switch (a) {
                    case".userName1":
                        if (Q(a).val() == "请输入用户名") {
                            Q(a).siblings(T.hintWord).show().text("*请输入用户名")
                        } else {
                            Q.fn.checkUsername()
                        }
                        break;
                    case".phone1":
                        if (!Q.fn.isPhoneNo(d)) {
                            Q(a).siblings(T.hintWord).show().text("*请输入正确的手机号码")
                        }
                        break;
                    case".userName2":
                        console.log(Q(a).val().length);
                        if (Q(a).val() == "手机号/用户名/邮箱") {
                            Q(a).siblings(T.hintWord).show().text("*请输入手机号/用户名/邮箱")
                        }
                        break;
                    case"#name":
                        console.log(Q(a).val().length);
                        if (Q(a).val() == "手机号/用户名/邮箱") {
                            Q(a).siblings(T.hintWord).show().text("*请输入手机号/用户名/邮箱")
                        }
                        break
                }
            })
        }, checkUsername: function () {
            var c = Q(".userName1");
            var b = encodeURI(c.val());
            var a = Q.fn.hintWord;
            b = Q.trim(b);
            if (b) {
                Q.ajax({
                    url: y + "/ajax/ajaxRegister.php",
                    data: "from=checkUsername&username=" + b,
                    type: "POST",
                    dataType: "jsonp",
                    success: function (d) {
                        if (d.code == 1) {
                            c.siblings(a).show().text("")
                        } else {
                            c.siblings(a).show().text("*" + d.msg)
                        }
                    },
                    cache: false
                })
            } else {
                c.siblings(a).show().text("*请输入用户名")
            }
        }, checkPassword: function (c) {
            var c = Q(c).val();
            var b = Q(".password1");
            var a = Q.fn.hintWord;
            if (c) {
                if (c.length >= 6 && c.length <= 16) {
                    if (/^[0-9a-zA-Z!@#$%^&*()_+|?\/-=]{6,16}$/m.test(c)) {
                        if (!/^[0-9]{6,16}$/m.test(c)) {
                            b.siblings(a).hide()
                        } else {
                            b.siblings(a).show().text("*密码不能为纯数字")
                        }
                    } else {
                        b.siblings(a).show().text("*密码不能包含特殊字符")
                    }
                } else {
                    b.siblings(a).show().text("*密码长度为6-16位字符")
                }
            } else {
                b.siblings(a).show().text("*请您输入密码")
            }
        }, getSendCode: function (b) {
            J = Q(".phone").val();
            F = Q(".phoneCode").val();
            var a = Q("#onlycode").val();
            Q.ajax({
                url: y + "/ajax/getCode.php?keySecond="+keySecond1,
                type: "get",
                dataType: "jsonp",
                data: {onlycode: a, phone: J, usetype: b, sendtype: 1},
                success: function (c) {
                    if (c.code == 1) {
                        Q(".phone").siblings(T.hintWord).hide()
                    } else {
                        Q(".phone").siblings(T.hintWord).show().html("*" + c.msg)
                    }
                }
            })
        }, isPhoneNo: function (b) {
            var a = /^1[34578]\d{9}$/;
            return a.test(b)
        }, phoneTime: function () {
            var c = Q(this).val();
            var a = Q(this);
            var b = Q(".getPhoneCode");
            if (c == "") {
                b.removeClass("sendBtnAfter");
                b.removeClass("sendBtnNo")
            } else {
                if (!Q.fn.isPhoneNo(c)) {
                    if (b.hasClass("sendBtnAfterIs")) {
                        Q(this).siblings(T.hintWord).show().text("*请倒计时结束后再点击获取验证码")
                    } else {
                        Q(this).siblings(T.hintWord).show().text("*请输入正确的手机号码");
                        b.addClass("sendBtnNo");
                        b.removeClass("sendBtnAfter")
                    }
                } else {
                    Q(this).siblings(T.hintWord).hide();
                    if (!b.hasClass("sendBtnAfterIs")) {
                        b.removeClass("sendBtnNo");
                        b.addClass("sendBtnAfter")
                    }
                }
            }
        }, countDownTime: function (a, b, c) {
            z = b;
            S = setInterval(function () {
                if (z == 0) {
                    a.removeClass("sendBtnNo");
                    a.removeClass("sendBtnAfterIs");
                    a.html(c);
                    clearInterval(S)
                } else {
                    z--;
                    a.html(z + "s")
                }
            }, 1000)
        }, getNewsNumber: function () {
            Q.ajax({
                url: y + "/ajax/ajaxNotice.php?callback=jQuery171012816668872340653_1520991468998&_=1520991469066",
                data: "",
                type: "POST",
                dataType: "jsonp",
                success: function (c) {
                    var a = c.priv + c.reply + c.station + c.pm + c.integration;
                    if (a > 0) {
                        Q("#global-num").show().text(a)
                    }
                    b(Q(".priv"), c.priv);
                    b(Q(".reply"), c.reply);
                    b(Q(".station"), c.station);
                    b(Q(".pm"), c.pm);
                    b(Q(".integral"), c.integration);
                    function b(e, d) {
                        if (d > 0) {
                            e.find("em").html("(" + d + ")")
                        }
                    }
                },
                cache: false
            })
        }, hintWord: function () {
            var a = Q(this).parents("li");
            Q(this).hide();
            a.find("input").focus()
        }, removejscssfile: function (d, c) {
            var f = (c == "js") ? "script" : (c == "css") ? "link" : "none";
            var e = (c == "js") ? "src" : (c == "css") ? "href" : "none";
            var b = document.getElementsByTagName(f);
            for (var a = b.length; a >= 0; a--) {
                if (b[a] && b[a].getAttribute(e) != null && b[a].getAttribute(e).indexOf(d) != -1) {
                    b[a].parentNode.removeChild(b[a])
                }
            }
        }, loadjscssfile: function (c, a) {
            if (a == "js") {
                var b = document.createElement("script");
                b.setAttribute("type", "text/javascript");
                b.setAttribute("src", c)
            } else {
                if (a == "css") {
                    var b = document.createElement("link");
                    b.setAttribute("rel", "stylesheet");
                    b.setAttribute("type", "text/css");
                    b.setAttribute("href", c)
                }
            }
            if (typeof b != "undefined") {
                document.getElementsByTagName("head")[0].appendChild(b)
            }
        }, successLogin: function (a) {
            O = Q.fn.topReadCookie("bbusername").substring(0, 10);
            Q("#xiding").html(H);
            Q("#user-name").html(O + '<i class="triangle-icon"></i>');
            Q("#logout").attr("href", "https://my.fengniao.com/login.php?action=logout&url=" + P);
            Q.fn.getNewsNumber();
            Q.fn.closeBox();
            Q.fn.cleatTime()
        }, closeBox: function (b) {
            var a = Q.extend({}, T);
            I = 0;
            Q(a.TanBox).remove();
            Q.fn.removejscssfile("https://icon.fengniao.com/login/css/loginCss.v1.2.css", "css");
            Q.fn.removejscssfile("https://static.geetest.com/static/tools/gt.js", "js");
            Q.fn.removejscssfile("https://my.fengniao.com/icon/js/md5.js", "js");
            Q.fn.removejscssfile("https://my.fengniao.com/icon/js/jquery.cookie.js", "js");
            Q.fn.cleatTime();
            Q(document).unbind('click');
            Q("#globaSitePersonNav li").hover(function () {
                Q(this).addClass("hover");
                Q(this).find(".dropdown-items").show()
            }, function () {
                Q(this).removeClass("hover");
                Q(this).find(".dropdown-items").hide()
            })
        }, loginOut: function () {
            Q.fn.deleteCookie("bbusername");
            Q.fn.deleteCookie("bbpassword");
            Q.fn.deleteCookie("bbuserid");
            location.reload();
            Q("#logout").attr("href", "https://my.fengniao.com/login.php?action=logout&url=" + P);
            Q("#xiding").html('<ul class="login-box"><li><a href="javascript:;" target="_self" class="login-link"><i class="icon"></i>登录</a></li><li><a href="javascript:;" target="_self" class="registerBtn">免费注册</a></li></ul>')
        }, topSetCookie: function (a, b, c) {
            Q.cookie(a, b, {expires: c, path: "/"})
        }, topReadCookie: function (b) {
            var a = "";
            var d = b + "=";
            if (document.cookie.length > 0) {
                offset = document.cookie.indexOf(d);
                if (offset != -1) {
                    offset += d.length;
                    end = document.cookie.indexOf(";", offset);
                    if (end == -1) {
                        end = document.cookie.length
                    }
                    var c = document.cookie.substring(offset, end);
                    a = decodeURIComponent(c.replace(/\+/g, " "))
                }
            }
            return a
        }, deleteCookie: function (a) {
            Q.cookie(a, null, {expires: -1, path: "/"})
        }, cleatTime: function () {
            z = 0;
            clearInterval(S);
            clearInterval(A);
            clearInterval(M);
            clearInterval(K)
        }
    })
})(jQuery);