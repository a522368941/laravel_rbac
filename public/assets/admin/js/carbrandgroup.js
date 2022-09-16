$(function(){
    var brand_html = '';
    $.ajax({
        async:false,
        type: "get",
        url: "/tool/carbrand/brand",
        dataType: "json",
        success: function(data){
            if(data.success==1){
                brand_html = "<option value='' >--请选择--</option> ";
                $.each(data.data,function(idx,item){
                    brand_html += "<option value="+item.id+" >"+ item.name +"</option> ";
                });
            }
        }
    });



    $("#simple-table").on("change",'.brand', function(e) {
        $(this).parents('tr').find('.series,.cartype,.cargroup').html('')
        var pid = $(this).val()
        var _that =  $(this)
        $.ajax({
            type: "get",
            url: "/tool/carbrand/series",
            data:{pid:pid},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    var chtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        chtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    _that.parents('tr').find('.series').html(chtml);
                }
            }
        });
    });

    $("#simple-table").on("change",'.series', function(e) {
        $(this).parents('tr').find('.cartype,.cargroup').html('')
        var cid = $(this).val()
        var _that =  $(this)
        $.ajax({
            type: "get",
            url: "/tool/carbrand/type",
            data:{cid:cid},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    var rhtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        rhtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    _that.parents('tr').find('.cartype').html(rhtml);
                }
            }
        });
    });

    $("#simple-table").on("change",'.cartype', function(e) {
        $(this).parents('tr').find('.cargroup').html('')
        var tid = $(this).val()
        var _that =  $(this)
        $.ajax({
            type: "get",
            url: "/tool/carbrand/tyregroup",
            data:{tid:tid},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    var rhtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        rhtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    _that.parents('tr').find('.cargroup').html(rhtml);
                }
            }
        });
    });

    $("#simple-table").on("click", '.btn-copy', function(e) {
        $(this).tooltip("hide");
        $("#simple-table").append($(this).parents("tr").clone());
        $('#simple-table tr:last [data-rel=tooltip]').tooltip();
    })

    $(".btn-add").click(function(){

        $("#simple-table").append($(".copytable .copytr").clone());
        $('#simple-table tr:last select:first').html(brand_html);
        $('#simple-table tr:last [data-rel=tooltip]').tooltip();

    })
});