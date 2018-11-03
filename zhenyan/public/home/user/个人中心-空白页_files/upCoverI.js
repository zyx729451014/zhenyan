/**
 * Created by demonsleep on 2018/6/26.
 */
$(function () {
    upCoverI.init();
})
var PROJECT_DOMAIN = 'https://tech.fengniao.com/';
var JS_URL = PROJECT_DOMAIN  + 'icon/js/';
var IMG_URL = PROJECT_DOMAIN  + 'icon/images/';
var upCoverI={
    init:function () {
        upCoverI.uploadPic();
    },
    //写入弹窗
    showTan: function (tanCont,titNew,hint) {
        if(hint){//弹窗标题旁边是否显示注释
            hint='<span class="hint">'+hint+'</span>';
        }else{
            hint='';
        }
        var tanBox='<div class="personalTanBox"> <div class="heiBg"></div> <dl class="personalTan"> <dt> <a class="personalTanClose bBg" href="javascript:;" onclick="upCoverI.closeEditTan()" target="_self"></a> <b>'+titNew+'</b> '+hint+' </dt> <dd class=""> <div class="cont">'+tanCont+'</div> <div class="labelBoxBottom"> <a href="javascript:;" class="saveBtn redBtn" target="_self">确定</a> <a href="javascript:;" onclick="upCoverI.closeEditTan()" class="cancelBtn whiteBtn" target="_self">取消</a> </div> </dd> </dl> </div>';
        $('body').append(tanBox);
        return true;
    },
    //点击关闭弹窗
    clickCloseTan: function (btn) {
        btn.bind('click', function () {
            editData.closeEditTan();
        });
    },
    //关闭弹窗
    closeEditTan: function () {
        // $('.swfupload').show()
        $('.personalTanBox').remove();//移除所有弹窗
        $('.personalTanBox *').unbind();//移除所有弹窗绑定事件
    },
    //上传图片
    uploadPic:function() {
        var settings = {
            flash_url : JS_URL + "swfupload/swfupload.swf",
            upload_url: PROJECT_DOMAIN + "user_setting/head_pic_upload.php",	// Relative to the SWF file
            post_params: {
                "action" : "head_pic_upload",
                "userid" : _uploadUserId
            },
            file_size_limit : "30 MB",
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
            button_image_url: "https://icon.fengniao.com/fengniaoMy/images/upBtn01.png",	// Relative to the Flash file
            button_width: "88",
            button_height: "26",
            button_placeholder_id: "swf-button",
            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued,
            file_queue_error_handler : upCoverI.fileQueueError_user_head,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : upCoverI.uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : upCoverI.uploadSuccess_user_head,
            upload_complete_handler : uploadComplete
            // queue_complete_handler : queueComplete	// Queue plugin event
        };

        swfu = new SWFUpload(settings);
    },
    //头像加载中
    uploadStart: function () {
        $('body').append('<div class="upLoading">图片加载中...</div>');
    },
    uploadSuccess_user_head:function (file, data){
        var data = eval('('+data+')');
        if(data.status == true){
            // $('.swfupload').hide();
            $('.upLoading').remove()
            $('.imgLOgo').attr('src', data.pic_src);
            var addTxtCont='<div class="headImgPre"> <span class="preImg"> <img id="preview_box_180" class="imgLOgo" src="'+data.pic_src+'" width="400" height="50"> </span> <p>封面预览</p> </div><div class="fileBox">'
                +'<img src="'+data.pic_src+'" id="img_Jcrop_id">'
                +'<form name="thumbnail" action="head_upload.php" id="thumbnail" method="post" onSubmit="return false">'
                + '<input type="hidden" name="x1" value="" id="x1" />'
                + '<input type="hidden" name="y1" value="" id="y1" />'
                + '<input type="hidden" name="x2" value="" id="x2" />'
                + '<input type="hidden" name="y2" value="" id="y2" />'
                + '<input type="hidden" name="w" value="" id="w" />'
                + '<input type="hidden" name="h" value="" id="h" />'
                + '<input id="userid" type="hidden" name="userid" value="'+_uploadUserId+'" />'
                + '<input type="hidden" name="time" value="" id="timefield" />'
                + '<input type="hidden" name="code" value="" id="codefield" />'
                + '<input type="hidden" name="rate" value="" id="ratefield" />'
                + '<input type="hidden" name="filename" value="" id="filenamefield" />'
                + '</form></div>';
            var reShowTan = upCoverI.showTan(addTxtCont,'上传封面','个人主页封面大图，建议尺寸：2560px*320px，图片大小30M以内');
            $('.personalTan').addClass('editCoverImg');
            if(reShowTan){
                if('width' == data.style){
                    $("#img_Jcrop_id").css({"width":"320px"});//定宽
                }else{
                    $("#img_Jcrop_id").css({"height":"300px"});//定高
                }
                //upCoverI.addImagePreview(pic_src);//载入裁剪预览图
                //添加表单数据
                $("#codefield").val(data.code);
                $("#timefield").val(data.time);
                $("#ratefield").val(data.rate);
                $("#filenamefield").val(data.filename);
                upCoverI.jcropInit();
            }
            $('.personalTan dd').addClass('editHeadImgJcrop');
            upCoverI.savePic();
        }else{
            $('.upLoading').remove();
            alert(data.tips);
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
            upCoverI.fadeIn(newImg_180, 0);
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
                upCoverI.fadeIn(element, opacity);
            }, rate);
        }

    },
    jcropInit:function(){
        $(document).ready(function(){
            //记得放在jQuery(window).load(...)内调用，否则Jcrop无法正确初始化
            $("#img_Jcrop_id").Jcrop({
                onChange:showPreview,
                onSelect:showPreview,
                aspectRatio:8,
                minSize:[30, 30],
                maxSize:[320, 300],
                setSelect: [0,0,120,120],
                //setSelect: [0,0,20,20],
                allowSelect:false
            });
            //简单的事件处理程序，响应自onChange,onSelect事件，按照上面的Jcrop调用
            function showPreview(coords){
                if(parseInt(coords.w) > 0){
                    //计算预览区域图片缩放的比例，通过计算显示区域的宽度(与高度)与剪裁的宽度(与高度)之比得到
                    var rx = 320 / coords.w;
                    var ry = 40 / coords.h;
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
            $('body').append('<div class="upLoading">封面上传中...</div>');
            // $('.swfupload').show()
            if($(this).parent().parent().hasClass('editHeadImgJcrop')){
                $.ajax({
                    url: PROJECT_DOMAIN + "user_setting/head_pic_upload.php",
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
                            alert(data.tips);
                        }
                    }
                });
            }else{
                alert('error');
            }
        })
    }
}