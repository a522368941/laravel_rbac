// .doc     application/msword
// .docx   application/vnd.openxmlformats-officedocument.wordprocessingml.document
// .rtf       application/rtf
// .xls     application/vnd.ms-excel application/x-excel
// .xlsx    application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
// .ppt     application/vnd.ms-powerpoint
// .pptx    application/vnd.openxmlformats-officedocument.presentationml.presentation
// .pps     application/vnd.ms-powerpoint
// .ppsx   application/vnd.openxmlformats-officedocument.presentationml.slideshow
// .pdf     application/pdf
// .swf    application/x-shockwave-flash
// .dll      application/x-msdownload
// .exe    application/octet-stream
// .msi    application/octet-stream
// .chm    application/octet-stream
// .cab    application/octet-stream
// .ocx    application/octet-stream
// .rar     application/x-rar-compressed
// .tar     application/x-tar
// .tgz    application/x-compressed
// .zip    application/x-zip-compressed
// .z       application/x-compress
// .wav   audio/wav
// .wma   audio/x-ms-wma
// .wmv   video/x-ms-wmv
// .mp3 .mp2 .mpe .mpeg .mpg     audio/mpeg
// .rm     application/vnd.rn-realmedia
// .mid .midi .rmi     audio/mid
// .bmp     image/bmp
// .gif     image/gif
// .png    image/png
// .tif .tiff    image/tiff
// .jpe .jpeg .jpg     image/jpeg
// .txt      text/plain
// .xml     text/xml
// .html     text/html
// .css      text/css
// .js        text/javascript
// .mht .mhtml   message/rfc822

function doAttachUpload($list, pick,imgids,maxnum,upurl,sub_file_name,accept) {
    if($(imgids).val()){
        var imgidsArr = $(imgids).val().split(",");

        for(i=0;i<imgidsArr.length;i++){
            var imgcode= filecode_to_fileurl(imgidsArr[i])
            var $li = $(
                '<div id="' + i + '" class="file-item-attach">' +
                '<h4 class="info"><a href="'+imgcode[0]+'" download="' + imgcode[1] + '">' + imgcode[1] + '</a></h4>' +
                '<p class="attach-remove-this">删除</p>' +
                '</div>'
                );


            $li.data('id',imgidsArr[i]);
            // $list为容器jQuery实例
            $list.append( $li );
        }


    }else{
        var imgidsArr = [];
    }


    var uploader = WebUploader.create({

        auto: true,

        // swf文件路径
        swf: '/assets/js/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: upurl,
        formData:{'_token':$('meta[name="csrf-token"]').attr('content'),'sub_file_name':sub_file_name},
        fileVal:'file_data',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: pick,

        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,

        // 只允许选择图片文件。
        accept: accept,
        fileSingleSizeLimit:2048000    //单个文件大小，单位B

    });

    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        $list.append('<div id="' + file.id + '" class="file-item-attach">' +
            '<h4 class="info"><a href="#" download="' + file.name + '">' + file.name + '</a></h4>' +
            '<p class="state">等待上传...</p>' +
            '<p class="attach-remove-this">删除</p>' +
            '</div>');

    });

    uploader.on('beforeFileQueued', function (file, percentage) {
        var num = $list.find(".file-item-attach").length;
        if(num>=maxnum){
            alert("超出数量限制");
            return false;
        }

    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $('#' + file.id),
            $percent = $li.find('.progress .progress-bar');

        // 避免重复创建
        if (!$percent.length) {
            $percent = $('<div class="progress progress-striped active">' +
                '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                '</div>' +
                '</div>').appendTo($li).find('.progress-bar');
        }
        $li.find('p.state').text('上传中');
        $percent.css('width', percentage * 100 + '%');

    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file,response ) {

        if(response.state == 1) {
            imgidsArr.push(response.code);
            var newimgids = imgidsArr.join(",");
            $(imgids).val(newimgids);

            $('#' + file.id).find('p.state').text('已上传');
            if(response.code) {
                $('#' + file.id).data('code',response.code);
                $('#' + file.id).find('.info a').attr("href",response.path);
            }
        } else {
            $('#' + file.id).find('p.state').text('上传出错');
        }

    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        $('#' + file.id).find('p.state').text('上传出错');

    });
    uploader.on('error', function (code, file) {
        var str="";
        switch(code){
            case "F_DUPLICATE":
                str="文件重复";
                break;
            case "Q_TYPE_DENIED":
                str="文件类型 不允许";
                break;
            case "F_EXCEED_SIZE":
                str="文件大小超出限制";
                break;
            case "Q_EXCEED_SIZE_LIMIT":
                str="超出空间文件大小";
                break;
            case "Q_EXCEED_NUM_LIMIT":
                str="抱歉，超过每次上传数量图片限制";
                break;
            default:
                str=" Error:"+code;
        }
        alert(str);
    });
    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $('#' + file.id).find('.progress').fadeOut();
    });

    $list.on('click', '.attach-remove-this', function () {
        var fileItem = $(this).parent();
        var dataid = $(fileItem).data('id');
        //uploader.removeFile(id, true);
        if(dataid){
            var index = imgidsArr.indexOf(dataid);
            if (index > -1) {
                imgidsArr.splice(index, 1);
            }
            var newimgids = imgidsArr.join(",");
            $(imgids).val(newimgids);
        }


        $(fileItem).fadeOut(function () {
            $(fileItem).remove();
        });
        // $.ajax({
        //     url: delurl,
        //     type:'POST',
        //     data: {
        //         'key':$(fileItem).data('code')
        //     },
        //     success: function (data) {
        //     }
        // })
    });
}