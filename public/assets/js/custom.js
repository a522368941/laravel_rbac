jQuery(document).ready(function () {

    $("#iframe").height($(window).height()-50);

    //Menu set active
    $(".sub-menu-a,.menu-a").click(function (e) {
       // $.cookie('menu-selected', $(this).data("url"), {path: '/'});
        if($(this).data("url").length>0&&$(this).data("url")!='#'){
            $("#iframe").attr('src',$(this).data("url"));
            $('.nav-list li').removeClass("active");
            $(this).parent().addClass("active");
        }
    })

    $(window).resize(function(){
        //$("#main-container").height($(window).height()-76);
        $("#iframe").height($(window).height()-50);
    });
    //console.log($.cookie('menu-selected'));
    // if ($.cookie('menu-selected') != undefined) {   //打开点击后的菜单
    //     var menuSelectedHref = $.cookie('menu-selected');
    //     var menuSelected = $(".submenu a[data-url='" + menuSelectedHref + "']");
    //     menuSelected.parents('li').addClass('active')
    //         .parents("ul.submenu").css('display', 'block')
    //         .parents(".nav-parent").addClass('open');
    // }

    $('[data-rel=tooltip]').tooltip();


    $(".show_btn").click(function () {
        $(this).hide();
        $(".widget-box").show();
        $(".page_right_style").width($(window).width()-220).css("left","220px");

    });
    $(".side_title").click(function () {
        $(".widget-box").hide();
        $(".show_btn").show();
        $(".page_right_style").width($(window).width()).css("left","0");
    });

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $("table #selectall").change(function(){
        $(this).parents('table').find('.selectall-item').prop('checked',$(this).prop('checked'));
    });




});
(function (original) {
    jQuery.fn.clone = function () {
        var result = original.apply(this, arguments),
            my_textareas = this.find('textarea').add(this.filter('textarea')),
            result_textareas = result.find('textarea').add(result.filter('textarea')),
            my_selects = this.find('select').add(this.filter('select')),
            result_selects = result.find('select').add(result.filter('select'));

        for (var i = 0, l = my_textareas.length; i < l; ++i) $(result_textareas[i]).val($(my_textareas[i]).val());
        for (var i = 0, l = my_selects.length; i < l; ++i) result_selects[i].selectedIndex = my_selects[i].selectedIndex;

        return result;
    };
}) (jQuery.fn.clone);



var $cQuery = $('.c-query')
var $more_search_is_show = $('input[name=more_search_is_show]')
$cQuery.find('.query-toggle-btn').click(function(){
    $cQuery.toggleClass('query-toggle-active')
    if($cQuery.hasClass('query-toggle-active')){
        $more_search_is_show.val(1)
    }else{
        $more_search_is_show.val(0)
    }
})


function hex_md5(s){ return binl2hex(core_md5(str2binl(s), s.length * 8));}

/*
 * Calculate the MD5 of an array of little-endian words, and a bit length
 */
function core_md5(x, len)
{
    /* append padding */
    x[len >> 5] |= 0x80 << ((len) % 32);
    x[(((len + 64) >>> 9) << 4) + 14] = len;

    var a =  1732584193;
    var b = -271733879;
    var c = -1732584194;
    var d =  271733878;

    for(var i = 0; i < x.length; i += 16)
    {
        var olda = a;
        var oldb = b;
        var oldc = c;
        var oldd = d;

        a = md5_ff(a, b, c, d, x[i+ 0], 7 , -680876936);
        d = md5_ff(d, a, b, c, x[i+ 1], 12, -389564586);
        c = md5_ff(c, d, a, b, x[i+ 2], 17,  606105819);
        b = md5_ff(b, c, d, a, x[i+ 3], 22, -1044525330);
        a = md5_ff(a, b, c, d, x[i+ 4], 7 , -176418897);
        d = md5_ff(d, a, b, c, x[i+ 5], 12,  1200080426);
        c = md5_ff(c, d, a, b, x[i+ 6], 17, -1473231341);
        b = md5_ff(b, c, d, a, x[i+ 7], 22, -45705983);
        a = md5_ff(a, b, c, d, x[i+ 8], 7 ,  1770035416);
        d = md5_ff(d, a, b, c, x[i+ 9], 12, -1958414417);
        c = md5_ff(c, d, a, b, x[i+10], 17, -42063);
        b = md5_ff(b, c, d, a, x[i+11], 22, -1990404162);
        a = md5_ff(a, b, c, d, x[i+12], 7 ,  1804603682);
        d = md5_ff(d, a, b, c, x[i+13], 12, -40341101);
        c = md5_ff(c, d, a, b, x[i+14], 17, -1502002290);
        b = md5_ff(b, c, d, a, x[i+15], 22,  1236535329);

        a = md5_gg(a, b, c, d, x[i+ 1], 5 , -165796510);
        d = md5_gg(d, a, b, c, x[i+ 6], 9 , -1069501632);
        c = md5_gg(c, d, a, b, x[i+11], 14,  643717713);
        b = md5_gg(b, c, d, a, x[i+ 0], 20, -373897302);
        a = md5_gg(a, b, c, d, x[i+ 5], 5 , -701558691);
        d = md5_gg(d, a, b, c, x[i+10], 9 ,  38016083);
        c = md5_gg(c, d, a, b, x[i+15], 14, -660478335);
        b = md5_gg(b, c, d, a, x[i+ 4], 20, -405537848);
        a = md5_gg(a, b, c, d, x[i+ 9], 5 ,  568446438);
        d = md5_gg(d, a, b, c, x[i+14], 9 , -1019803690);
        c = md5_gg(c, d, a, b, x[i+ 3], 14, -187363961);
        b = md5_gg(b, c, d, a, x[i+ 8], 20,  1163531501);
        a = md5_gg(a, b, c, d, x[i+13], 5 , -1444681467);
        d = md5_gg(d, a, b, c, x[i+ 2], 9 , -51403784);
        c = md5_gg(c, d, a, b, x[i+ 7], 14,  1735328473);
        b = md5_gg(b, c, d, a, x[i+12], 20, -1926607734);

        a = md5_hh(a, b, c, d, x[i+ 5], 4 , -378558);
        d = md5_hh(d, a, b, c, x[i+ 8], 11, -2022574463);
        c = md5_hh(c, d, a, b, x[i+11], 16,  1839030562);
        b = md5_hh(b, c, d, a, x[i+14], 23, -35309556);
        a = md5_hh(a, b, c, d, x[i+ 1], 4 , -1530992060);
        d = md5_hh(d, a, b, c, x[i+ 4], 11,  1272893353);
        c = md5_hh(c, d, a, b, x[i+ 7], 16, -155497632);
        b = md5_hh(b, c, d, a, x[i+10], 23, -1094730640);
        a = md5_hh(a, b, c, d, x[i+13], 4 ,  681279174);
        d = md5_hh(d, a, b, c, x[i+ 0], 11, -358537222);
        c = md5_hh(c, d, a, b, x[i+ 3], 16, -722521979);
        b = md5_hh(b, c, d, a, x[i+ 6], 23,  76029189);
        a = md5_hh(a, b, c, d, x[i+ 9], 4 , -640364487);
        d = md5_hh(d, a, b, c, x[i+12], 11, -421815835);
        c = md5_hh(c, d, a, b, x[i+15], 16,  530742520);
        b = md5_hh(b, c, d, a, x[i+ 2], 23, -995338651);

        a = md5_ii(a, b, c, d, x[i+ 0], 6 , -198630844);
        d = md5_ii(d, a, b, c, x[i+ 7], 10,  1126891415);
        c = md5_ii(c, d, a, b, x[i+14], 15, -1416354905);
        b = md5_ii(b, c, d, a, x[i+ 5], 21, -57434055);
        a = md5_ii(a, b, c, d, x[i+12], 6 ,  1700485571);
        d = md5_ii(d, a, b, c, x[i+ 3], 10, -1894986606);
        c = md5_ii(c, d, a, b, x[i+10], 15, -1051523);
        b = md5_ii(b, c, d, a, x[i+ 1], 21, -2054922799);
        a = md5_ii(a, b, c, d, x[i+ 8], 6 ,  1873313359);
        d = md5_ii(d, a, b, c, x[i+15], 10, -30611744);
        c = md5_ii(c, d, a, b, x[i+ 6], 15, -1560198380);
        b = md5_ii(b, c, d, a, x[i+13], 21,  1309151649);
        a = md5_ii(a, b, c, d, x[i+ 4], 6 , -145523070);
        d = md5_ii(d, a, b, c, x[i+11], 10, -1120210379);
        c = md5_ii(c, d, a, b, x[i+ 2], 15,  718787259);
        b = md5_ii(b, c, d, a, x[i+ 9], 21, -343485551);

        a = safe_add(a, olda);
        b = safe_add(b, oldb);
        c = safe_add(c, oldc);
        d = safe_add(d, oldd);
    }
    return Array(a, b, c, d);

}

/*
 * These functions implement the four basic operations the algorithm uses.
 */
function md5_cmn(q, a, b, x, s, t)
{
    return safe_add(bit_rol(safe_add(safe_add(a, q), safe_add(x, t)), s),b);
}
function md5_ff(a, b, c, d, x, s, t)
{
    return md5_cmn((b & c) | ((~b) & d), a, b, x, s, t);
}
function md5_gg(a, b, c, d, x, s, t)
{
    return md5_cmn((b & d) | (c & (~d)), a, b, x, s, t);
}
function md5_hh(a, b, c, d, x, s, t)
{
    return md5_cmn(b ^ c ^ d, a, b, x, s, t);
}
function md5_ii(a, b, c, d, x, s, t)
{
    return md5_cmn(c ^ (b | (~d)), a, b, x, s, t);
}



/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally
 * to work around bugs in some JS interpreters.
 */
function safe_add(x, y)
{
    var lsw = (x & 0xFFFF) + (y & 0xFFFF);
    var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
    return (msw << 16) | (lsw & 0xFFFF);
}

/*
 * Bitwise rotate a 32-bit number to the left.
 */
function bit_rol(num, cnt)
{
    return (num << cnt) | (num >>> (32 - cnt));
}

/*
 * Convert a string to an array of little-endian words
 * If chrsz is ASCII, characters >255 have their hi-byte silently ignored.
 */
function str2binl(str)
{
    var bin = Array();
    var mask = (1 << 8) - 1;
    for(var i = 0; i < str.length * 8; i += 8)
        bin[i>>5] |= (str.charCodeAt(i / 8) & mask) << (i%32);
    return bin;
}



/*
 * Convert an array of little-endian words to a hex string.
 */
function binl2hex(binarray)
{
    var hex_tab =  "0123456789abcdef";
    var str = "";
    for(var i = 0; i < binarray.length * 4; i++)
    {
        str += hex_tab.charAt((binarray[i>>2] >> ((i%4)*8+4)) & 0xF) +
            hex_tab.charAt((binarray[i>>2] >> ((i%4)*8  )) & 0xF);
    }
    return str;
}



function imgcode_to_url(img_code){
    var default_middle_width = 400;
    var default_small_width = 200;

    var imgs = img_code.split('|');
    var imgname = imgs[1];
    var repoCode = imgs[0];

    if(!imgname||!repoCode){
        return false;
    }

    var dw = imgname.lastIndexOf(".");
    var imgnamef = imgname.substr(0,dw);
    var extension = imgname.substring(dw+1);

    var filecode = hex_md5(imgnamef);

    var pathf = "/uploads/images/"+repoCode+"/"+filecode.substr(0,2)+"/"+filecode.substr(2,2);
    if(extension!='gif'){
        var path = pathf+"/"+imgnamef+"."+extension;
        var path_middle = pathf+"/"+imgnamef+"_"+default_middle_width+"."+extension;
        var path_small = pathf+"/"+imgnamef+"_"+default_small_width+"."+extension;
    }else{
        var path = pathf+"/"+imgnamef+"."+extension;
        var path_middle = path;
        var path_small = path;
    }

    return [path,path_middle,path_small];
}

function filecode_to_fileurl(file_code){


    var files = file_code.split('|');
    var imgname = files[1];
    var repoCode = files[0];
    var fileorgname = decodeURI(files[2]);


    if(!imgname||!repoCode){
        return false;
    }

    var dw = imgname.lastIndexOf(".");
    var imgnamef = imgname.substr(0,dw);
    var extension = imgname.substring(dw+1);

    var filecode = hex_md5(imgnamef);

    var pathf = "/uploads/attachments/"+repoCode+"/"+filecode.substr(0,2)+"/"+filecode.substr(2,2);
    var path = pathf+"/"+imgnamef+"."+extension;

    return [path,fileorgname];
}
