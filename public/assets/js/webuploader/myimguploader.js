


function doUpload($list, pick,imgids,maxnum,upurl,delurl,sub_file_name) {
    if($(imgids).val()){
        var imgidsArr = $(imgids).val().split(",");

        for(i=0;i<imgidsArr.length;i++){
            var imgcode= imgcode_to_url(imgidsArr[i])
            var $li = $(
                '<div id="WU_FILE_' + i + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info"></div>' +
                '<span class="badge badge-danger remove-this"><i class="ace-icon glyphicon glyphicon-remove fa-1x icon-only"></i></span>'+
                '</div>'
                ),
                $img = $li.find('img');
                $img.attr( 'src', imgcode[0] );

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
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },
        fileSingleSizeLimit:204800000    //单个文件大小，单位B

    });

    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
            '<div id="' + file.id + '" class="file-item thumbnail">' +
            '<img>' +
            '<div class="info"></div>' +
            '<span class="badge badge-danger remove-this"><i class="ace-icon glyphicon glyphicon-remove fa-1x icon-only"></i></span>'+
            '</div>'
            ),
            $img = $li.find('img');


        // $list为容器jQuery实例
        $list.append( $li );

        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, 200, 200 );
    });

    uploader.on('beforeFileQueued', function (file, percentage) {
        var num = $list.find(".file-item").length;
        if(num>=maxnum){
            //alert("超出数量限制");
            return false;
        }

    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file,response ) {
        $( '#'+file.id ).addClass('upload-state-done');
        $( '#'+file.id ).data('id',response.code);
        if(response.state==1){
            imgidsArr.push(response.code);
            var newimgids = imgidsArr.join(",");
            $(imgids).val(newimgids);
        }else if(response.message){
            var $li = $( '#'+file.id ),
                $error = $li.find('div.error');

            // 避免重复创建
            if ( !$error.length ) {
                $error = $('<div class="error"></div>').appendTo( $li );
            }
            $error.text('上传失败,'+response.message);
        }
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });

    $list.on('click', '.remove-this', function () {
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

    uploader.on("error", function (type) {undefined


        if (type == "Q_TYPE_DENIED") {undefined
            alert("请上传JPG、PNG格式文件");
        } else if (type == "Q_EXCEED_SIZE_LIMIT") {undefined
            alert("文件大小不能超过2M");
        }else if (type == "F_DUPLICATE") {undefined
            alert("上传失败，存在重复图片");
        }
        else if (type == "F_EXCEED_SIZE") {undefined
            alert("文件大小不能超过200M");
        }
        else {undefined
            alert("上传出错！请检查后重新上传！错误代码"+type);
        }
    });
}