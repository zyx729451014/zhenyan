var third_ip_ck = '4c+F5vv0j7QuNjg0MTEzLjE1NDExMjg4NTA=';
var _tMyZClick_value= '';
var uv = '172.16.151.244';
var se = '75ecc7329227a29aa031816cbdcc809c';
FN_PV_JS_OBJ.writeck('ip_ck', '4c+F5vv0j7QuNjg0MTEzLjE1NDExMjg4NTA=',24*3650);
var protocol = window.location.protocol;
var ip_ck = FN_PV_JS_OBJ.readck('ip_ck');
var ip = uv;
var v_n = parseInt(FN_PV_JS_OBJ.readck('vn'));
if (isNaN(v_n))
    v_n = 0;
var vn = v_n;
var l_v = parseInt(FN_PV_JS_OBJ.readck('lv'));
if (isNaN(l_v))
    l_v = 0;
var lv = l_v;
if ((+new Date() / 1000) - l_v > 7200)
{
    lv = parseInt(+new Date() / 1000);
    vn++;
    FN_PV_JS_OBJ.writeck('lv', lv, 24 * 365);
    FN_PV_JS_OBJ.writeck('vn', vn, 24 * 365);
}
var flash = FN_PV_JS_OBJ.getflash();
var cs;
if (typeof (document.defaultCharset) == "string") {
    cs = document.defaultCharset;
} else if (typeof (document.characterSet) == "string") {
    cs = document.characterSet;
} else {
    cs = "unknown";
}
var ti = FN_PV_JS_OBJ.gettitle();
var sc = navigator.appName == "Netscape" ? screen.pixelDepth : screen.colorDepth;
var sr = screen.width + "x" + screen.height;
if (typeof (zol_article_content_height) == "undefined") {
    zol_article_content_height = 0;
}
if (typeof (pv_manuid) == "undefined") {
    pv_manuid = 0;
}
FN_MD5_OBJ = {
    hexcase: 0,
    b64pad: "",
    chrsz: 8,
    hex_md5: function (s) {
        return this.binl2hex(this.core_md5(this.str2binl(s), s.length * this.chrsz));
    },
    core_md5: function (x, len)
    {

        x[len >> 5] |= 0x80 << ((len) % 32);
        x[(((len + 64) >>> 9) << 4) + 14] = len;

        var a = 1732584193;
        var b = -271733879;
        var c = -1732584194;
        var d = 271733878;

        for (var i = 0; i < x.length; i += 16)
        {
            var olda = a;
            var oldb = b;
            var oldc = c;
            var oldd = d;

            a = this.md5_ff(a, b, c, d, x[i + 0], 7, -680876936);
            d = this.md5_ff(d, a, b, c, x[i + 1], 12, -389564586);
            c = this.md5_ff(c, d, a, b, x[i + 2], 17, 606105819);
            b = this.md5_ff(b, c, d, a, x[i + 3], 22, -1044525330);
            a = this.md5_ff(a, b, c, d, x[i + 4], 7, -176418897);
            d = this.md5_ff(d, a, b, c, x[i + 5], 12, 1200080426);
            c = this.md5_ff(c, d, a, b, x[i + 6], 17, -1473231341);
            b = this.md5_ff(b, c, d, a, x[i + 7], 22, -45705983);
            a = this.md5_ff(a, b, c, d, x[i + 8], 7, 1770035416);
            d = this.md5_ff(d, a, b, c, x[i + 9], 12, -1958414417);
            c = this.md5_ff(c, d, a, b, x[i + 10], 17, -42063);
            b = this.md5_ff(b, c, d, a, x[i + 11], 22, -1990404162);
            a = this.md5_ff(a, b, c, d, x[i + 12], 7, 1804603682);
            d = this.md5_ff(d, a, b, c, x[i + 13], 12, -40341101);
            c = this.md5_ff(c, d, a, b, x[i + 14], 17, -1502002290);
            b = this.md5_ff(b, c, d, a, x[i + 15], 22, 1236535329);

            a = this.md5_gg(a, b, c, d, x[i + 1], 5, -165796510);
            d = this.md5_gg(d, a, b, c, x[i + 6], 9, -1069501632);
            c = this.md5_gg(c, d, a, b, x[i + 11], 14, 643717713);
            b = this.md5_gg(b, c, d, a, x[i + 0], 20, -373897302);
            a = this.md5_gg(a, b, c, d, x[i + 5], 5, -701558691);
            d = this.md5_gg(d, a, b, c, x[i + 10], 9, 38016083);
            c = this.md5_gg(c, d, a, b, x[i + 15], 14, -660478335);
            b = this.md5_gg(b, c, d, a, x[i + 4], 20, -405537848);
            a = this.md5_gg(a, b, c, d, x[i + 9], 5, 568446438);
            d = this.md5_gg(d, a, b, c, x[i + 14], 9, -1019803690);
            c = this.md5_gg(c, d, a, b, x[i + 3], 14, -187363961);
            b = this.md5_gg(b, c, d, a, x[i + 8], 20, 1163531501);
            a = this.md5_gg(a, b, c, d, x[i + 13], 5, -1444681467);
            d = this.md5_gg(d, a, b, c, x[i + 2], 9, -51403784);
            c = this.md5_gg(c, d, a, b, x[i + 7], 14, 1735328473);
            b = this.md5_gg(b, c, d, a, x[i + 12], 20, -1926607734);

            a = this.md5_hh(a, b, c, d, x[i + 5], 4, -378558);
            d = this.md5_hh(d, a, b, c, x[i + 8], 11, -2022574463);
            c = this.md5_hh(c, d, a, b, x[i + 11], 16, 1839030562);
            b = this.md5_hh(b, c, d, a, x[i + 14], 23, -35309556);
            a = this.md5_hh(a, b, c, d, x[i + 1], 4, -1530992060);
            d = this.md5_hh(d, a, b, c, x[i + 4], 11, 1272893353);
            c = this.md5_hh(c, d, a, b, x[i + 7], 16, -155497632);
            b = this.md5_hh(b, c, d, a, x[i + 10], 23, -1094730640);
            a = this.md5_hh(a, b, c, d, x[i + 13], 4, 681279174);
            d = this.md5_hh(d, a, b, c, x[i + 0], 11, -358537222);
            c = this.md5_hh(c, d, a, b, x[i + 3], 16, -722521979);
            b = this.md5_hh(b, c, d, a, x[i + 6], 23, 76029189);
            a = this.md5_hh(a, b, c, d, x[i + 9], 4, -640364487);
            d = this.md5_hh(d, a, b, c, x[i + 12], 11, -421815835);
            c = this.md5_hh(c, d, a, b, x[i + 15], 16, 530742520);
            b = this.md5_hh(b, c, d, a, x[i + 2], 23, -995338651);

            a = this.md5_ii(a, b, c, d, x[i + 0], 6, -198630844);
            d = this.md5_ii(d, a, b, c, x[i + 7], 10, 1126891415);
            c = this.md5_ii(c, d, a, b, x[i + 14], 15, -1416354905);
            b = this.md5_ii(b, c, d, a, x[i + 5], 21, -57434055);
            a = this.md5_ii(a, b, c, d, x[i + 12], 6, 1700485571);
            d = this.md5_ii(d, a, b, c, x[i + 3], 10, -1894986606);
            c = this.md5_ii(c, d, a, b, x[i + 10], 15, -1051523);
            b = this.md5_ii(b, c, d, a, x[i + 1], 21, -2054922799);
            a = this.md5_ii(a, b, c, d, x[i + 8], 6, 1873313359);
            d = this.md5_ii(d, a, b, c, x[i + 15], 10, -30611744);
            c = this.md5_ii(c, d, a, b, x[i + 6], 15, -1560198380);
            b = this.md5_ii(b, c, d, a, x[i + 13], 21, 1309151649);
            a = this.md5_ii(a, b, c, d, x[i + 4], 6, -145523070);
            d = this.md5_ii(d, a, b, c, x[i + 11], 10, -1120210379);
            c = this.md5_ii(c, d, a, b, x[i + 2], 15, 718787259);
            b = this.md5_ii(b, c, d, a, x[i + 9], 21, -343485551);

            a = this.safe_add(a, olda);
            b = this.safe_add(b, oldb);
            c = this.safe_add(c, oldc);
            d = this.safe_add(d, oldd);
        }
        return Array(a, b, c, d);

    },
    md5_cmn: function (q, a, b, x, s, t)
    {
        return this.safe_add(this.bit_rol(this.safe_add(this.safe_add(a, q), this.safe_add(x, t)), s), b);
    },
    md5_ff: function (a, b, c, d, x, s, t)
    {
        return this.md5_cmn((b & c) | ((~b) & d), a, b, x, s, t);
    },
    md5_gg: function (a, b, c, d, x, s, t)
    {
        return this.md5_cmn((b & d) | (c & (~d)), a, b, x, s, t);
    },
    md5_hh: function (a, b, c, d, x, s, t)
    {
        return this.md5_cmn(b ^ c ^ d, a, b, x, s, t);
    },
    md5_ii: function (a, b, c, d, x, s, t)
    {
        return this.md5_cmn(c ^ (b | (~d)), a, b, x, s, t);
    },
    safe_add: function (x, y)
    {
        var lsw = (x & 0xFFFF) + (y & 0xFFFF);
        var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
        return (msw << 16) | (lsw & 0xFFFF);
    },
    bit_rol: function (num, cnt)
    {
        return (num << cnt) | (num >>> (32 - cnt));
    },
    str2binl: function (str)
    {
        var bin = Array();
        var mask = (1 << this.chrsz) - 1;
        for (var i = 0; i < str.length * this.chrsz; i += this.chrsz)
            bin[i >> 5] |= (str.charCodeAt(i / this.chrsz) & mask) << (i % 32);
        return bin;
    },
    binl2str: function (bin)
    {
        var str = "";
        var mask = (1 << this.chrsz) - 1;
        for (var i = 0; i < bin.length * 32; i += this.chrsz)
            str += String.fromCharCode((bin[i >> 5] >>> (i % 32)) & mask);
        return str;
    },
    binl2hex: function (binarray)
    {
        var hex_tab = this.hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
        var str = "";
        for (var i = 0; i < binarray.length * 4; i++)
        {
            str += hex_tab.charAt((binarray[i >> 2] >> ((i % 4) * 8 + 4)) & 0xF) +
                    hex_tab.charAt((binarray[i >> 2] >> ((i % 4) * 8)) & 0xF);
        }
        return str;
    },
    binl2b64: function (binarray)
    {
        var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
        var str = "";
        for (var i = 0; i < binarray.length * 4; i += 3)
        {
            var triplet = (((binarray[i >> 2] >> 8 * (i % 4)) & 0xFF) << 16)
                    | (((binarray[i + 1 >> 2] >> 8 * ((i + 1) % 4)) & 0xFF) << 8)
                    | ((binarray[i + 2 >> 2] >> 8 * ((i + 2) % 4)) & 0xFF);
            for (var j = 0; j < 4; j++)
            {
                if (i * 8 + j * 6 > binarray.length * 32)
                    str += this.b64pad;
                else
                    str += tab.charAt((triplet >> 6 * (3 - j)) & 0x3F);
            }
        }
        return str;
    }
}
/*
 * 肉
 */
var _final_url = document.URL;
var _final_url_s = _final_url;
if (_final_url.indexOf('#') != -1) {
    _final_url = _final_url.substr(0, _final_url.indexOf('#'));
    _final_url_s = _final_url;
}
var _flag = _final_url.indexOf("?");
if (_flag != -1) {
    _final_url = _final_url.substr(0, _flag);
}
var feClickHeat = {
    clickInfo: function (target) {
        var clickLeft = 0, _res = '';
        var _cw = document.documentElement.clientWidth;
        var _ch = document.documentElement.clientHeight;
        var _st = document.documentElement.scrollTop;
        if (_st == 0) {
            _st = document.body.scrollTop;
        }
        _obj = feClickHeat.getPosition(target);
        _res = feClickHeat.makeOutput([_obj.x, _obj.y, target.offsetWidth, target.offsetHeight, _cw, _ch, _st]);
        var text = '';
        text = target.innerHTML;
        text = text.replace(new RegExp("\n|\r", "g"), ""); // 去掉换行
        text = text.replace(new RegExp("<\/?.+?>", "g"), ""); // html2txt 去掉html标记
        text1 = text.substr(0, 72);
        text = encodeURIComponent(text1);
        if ('' == text) {
            text = target.id;
        }
        _res += '{{Z}}' + text;
        var _ztongji_click_pos_id = target.getAttribute('zdw_cposid'); // 区块位置id,页面特殊指定,不一定存在
        _res += '{{Z}}' + _ztongji_click_pos_id;

        var _target_url = target.href;
        if (typeof (_target_url) == 'undefined' || _target_url == '') {
            return;
        }
        if (_target_url.match(/^http:\/\//)) {
            var _target_url_f = _target_url;
            var _click_ckname = FN_MD5_OBJ.hex_md5(_final_url_s + _target_url_f);
            FN_PV_JS_OBJ.writeck(_click_ckname, _res, 0.025); // 来源+访问 cookie
        }
        var _click_ckname1 = FN_MD5_OBJ.hex_md5(_final_url_s);
        FN_PV_JS_OBJ.writeck(_click_ckname1, _res, 0.025); // 来源 cookie,一些301跳转会导致点击url改变,读取cookie失败
        if (_target_url.indexOf("fengniao.com") == -1 && _target_url.indexOf("http://") == 0) {
            var _text = target.innerText;
            var now = new Date().getTime();
            var datestr = escape(now * 1000 + Math.round(Math.random() * 1000));
            var _imgsrc_exit = protocol + '//linkout.fengniao.com/images/pvhit0011.gif?t=' + datestr + '&refer=' + _target_url + '&ip_ck=' + ip_ck + '&lv=' + lv + '&vn=' + vn + '&sr=' + sr + '&sc=' + sc + '&fl=' + flash + '&ti=' + _text + '&se=' + se + '&uv=' + uv + '&cv=' + _res;
            document.getElementById('fn_dot_pvm').src = _imgsrc_exit;
        }
    },
    getPosition: function (ele) {
        var x = ele.offsetLeft + (ele.currentStyle ? feClickHeat.isInt(parseInt(ele.currentStyle.borderLeftWidth)) : 0);
        var y = ele.offsetTop + (ele.currentStyle ? feClickHeat.isInt(parseInt(ele.currentStyle.borderTopWidth)) : 0);

        while (ele.offsetParent) {
            ele = ele.offsetParent;
            x += ele.offsetLeft + (ele.currentStyle ? feClickHeat.isInt(parseInt(ele.currentStyle.borderLeftWidth)) : 0);
            y += ele.offsetTop + (ele.currentStyle ? feClickHeat.isInt(parseInt(ele.currentStyle.borderTopWidth)) : 0);
        }
        return {x: x, y: y};
    },
    isInt: function (num) {
        return isNaN(num) ? 0 : num;
    },
    numFormat: function (num) {
        var _result = num.toString(16);
        _result = _result.slice(0, -1) + (parseInt(_result.slice(-1), 16) + 0x10).toString(36);
        return _result;
    },
    makeOutput: function (arr) {
        var _result = '';
        for (var i = 0, len = arr.length; i < len; i++) {
            _result += feClickHeat.numFormat(arr[i]);
        }
        return _result;
    }

}

/*
 * 灿
 */
var z_click_time = 0;
var fn_click_time = 0;
var MyFNClickFlag = '';
var ClickClose = 1; // chrome下判断是否点击关闭按钮的开关设置
FN_MYCLICK_BOJ = {
    addElement: function (domName, param) {
        var dom = document.createElement(domName);
        for (var attr in param) {
            dom.setAttribute(attr, param[attr]);
        }
        return document.body.appendChild(dom);
    },
    addEvent: function (obj, evname, fn) {
        if (obj.addEventListener) {
            obj.addEventListener(evname, fn, false);
        } else {
            obj.attachEvent('on' + evname, function () {
                fn.call(obj);
            });
        }
    },
    //获取元素的纵坐标（相对于窗口）
    getTop: function (e) {
        var offset = e.offsetTop;
        if (e.offsetParent != null)
            offset += this.getTop(e.offsetParent);
        return offset;
    },
    //获取元素的横坐标（相对于窗口）
    getLeft: function (e) {
        var offset = e.offsetLeft;
        if (e.offsetParent != null)
            offset += this.getLeft(e.offsetParent);
        return offset;
    },
    MyZClickLog: function (e) {
        var element, click_time, cur_tag, parent_tag;
        //event
        if (!e) {
            e = window.event;
        }
        //ie下记录iframe点击
        element = e.srcElement || e.target || null;
        click_time = new Date();
        //1秒之内不算点击,也起到过滤iframe作用
        if (click_time.getTime() - fn_click_time < 1000) {
            return true;
        }
        fn_click_time = click_time.getTime();
        //当前节点 与 父节点
        try {
            cur_tag = element.tagName.toLowerCase();
        } catch (e) {
            return;
        }

        if (element.parentNode.tagName) {
            parent_tag = element.parentNode.tagName.toLowerCase();
        }

        var log_flag = 0;
        //当前是a节点 或者 object 或者 embed
        if ('a' == cur_tag || 'object' == cur_tag || 'embed' == cur_tag) {
            log_flag = 1;
        } else if ('a' == parent_tag) {
            log_flag = 1;
            element = element.parentNode;
        }
        //记录所有点击事件
        if (cur_tag != 'body') {
            var current_url = _final_url_s;
            var target_url = element.href;
            var js_txt = '';
            //目标元素
            if (typeof (target_url) == 'undefined') {
                target_url = '';
            }
            if (target_url.indexOf('#') != -1) {
                target_url = target_url.substr(0, target_url.indexOf('#'));
            }
            if (element.tagName.toLowerCase() == 'a') {
                js_txt = element.innerHTML;
            }
            //广告id
            var ad_id;
            if (cur_tag == 'object') {
                ad_id = element.id;
            }
            if (typeof (ad_id) == 'undefined') {
                ad_id = '';
            }
            //标签id
            var tag_id = element.id;
            //如果标签id为空 则取父元素的id
            if (typeof (tag_id) == 'undefined' || tag_id == '') {
                tag_id = element.parentNode.id;
            }
            //约定id zdwid merchantId
            var _zdwid = element.getAttribute("zdwid");
            if (typeof (_zdwid) == 'string') {
                tag_id = _zdwid;
            }
            if (typeof (tag_id) == 'undefined') {
                tag_id = '';
            }
            var _merid = element.getAttribute("merchantId");
            if (_merid == null) {
                _merid = '';
            }
            //元素宽高
            var element_width = element.offsetWidth;
            var element_height = element.offsetHeight;

            //页面宽高
            var _cw = document.documentElement.clientWidth;
            var _ch = document.documentElement.clientHeight;

            var _st = document.documentElement.scrollTop;
            if (_st == 0) {
                _st = document.body.scrollTop;
            }

            var _left_st = document.documentElement.scrollLeft;
            if (_left_st == 0) {
                _left_st = document.body.scrollLeft;
            }

            //元素相对于窗口的top
            var element_x = FN_MYCLICK_BOJ.getLeft(element);
            var element_y = FN_MYCLICK_BOJ.getTop(element);
            element_y = element_y - _st

            //鼠标点击xy
            var mouse_x = e.clientX;
            var mouse_y = e.clientY;

            //userid
            var pv_userid;
            pv_userid = FN_PV_JS_OBJ.readck('bbuserid');

            var now = new Date().getTime();
            var datestr = escape(now * 1000 + Math.round(Math.random() * 1000));
            var pvc_imgsrc = protocol + '//pvc.fengniao.com/images/pvhit0001.gif?t=' + datestr + '&ip_ck=' + ip_ck + '&userid=' + pv_userid + '&refer=' + current_url + '&url=' + target_url + '&ad_id=' + ad_id + '&tag_id=' + tag_id + '&cw=' + _cw + '&ch=' + _ch + '&ew=' + element_width + '&eh=' + element_height + '&st=' + _st + '&js_txt=' + js_txt + '&_ex=' + element_x + '&_ey=' + element_y + '&_mx=' + mouse_x + '&_my=' + mouse_y + '&_merid=' + _merid + '&_left_st=' + _left_st;
            FN_MYCLICK_BOJ.addElement("img", {
                id: 'fn_dot_pvc_' + datestr,
                style: "display:none",
                border: 0,
                width: 1,
                height: 1,
                src: pvc_imgsrc
            });
        }
        if (log_flag) {
            ClickClose = 0;		// 点击链接时不触发关闭计数器
            feClickHeat.clickInfo(element);
            var _clink = path = '';
            _clink = element.href;
            if ('' == _clink) {
                _clink = element.data;
            }
            if (typeof (_clink) == 'undefined' || _clink == '') {
                return;
            }
            //_clink = encodeURIComponent(_clink);
            path = FN_MYCLICK_BOJ.MyZClickPath(element);
            MyFNClickFlag = path;
            if (_clink.match(/^http:\/\//)) {
                var _target_url_f = _clink;
                var _click_ckname = FN_MD5_OBJ.hex_md5(_final_url_s + _target_url_f);
                FN_PV_JS_OBJ.writeck('MyZClick_' + _click_ckname, MyFNClickFlag, 0.025);
            }
            var _click_ckname1 = FN_MD5_OBJ.hex_md5(_final_url_s);
            FN_PV_JS_OBJ.writeck('MyZClick_' + _click_ckname1, MyFNClickFlag, 0.025); // 来源 cookie,一些301跳转会导致点击url改变,读取cookie失败
        }
    },
    MyZClickPath: function (element) {
        var paths = [];
        for (; element && element.nodeType == 1; element = element.parentNode) {
            var index = 0;
            for (var sibling = element.previousSibling; sibling; sibling = sibling.previousSibling) {
                if (sibling.id == 'BAIDU_DUP_fp_wrapper') {
                    continue;
                }
                if (sibling.tagName == element.tagName) {
                    ++index;
                }
            }
            var tagName = element.tagName.toLowerCase();
            var pathIndex = (index ? "[" + (index + 1) + "]" : "");
            paths.splice(0, 0, tagName + pathIndex);
        }
        return paths.length ? "/" + paths.join("/") + "/" : null;
    }
}

function MyZClick() {

}
// 清除上一个页面的点击cookie
var _clickHeat_value = '';
var _clickHeat_text = '';
var _clickHeat_posid = '';
var _MyZClickFlag_value = '';
var _final_refer = typeof (_zpv_document_refer) == "string" ? _zpv_document_refer : document.referrer;
if (_final_refer) {
    var _final_refer_s = _final_refer;
    if (_final_refer.indexOf('#') != -1) {
        _final_refer = _final_refer.substr(0, _final_refer.indexOf('#'));
    }
    var _flag = _final_refer.indexOf("?");
    if (_flag != -1) {
        _final_refer = _final_refer.substr(0, _flag);
    }
    var _Rclick_ckname = FN_MD5_OBJ.hex_md5(_final_refer_s + _final_url_s);
    var _Rclick_ckname1 = FN_MD5_OBJ.hex_md5(_final_refer_s);
    _MyZClickFlag_value = FN_PV_JS_OBJ.readck('MyZClick_' + _Rclick_ckname);
    if (typeof (_zpv_document_refer) == "string" && _MyZClickFlag_value == "") {
        _final_refer_s = _final_url_s;
        _Rclick_ckname = FN_MD5_OBJ.hex_md5(_final_refer_s + _final_url_s);
        _MyZClickFlag_value = FN_PV_JS_OBJ.readck('MyZClick_' + _Rclick_ckname);
    }
    if (_MyZClickFlag_value == '') {
        // 读第三方cookie
        var refer_domain = FN_PV_JS_OBJ.getDomainOf(_final_refer);
        if (refer_domain && FN_PV_JS_OBJ.getDomain() != refer_domain) {
            _MyZClickFlag_value = _tMyZClick_value;
        } else {
            // 读refer名cookie
            _MyZClickFlag_value = FN_PV_JS_OBJ.readck('MyZClick_' + _Rclick_ckname1);
        }
    }
    FN_PV_JS_OBJ.deleteck('MyZClick_' + _Rclick_ckname);
    FN_PV_JS_OBJ.deleteck('MyZClick_' + _Rclick_ckname1);
    var _clickHeat_tmp = FN_PV_JS_OBJ.readck(_Rclick_ckname);
    if (_clickHeat_tmp == '') {
        var _clickHeat_tmp = FN_PV_JS_OBJ.readck(_Rclick_ckname1);
    }
    FN_PV_JS_OBJ.deleteck(_Rclick_ckname);
    FN_PV_JS_OBJ.deleteck(_Rclick_ckname1);
    if (_clickHeat_tmp != '') {
        var _clickHeat_arr = new Array();
        _clickHeat_arr = _clickHeat_tmp.split('{{Z}}');
        _clickHeat_value = _clickHeat_arr[0];
        _clickHeat_text = _clickHeat_arr[1];
        _clickHeat_posid = _clickHeat_arr[2];
    }
}

var _load_time = '';
if (window.performance != undefined) {
    var now = new Date().getTime();
    _navigationStart = window.performance.timing.navigationStart;
    _load_time = now - _navigationStart;
}

// WAP站处理
if (FN_PV_JS_OBJ.imgsrc.indexOf(protocol + '//wappv.fengniao.com/') >= 0) {
    FN_PV_JS_OBJ.imgsrc += '&ip_ck=' + ip_ck;
} else {
    FN_PV_JS_OBJ.imgsrc += '&ip_ck=' + ip_ck + '&lv=' + lv + '&vn=' + vn + '&sr=' + sr + '&sc=' + sc + '&fl=' + flash + '&ti=' + ti + '&se=' + se + '&uv=' + uv + '&cv=' + _clickHeat_value + '&zmac=' + zol_article_content_height + '&manuid=' + pv_manuid + '&ldt=' + _load_time + '&mzcv=' + _MyZClickFlag_value + '&mztext=' + _clickHeat_text + '&third_ip_ck=' + third_ip_ck + '&posid=' + _clickHeat_posid;
}

if (null == document.getElementById('fn_dot_pvm')) {
    FN_MYCLICK_BOJ.addElement("img", {
        id: 'fn_dot_pvm',
        style: "display:none",
        border: 0,
        width: 1,
        height: 1,
        src: protocol + "//pvm.fengniao.com/images/dot.gif"
    });
    FN_MYCLICK_BOJ.addElement("img", {
        style: "display:none",
        border: 0,
        width: 1,
        height: 1,
        src: FN_PV_JS_OBJ.imgsrc
    });
} else {
    var _img_document = document.createElement('img');
    _img_document.border = 0;
    _img_document.style.display = "none";
    _img_document.width = 1;
    _img_document.height = 1;
    _img_document.src = FN_PV_JS_OBJ.imgsrc;
    document.getElementsByTagName("head")[0].appendChild(_img_document);
}
FN_PT_JS_OBJ = {
    mouse_move: function (event) {
        document.body.onmousemove = '';
        if (FN_PV_JS_OBJ.imgsrc.match(protocol + '//pv.fengniao')) {
            var imgm = FN_PV_JS_OBJ.imgsrc.replace(protocol + '//pv.fengniao', protocol + '//pvm.fengniao');
            document.getElementById('fn_dot_pvm').src = imgm;
        }
    },
    before_unload: function (e) {
        var _url_tmp = document.URL;
        if (_url_tmp.match('https://')) {
            // return;
        }
        var now = new Date().getTime();
        var datestr = escape(now * 1000 + Math.round(Math.random() * 1000));
        var pv_userid;
        var pv_userid = FN_PV_JS_OBJ.readck('bbuserid');
        var _imgsrc_exit = protocol + '//linkout.fengniao.com/images/pvhit0012.gif?t=' + datestr + '&event=click_close_beforeunload&ip_ck=' + ip_ck + '&userid=' + pv_userid + '&refer=' + _final_url_s + '&lv=' + lv + '&vn=' + vn + '&sr=' + sr + '&sc=' + sc + '&fl=' + flash + '&uv=' + uv + '&third_ip_ck=' + third_ip_ck;
        if (document.all) {
            var n = window.event.screenX - window.screenLeft;
            var b = n > document.documentElement.scrollWidth - 20;
            if (b || window.event.clientY < 0 || window.event.altKey) {
                document.getElementById('fn_dot_pvm').src = _imgsrc_exit;
            }
        } else {
            if (ClickClose == 1) {
                document.getElementById('fn_dot_pvm').src = _imgsrc_exit;
            } else {
                ClickClose = 1;	// 重置开关
            }
        }
    },
    unload: function () {
        var _url_tmp = document.URL;
        if (_url_tmp.match('https://')) {
            // return;
        }
        var now = new Date().getTime();
        var datestr = escape(now * 1000 + Math.round(Math.random() * 1000));
        var pv_userid;
        var pv_userid = FN_PV_JS_OBJ.readck('bbuserid');
        var _imgsrc_exit = protocol + '//linkout.fengniao.com/images/pvhit0012.gif?t=' + datestr + '&event=click_close_unload&ip_ck=' + ip_ck + '&userid=' + pv_userid + '&refer=' + _final_url_s + '&lv=' + lv + '&vn=' + vn + '&sr=' + sr + '&sc=' + sc + '&fl=' + flash + '&uv=' + uv + '&third_ip_ck=' + third_ip_ck;
        if (document.documentElement.scrollWidth == 0) {
            document.getElementById('fn_dot_pvm').src = _imgsrc_exit;
        }
    }
}
// 鼠标事件 这块会导致服务器压力过大，注释掉
// FN_MYCLICK_BOJ.addEvent(document.body, 'mousemove', FN_PT_JS_OBJ.mouse_move);
FN_MYCLICK_BOJ.addEvent(document, 'mousedown', FN_MYCLICK_BOJ.MyZClickLog);
// 关闭事件计数
// IE浏览器
FN_MYCLICK_BOJ.addEvent(window, 'beforeunload', FN_PT_JS_OBJ.before_unload);
// 火狐浏览器
FN_MYCLICK_BOJ.addEvent(window, 'unload', FN_PT_JS_OBJ.unload);