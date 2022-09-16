

<meta charset="UTF-8">
  <title></title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    
    <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>

     <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
    
    <!-- ace settings handler -->
    <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>
    <script>
            // 是否开启刷新记忆tab功能
           var is_remember = true;
    </script>
    
</head>
<style type="text/css">
/*    .layui-btn  {
    border-color: #1E9FFF;
    background-color: #1E9FFF;
    color: #fff;
}
.layui-btn a {
    height: 28px;
    line-height: 28px;
    margin: 5px 5px 0;
    padding: 0 15px;
    border: 1px solid #dedede;
    background-color: #fff;
    color: #333;
    border-radius: 2px;
    font-weight: 400;
    cursor: pointer;
    text-decoration: none;
}*/
.layui-form-label {
    float: left;
    display: block;
    padding: 9px 15px;
    width: 150px;
    font-weight: 400;
    line-height: 20px;
    text-align: right;
}
.layui-form-item .layui-input-inline {
    float: left;
    width: 400px;
    margin-right: 10px;
}
</style>
<body style="background: #fff">
    <div class="page-content">

        <div class="row">

            <div class="col-xs-12">
               

                <form class="form-horizontal " action="{{ route('admin.role.permissions',['id'=>$role->id]) }}" method="post"
                          id="role-permissions-form">
                        <div class="panel-body panel-body-nopadding">
                            @foreach($permissions as $permission)
                                <div class="top-permission col-md-12">
                                    <a href="javascript:;" class="display-sub-permission-toggle">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                    @if(in_array($permission['id'],array_keys($rolePermissions)))
                                        <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}"
                                               class="top-permission-checkbox" checked/>
                                    @else
                                        <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}"
                                               class="top-permission-checkbox"/>
                                    @endif
                                    <label><h5>&nbsp;&nbsp;{{ $permission['display_name'] }}</h5></label>
                                </div>
                                <div class="topt-permission">
                                    @if(count($permission['subNoDefaultPermission']))
                                        @foreach($permission['subNoDefaultPermission'] as $sub)
                                            <div class="sec-permission col-md-11 col-md-offset-1">
                                                @if($sub['is_menu'])
                                                    <label><input type="checkbox" name="permissions[]"
                                                                  value="{{ $sub['id'] }}"
                                                                  class="sec-permission-checkbox" {{ in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>
                                                        <span class="fa fa-bars"></span>
                                                    </label>
                                                    <label><h5>&nbsp;&nbsp;{{ $sub['display_name'] }}</h5></label>
                                                @else
                                                    @if(env('APP_PERMISSION_LEVEL') !== 'button')
                                                        <label><input type="checkbox" name="permissions[]"
                                                                      value="{{ $sub['id'] }}"
                                                                      class="sec-permission-checkbox" {{ in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>
                                                        </label>
                                                        <label><h5>&nbsp;&nbsp;{{ $sub['display_name'] }}</h5></label>
                                                    @else
                                                        <label><input  onclick="return false;" type="checkbox" name="permissions[]"
                                                                      value="{{ $sub['id'] }}"
                                                                      class="sec-permission-checkbox" {{ in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>
                                                        </label>
                                                        <label><h5>&nbsp;&nbsp;<span style="color:silver">{{ $sub['display_name'] }}</span></h5></label>
                                                    @endif

                                                @endif

                                            </div>
                                            @if(count($sub['subNoDefaultPermission']))
                                                <div class="sub-permissions col-md-10 col-md-offset-2">
                                                    @foreach($sub['subNoDefaultPermission'] as $secsub)
                                                        <div class="col-sm-3">
                                                            @if(env('APP_PERMISSION_LEVEL') !== 'button')
                                                                <label><input type="checkbox" name="permissions[]"
                                                                              value="{{ $secsub['id'] }}"
                                                                              class="thr-permission-checkbox" {{ in_array($secsub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>
                                                                </label>
                                                                <label><h5>&nbsp;&nbsp;{{ $secsub['display_name'] }}</h5></label>
                                                            @else
                                                                <label><input onclick="return false;" type="checkbox" name="permissions[]"
                                                                              value="{{ $secsub['id'] }}"
                                                                              class="thr-permission-checkbox" {{ in_array($secsub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>
                                                                </label>
                                                                <label><h5>&nbsp;&nbsp; <span style="color:silver">{{ $secsub['display_name'] }}</span></h5></label>
                                                            @endif

                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                        @endforeach
                                    @endif
                                </div>

                            @endforeach
                            {{ csrf_field() }}
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                               <!--  <button class="btn btn-info btn-primary" id="save-role-permissions">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    保存
                                </button> -->
                                 <div class="layui-form-item">
                                    <label for="L_repass" class="layui-form-label"></label>
                                    <button class="layui-btn btn btn-info btn-primary" type="button" lay-filter="add" lay-submit="">保存</button></div>

                                &nbsp; &nbsp; &nbsp;
                                
                            </div>

                        </div>

                    </form>

                </div>

            </div>
        </div>
        <script>layui.use(['form', 'layer','jquery','laydate'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                laydate = layui.laydate,
                layer = layui.layer;

              
                

                //监听提交
                form.on('submit(add)',
                function(data) {

                    console.log(data);
                    //发异步，把数据提交给php
                    
                  
                    $.ajax({
                        type:'post',
                        data:$("#role-permissions-form").serialize(),
                        dataType:'json',
                        url:$("#role-permissions-form").attr('action'),
                        success:function(data){
                            if(data.code==200){
                                layer.alert(data.message, {
                                    icon: 6
                                },
                                function() {
                                    //关闭当前frame
                                    xadmin.close();

                                    // 可以对父窗口进行刷新 
                                    xadmin.father_reload();
                                });
                                
                            }else{
                                layer.alert(data.message);
                            }
                        }
                    });
                    return false;
                    
                });

            });</script>


            <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
            <script src="{{ asset('assets/js/ajax.js') }}"></script>
            <script>

                $(".display-sub-permission-toggle").click(function () {
                    if($(this).children('span').hasClass('glyphicon-minus')){
                        $(this).children('span').removeClass('glyphicon-minus').addClass('glyphicon-plus')
                            .parents('.top-permission').next('.topt-permission').hide();
                    }else{
                        $(this).children('span').removeClass('glyphicon-plus').addClass('glyphicon-minus')
                            .parents('.top-permission').next('.topt-permission').show();
                    }
                });

                $(".top-permission-checkbox").change(function () {
                    $(this).parents('.top-permission').next('.topt-permission').find('input').prop('checked', $(this).prop('checked'));
                });

                $(".sec-permission-checkbox").change(function () {
                    $(this).parents('.sec-permission').next('.sub-permissions').find('input').prop('checked', $(this).prop('checked'));
                });

                $(".thr-permission-checkbox,.sec-permission-checkbox").change(function () {
                    if ($(this).prop('checked')) {
                        $(this).parents('.topt-permission').prev('.top-permission').find('.top-permission-checkbox').prop('checked', true);
                    }
                });


            </script>
            <!-- <script type="text/javascript">
                $("#save-role-permissions").click(function (e) {
                    e.preventDefault();
                    Rbac.ajax.request({
                        href: $("#role-permissions-form").attr('action'),
                        data: $("#role-permissions-form").serialize(),
                        successTitle: '角色权限保存成功'
                    });
                });
            </script> -->
      
    </body>

</html>