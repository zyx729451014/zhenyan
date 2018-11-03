/**
 * Created by demonsleep on 2018/3/27.
 */
$(function () {
    personalPublic.init()
    personalPublic.radioReset(defaultVar.radioReset);
    //personalPublic.selectAssembly('.selectBoxCity');
    //personalPublic.selectAssembly('.selectBoxArea');
    $('.selectBoxCity').unbind('click').on('click', function () {
        personalPublic.selectAssembly();
    });
    $('.selectBoxArea').unbind('click').on('click', function () {
        personalPublic.selectAssembly();
    });
})
var defaultVar={
    radioReset:'.radioReset'
}
var personalPublic={
    init:function(){
        $('body').append('<div class="bodyEnd"></div>');
        //初始化表格样式
        $('.newsList li').each(function () {
            var _index=$(this).index()
            if(_index%2==0){
                $(this).addClass('haveBg');
            }
        });
        personalPublic.followFun()
        personalPublic.cancelBtn()
        personalPublic.privateLetterF()
        personalPublic.choiceNews($('.personalMain .friendsList li'))
    },
    //点击关注按钮
    followFun: function () {
        $('.followBtn').unbind('click').bind('click', function () {
            var _btn=$(this)
            if(_btn.hasClass('act')){
                var type = 2;
            }else{
                var type = 1;
            }
            var _li = $(this).parents('li');
            var userId = _li.attr('data-userId');
            $.ajax({
                type: 'POST',
                url: projectDomin+"ajax/ajaxFollowAction.php",
                dataType: "json",
                data: 'userId=' + userId   + '&type='+type,
                success: function(data) {
                    if(data.code == 1){
                        if(_btn.hasClass('act')){
                            _btn.removeClass('act');
                            _btn.html('<i class="perBg">0</i>关注')
                        }else{
                            _btn.addClass('act');
                            _btn.html('已关注')
                        }
                    }else{
                        alert(data.msg);
                    }
                }
            });
        })
    },
    //批量取消关注
    cancelBtn: function () {
        $('.cancelFBtn').unbind('click').bind('click', function () {
            var _li=$('.personalMain .friendsList li');
            var _type = $(this).attr('data-type');
            var userIdStr='';
            if(_type == 2){
                _li.each(function () {
                    if($(this).find('.choice').hasClass('act')){
                        if($(this).find('.followBtn').hasClass('act')){
                            userIdStr += $(this).attr('data-userId') + ',';
                        }
                    }
                });
            }
            if(_type == 1){
                _li.each(function () {
                    if($(this).find('.choice').hasClass('act')){
                        if(!$(this).find('.followBtn').hasClass('act')){
                            var dataUserId = $(this).attr('data-userId');
                            if(typeof(dataUserId)  != 'undefined'){
                                userIdStr += dataUserId + ',';
                            }
                        }
                    }
                });
            }
            if(!userIdStr){
                location.reload();
                return false;
            }

            $.ajax({
                type: 'POST',
                url: projectDomin+"ajax/ajaxFollowAction.php",
                dataType: "json",
                data: 'userIdStr=' + userIdStr + '&type='+_type + '&act=guanZhuAll',
                success: function(data) {
                    if(data.code == 1){
                        location.reload();
                        // _li.each(function () {
                        //     if($(this).find('.choice').hasClass('act')){
                        //         if($(this).find('.followBtn').hasClass('act')){
                        //             $(this).find('.followBtn').removeClass('act');
                        //             $(this).find('.followBtn').html('<i class="perBg">0</i>关注')
                        //         }
                        //     }
                        // });
                    }else{
                        alert(data.msg);
                    }
                }
            });
        })
    },
    //私信
    privateLetterF: function (name,txt) {
        $('.sendLetterBtn').unbind('click').bind('click', function () {
            var _li=$(this).parents('li');
            var sendName=_li.find('.friendUser').text();//好友用户名
            console.log(sendName)
            var cont='<div class="Slist ClistName"><span class="tit1">发给：</span><a  href="#" class="defaultA">'+sendName+'</a></div>' +
                '<div class="Slist ClistLetter"><span class="tit1">详情：</span><span class="letterTxtBox"> <textarea class="letterTxt" id="letterTxt" placeholder="请输入您的私信内容"></textarea> <span class="count"><em>0</em>/300</span></span><span class="errorBox">*请输入您的私信内容~</span></div>';
            personalPublic.showTan(800,'发送私信',cont)
            $('#letterTxt').keyup(function () {//实时监测输入
                personalPublic.textUpNum($('.personalTan .ClistLetter .count'),'letterTxt',300);
            });
            $('.saveBtn').bind('click', function () {
                var _txt=$('#letterTxt').val();
                if(_txt){
                    var f_userid = _li.attr('data-userId');
                    var nickname = _li.attr('data-nickname');
                    personalPublic.sendLetter(nickname, _txt, f_userid);
                }else{
                    $('.ClistLetter').find('.errorBox').show().text('*私信内容不能为空哦~')
                }
            })
        });
    },
    //点击确认按钮发送私信
    sendLetter: function (nickname,txt, f_userid) {
        if(nickname){
            if(txt){
                $.ajax({
                    type: 'POST',
                    url: projectDomin+"ajax/ajaxMessage.php",
                    dataType: "json",
                    data: 'f_userid=' + f_userid   + '&nickname='+nickname + '&invite_content=' + txt +'&action=sendMessage',
                    success: function(data) {
                        if(data.code == 1){
                            alert("发送成功");
                        }else{
                            alert(data.msg);
                        }
                    }
                });
                personalPublic.closeTan()
            }else{
                //错误提示只修改.text里面的内容即可
                $('.ClistLetter').find('.errorBox').show().text('*私信内容不能为空哦~')
            }
        }else{
            //错误提示只修改.text里面的内容即可
            $('.ClistName').find('.errorBox').show().text('*请输入好友用户名哦~')
        }
    },
    //选择复选框
    choiceNews: function (main) {
        main.find('.choice').unbind('click').bind('click', function () {
            var that=$(this)
            if(that.hasClass('act')){
                if(that.hasClass('allChoose')){
                    main.find('.choice').removeClass('act')
                }else{
                    that.removeClass('act')
                }
            }else{
                if(that.hasClass('allChoose')){
                    main.find('.choice').removeClass('act').addClass('act')
                }else{
                    that.addClass('act');
                }

            }

        })
    },
    //写入弹窗
    showTan: function (_width,_tit,_cont,sureTxt) {
        if(!sureTxt){
            sureTxt='确定'
        }
        var tanBox='<div class="personalTanBox personalTanBoxRemove"> ' +
            '<div class="heiBg"></div> ' +
            '<dl class="personalTan personalTanTop10" style="width:'+_width+'px;margin-left:-'+_width/2+'px"> ' +
            '<dt> <a class="personalTanClose perBg" href="javascript:;" onclick="personalPublic.closeTan()" target="_self"></a> <b>'+_tit+' </b></dt> ' +
            '<dd class="cont90"> '+_cont+' ' +
            '<div class="labelBoxBottom"> ' +
            '<a href="javascript:;" class="saveBtn redBtn redBtnLong" target="_self">'+sureTxt+'</a> ' +
            '<a href="javascript:;" onclick="personalPublic.closeTan()" class="cancelBtn whiteBtn whiteBtnLong" target="_self">取消</a> ' +
            '</div> ' +
            '</dd> ' +
            '</dl> ' +
            '</div>';
        $('.bodyEnd').html(tanBox);
    },
    //关闭弹窗
    closeTan: function () {
        $('.personalTanBoxRemove').remove();
    },
    //重写单选按钮
    radioReset: function (e) {
        $(e).on('click', function () {
            if($(this).hasClass('act')){
                $(this).removeClass('act');
            }else{
                $(this).addClass('act').siblings(e).removeClass('act');
            }
        });
    },
    //select重写选择器
    selectAssembly: function () {
        var box=$(this);
        $(box).find('.selectOptionBox').show();
        $(box).find('.selectOptionBox li').unbind('click').on('click',function () {
            var _liTxt=$(this).html();
            var _liTxtVal=$(this).attr('data-value');
            if(_liTxtVal=="0"){
                $('.selectAlbumDefault').addClass('error');
            }else{
                $('.selectAlbumDefault').removeClass('error');
            }
            $(box).find('.selectDefault').find('span').html(_liTxt);
            $(box).find('.selectDefault').attr('data-value',_liTxtVal);
            console.log($(this))
            $(this).parents('.selectOptionBox').hide();
        });
    },
    //计数器
    textUpNum: function (textBox,textId,maxNum) {
        var s =$('#'+textId).val();
        if (s.length > maxNum) {
            textBox.find('em').addClass('redTxt');
            document.getElementById(textId).value = s.substring(0, maxNum);
            textBox.find('em').html(s.length);
        }else{
            textBox.find('em').removeClass('redTxt');
        }
        textBox.find('em').html(s.length);
    },
    //聚焦
    focusOn: function (inputBox) {
        inputBox.focus(function () {
            $(this).parents('.Slist').find('.errorBox').hide()
        })
    }

}