

 <meta charset="UTF-8">
  <title></title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
  
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    <!-- <link rel="stylesheet" href="public/admin/css/theme5.css"> -->
     <link rel="stylesheet" href="{{ asset('admin/css/theme4229.min.css') }}"> 
    
    <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>
   
    <!--  <script type="text/javascript" src="public/js/echarts.min.js"></script> -->
     <link rel="stylesheet" href="{{ asset('layuiMini/lib/font-awesome-4.7.0/css/font-awesome.min.css') }}" media="all">
      <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.page.js') }}"></script>
    <script>
            // 是否开启刷新记忆tab功能
           var is_remember = true;
    </script>
    
</head>
    <style type="text/css">
        .layui-table td, .layui-table th {
            min-width: 20px;
        }
        .disabled{
            color: #888;
        }
        .hide {
    display: none!important;
}

    </style>
     <style type="text/css">
        .x-admin-sm .layui-icon {
            font-size: 22px;
        }
        .page span.current {
            
            min-width: 24px;
          
        }

    </style>
    <body>
        <div class="x-nav">
           
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
                <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
            </a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                           
                        </div>
                        <div class="layui-card-header">
                           
                            <button class="layui-btn layui-btn-danger deleteall" data-href="{{ route('admin.role.destroy.all') }}"><i class="layui-icon"></i>批量删除</button>

                            <button class="layui-btn" style="background-color: #6FB3E0 !important;border-color: #6FB3E0;" onclick="xadmin.open('新增','{{ route('admin.role.create') }}',800,800)"><i class="layui-icon"></i>新增</button>

                        </div>

                        <div class="layui-card-body ">
                            <table class="layui-table ">
                                <thead>
                                   <tr>
                                        <th class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" id="selectall">
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th>标识</th>
                                        <th>角色名</th>
                                        <th>说明</th>
                                        <th>创建时间</th>
                                        <th width="120px">操作</th>
                                    </tr>
                                                      
                                </thead>
                                <tbody>
                                 
                                     @foreach($roles as $role)
                                        <tr>
                                            <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace selectall-item" name="id" id="id-{{ $role->id }}"
                                                           value="{{ $role->id }}">
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>

                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->display_name }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>{{ $role->created_at }}</td>
                                            <td>
                                                <a onclick="xadmin.open('修改','{{ route('admin.role.edit',['id'=>$role->id]) }}',800,800)" href="javascript:;"
                                                   class="btn btn-primary btn-xs"  data-placement="top" title="编辑"><i class="fa fa-pencil" ></i> </a>

                                                <a onclick="xadmin.open('权限','{{ route('admin.role.permissions',['id'=>$role->id]) }}',1000,800)" href="javascript:;"
                                                   class="btn btn-info btn-xs role-permissions"  data-placement="top" title="权限"><i class="fa fa-wrench"></i> </a>
                                                <a class="btn btn-danger btn-xs role-delete" data-href="{{ route('admin.role.destroy',['id'=>$role->id]) }}"  data-placement="top" title="删除">
                                                    <i class="fa fa-trash-o" ></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                         <div class="row">
                            <div class="col-xs-4">@include('admin.common.show-page-status',['result'=>$roles])</div>
                            <div class="col-xs-8"><div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">{!! $roles->links('admin.common.show-page') !!}</div></div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </body>
  
    <script>

         

        layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;
             var  form = layui.form;
            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
            form.on('checkbox(checkall)', function(data){

              if(data.elem.checked){
                $('tbody input').prop('checked',true);
              }else{
                $('tbody input').prop('checked',false);
              }
              form.render('checkbox');
            }); 
        });


    </script>
    <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>

   
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
    <script src="{{ asset('assets/js/excanvas.min.js') }}"></script>
    <![endif]-->
   


    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
    
    <script type="text/javascript">
        $(".role-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除角色?',
                href: $(this).data('href'),
                successTitle: '角色删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的角色?',
                href: $(this).data('href'),
                successTitle: '角色删除成功'
            });
        });
    </script>

</html>