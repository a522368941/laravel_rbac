$(function(){
    var phtml = "",
        chtml = "",
        rhtml = "" ,
        pvalue = $("#input_brand").data("value"),
        cvalue = $("#input_series").data("value"),
        avalue = $("#input_type").data("value");
    $.ajax({
        type: "get",
        url: "/tool/carbrand/brand",
        dataType: "json",
        success: function(data){
            if(data.success==1){
                $.each(data.data,function(idx,item){
                    phtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                });
                $("#input_brand").append(phtml);
                if(pvalue){
                    $("#input_brand").val(pvalue)
                }
            }
        }
    });
    if(pvalue){
        $.ajax({
            type: "get",
            url: "/tool/carbrand/series",
            data:{pid:pvalue},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    chtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        chtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    $("#input_series").html(chtml);

                    if(cvalue){
                        $("#input_series").val(cvalue)
                    }
                }
            }
        });

        if(cvalue){
            $.ajax({
                type: "get",
                url: "/tool/carbrand/type",
                data:{cid:cvalue},
                dataType: "json",
                success: function(data){
                    if(data.success==1){
                        rhtml = '<option value="">--请选择--</option>'
                        $.each(data.data,function(idx,item){
                            rhtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                        });
                        $("#input_type").html(rhtml);

                        if(avalue){
                            $("#input_type").val(avalue)
                        }
                    }
                }
            });
        }

    }




    $("select[name=car_parent_brand_id]").change(function () {
        $("#input_series").html('');
        $("#input_type").html('');
        var pid = $(this).val()
        $.ajax({
            type: "get",
            url: "/tool/carbrand/series",
            data:{pid:pid},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    chtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        chtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    $("#input_series").html(chtml);
                }
            }
        });
    });

    $("select[name=car_brand_id]").change(function () {
        var cid = $(this).val()
        $("#input_type").html('');
        $.ajax({
            type: "get",
            url: "/tool/carbrand/type",
            data:{cid:cid},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    rhtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        rhtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    $("#input_type").html(rhtml);
                }
            }
        });
    });
});