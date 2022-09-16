$(function(){
    var phtml = "",
        chtml = "",
        rhtml = "" ,
        pvalue = $("#input_province").data("value"),
        cvalue = $("#input_city").data("value"),
        avalue = $("#input_area").data("value");
    $.ajax({
        type: "get",
        url: "/tool/region/province",
        dataType: "json",
        success: function(data){
            if(data.success==1){
                $.each(data.data,function(idx,item){
                    phtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                });
                $("#input_province").append(phtml);
                if(pvalue){
                    $("#input_province").val(pvalue)
                }
            }
        }
    });
    if(pvalue){
        $.ajax({
            type: "get",
            url: "/tool/region/city",
            data:{pid:pvalue},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    chtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        chtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    $("#input_city").html(chtml);

                    if(cvalue){
                        $("#input_city").val(cvalue)
                    }
                }
            }
        });

        if(cvalue){
            $.ajax({
                type: "get",
                url: "/tool/region/region",
                data:{cid:cvalue},
                dataType: "json",
                success: function(data){
                    if(data.success==1){
                        rhtml = '<option value="">--请选择--</option>'
                        $.each(data.data,function(idx,item){
                            rhtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                        });
                        $("#input_area").html(rhtml);

                        if(avalue){
                            $("#input_area").val(avalue)
                        }
                    }
                }
            });
        }

    }




    $("select[name=province]").change(function () {
        $("#input_city").html('');
        $("#input_area").html('');
        var pid = $(this).val()
        $.ajax({
            type: "get",
            url: "/tool/region/city",
            data:{pid:pid},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    chtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        chtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    $("#input_city").html(chtml);
                }
            }
        });
    });

    $("select[name=city]").change(function () {
        var cid = $(this).val()
        $("#input_area").html('');
        $.ajax({
            type: "get",
            url: "/tool/region/region",
            data:{cid:cid},
            dataType: "json",
            success: function(data){
                if(data.success==1){
                    rhtml = '<option value="">--请选择--</option>'
                    $.each(data.data,function(idx,item){
                        rhtml += "<option value="+item.id+" >"+ item.name +"</option> ";
                    });
                    $("#input_area").html(rhtml);
                }
            }
        });
    });
});