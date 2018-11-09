/**
 * Created by demonsleep on 2018/5/2.
 */
var _window=$(window);
var _ListW=$('.personalList');
var listBox=$('.personalList .listBox');
var listBoxFriends=$('.personalList .listBoxFriends');
var friendBox=$('.friendBoxSide');
var listLIBili=260/174;
var listBoxLiW;
var listBoxLiW1;
resizeList()
$(window).scroll( function() {
    //    Return to top related operations
    var _top = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
    if(_top>100){
        $('.goTop2018').css({'display':'block'});
    }else{
        $('.goTop2018').css({'display':'none'});
    }
});
_window.resize(function () {
    resizeList()
})
function resizeList(){
    var _w=_ListW.width()
    var _w1=_ListW.width()-280
    if(_w>1300){
        listBoxLiW=(_w/5)-20
        listBoxLiW1=(_w1/4)-20
    }else{
        friendBox.find('.FriendsList').addClass('overFList');
        listBoxLiW=(_w/4)-20
        listBoxLiW1=(_w1/4)-20
    }

    listBox.find('li').addClass('fadeInUp').css({width:listBoxLiW+'px'});
    friendBox.find('li').addClass('fadeInUp');
    friendBox.find('.friendMain').css({width:_w-320+'px'});
    listBox.find('li .img').css({height:listBoxLiW/listLIBili+'px'});
    friendBox.find('.friendMainMy').css({width:_w-280+'px'});
}
//切换列表
$('.personalList .headBox .listType').hover(function () {
    $(this).removeClass('noShow')
}, function () {
    $(this).addClass('noShow')
})
$(function () {
    editData.init();
})
var _time=10;//定时器时间
var _codeTime=10;//修改密码时初始的时间为60S
var _codeTimeIn;//修改密码定时器
var editData={
    //初始化
    init: function () {
        $('body').append('<div class="bodyEnd"></div>');
        editData.collectionNum()
        editData.deleteInCollect()
        editData.privateLetter()
        editData.followAction()
        $('.editCover').unbind('click').bind('click', function () {
            $('.personalTanBoxCover').show()
        })
        $('.personalHead .menu .menuLi.gradeBigBox .gradeBox').hover(function () {
            $(this).find('.gradeTan').show();
            $('.gradeTan .onNum').css({
                'margin-right':-($('.gradeTan .onNum').width()/2+6)+'px'
            })
        }, function () {
            $(this).find('.gradeTan').hide();
        })
    },
    //发送私信
    privateLetter: function () {
        $('.letterBtn').unbind('click').bind('click', function () {
            var username = $(this).attr('username');//好友用户名
            var userId =  $(this).attr('userId');
            var nickname =  $(this).attr('nickname');
            var cont='<div class="Slist ClistName"><span class="tit1">发给：</span><span class="defaultA">'+username+'</span></div>' +
                '<div class="Slist ClistLetter"><span class="tit1">详情：</span><span class="letterTxtBox"> <textarea class="letterTxt" id="letterTxt" placeholder="请输入您的私信内容"></textarea> <span class="count"><em>0</em>/300</span></span><span class="errorBox">*请输入您的私信内容~</span></div>';
            editData.showTan(560,'发送私信',cont)
            $('#letterTxt').keyup(function () {//实时监测输入
                editData.textUpNum($('.personalTan .ClistLetter .count'),'letterTxt',300);
            });
            $('.saveBtn').bind('click', function () {
                var _txt=$('#letterTxt').val();
                if(_txt){
                    if(!_txt){
                        alert("消息不能为空");
                    }
                    if(!$.trim(nickname)){
                        alert("收件人不可为空");
                    }
                    $.ajax({
                        type: 'POST',
                        url: projectDomin+"ajax/ajaxMessage.php",
                        dataType: "json",
                        data: 'f_userid=' + userId   + '&nickname='+nickname + '&invite_content=' + _txt +'&action=sendMessage',
                        success: function(data) {
                            if(data.code == 1){
                                alert("发送成功");
                                $('#letter').hide();
                            }else{
                                alert(data.msg);
                            }
                        }
                    });
                    editData.closeTan()
                }else{
                    $('.ClistLetter').find('.errorBox').show().text('*私信内容不能为空哦~')
                }
            })
        });
    },
    //收藏详情页点击删除
    deleteInCollect:function(){
        $('.deleteInBtn').unbind('click').bind('click', function () {
            var _li=$(this).parents('li');
            editData.showTan(360,'删除收藏','<div class="oneCont">您确定要删除该收藏吗？</div>')
            $('.saveBtn').bind('click', function () {
                var collectid = _li.attr('data-collectid');
                var resourceid = _li.attr('data-resourceid');
                var resourcetype = _li.attr('data-resourcetype');
                if(!collectid || !resourceid || !resourcetype){
                    alert('请选择删除内容');
                    editData.closeTan();
                    return false;
                }
                $.ajax({
                    'url':projectDomin+'ajax/ajaxCollect.php',
                    'data':'from='+'delCollect'+'&collectid='+collectid+'&resourceid='+resourceid+'&resourcetype='+resourcetype,
                    'type':'POST',
                    'dataType':'json',
                    'success':function(data) {
                        if (data['code'] == 1) {
                            _li.remove();
                        }else{
                            alert(data.msg);
                        }
                    }
                });
                editData.closeTan();
            })
        })
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
    //点击收藏
    collectionNum: function () {
        $('.collectionNum').unbind('click').bind('click', function () {
            var that=$(this);
            var _num=parseInt(that.text());

            var resourcetype = $(this).attr('data-resourcetype');//type用来区分收藏的对象 1表示收藏图片 2表示收藏相册 3表示收藏帖子
            var resourceid = $(this).attr('data-resourceid');
            if(!resourcetype || !resourceid){
                alert('未知错误');
                return false;
            }

            if(that.hasClass('act')){
                $.ajax({
                    'url':projectDomin+'ajax/ajaxCollect.php',
                    'data':'from='+'delCollect'+'&resourceid='+resourceid+'&resourcetype='+resourcetype,
                    'type':'POST',
                    'dataType':'json',
                    'success':function(data) {
                        if (data['code'] == 1) {
                            _num--
                            that.html('<i class="bBg">0</i>'+_num);
                            that.removeClass('act').attr('title','收藏');
                        }
                    }
                });
            }else{
                $.ajax({
                    'url':projectDomin+'ajax/ajaxCollect.php',
                    'data':'from='+'addCollect'+'&resourcetype='+resourcetype+'&resourceid='+resourceid,
                    'type':'POST',
                    'dataType':'json',
                    'success':function(data) {
                        if (data['code'] == 1) {
                            _num++
                            that.html('<i class="bBg">0</i>'+_num);
                            that.addClass('act').attr('title','取消收藏');
                        }
                    }
                });
            }
        })
    },
    //写入弹窗
    showTan: function (_width,_tit,_cont) {
        var tanBox='<div class="personalTanBox personalTanBoxRemove"> ' +
            '<div class="heiBg"></div> ' +
            '<dl class="personalTan" style="width:'+_width+'px;margin-left:-'+_width/2+'px"> ' +
            '<dt> <a class="personalTanClose bBg" href="javascript:;" onclick="editData.closeTan()" target="_self"></a> <b class="operateTips">'+_tit+' </b></dt> ' +
            '<dd class="cont80"> '+_cont+' ' +
            '<div class="labelBoxBottom"> ' +
            '<a href="javascript:;" class="saveBtn redBtn redBtnLong" target="_self">确定</a> ' +
            '<a href="javascript:;" onclick="editData.closeTan()" class="cancelBtn whiteBtn whiteBtnLong" target="_self">取消</a> ' +
            '</div> ' +
            '</dd> ' +
            '</dl> ' +
            '</div>';
        $('.bodyEnd').html(tanBox);
    },
    //点击关闭弹窗
    clickCloseTan: function (btn) {
        btn.bind('click', function () {
            editData.closeEditTan();
        });
    },
    closeTan: function () {
        $('.personalTanBoxRemove').remove();
    },
    //关闭弹窗
    closeEditTanCover: function () {
        $('.personalTanBoxCover').hide()
    },
    //关注ajax
    followAction:function() {
        $('.followBtn').unbind('click').bind('click', function () {
            var that=$(this)
            if(that.hasClass('act')){
                var type = 2;
            }else{
                var type = 1;
            }
            var userId = that.attr('uid');
            $.ajax({
                type: 'POST',
                url: projectDomin+"ajax/ajaxFollowAction.php",
                dataType: "json",
                data: 'userId=' + userId   + '&type='+type,
                success: function(data) {
                    if(data.code == 1){
                        if(type == 1){
                            that.attr('title', '已关注');
                            that.addClass('act').html('已关注').attr('title','取消关注');
                        }else{
                            that.attr('title', '关注');
                            that.removeClass('act').html('<i class="bBg">0</i>关注').attr('title','关注');
                        }
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });
    }
}