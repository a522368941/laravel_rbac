


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
                           
                           <!--  <button class="layui-btn danger deleteall" data-href="{{ route('admin.permission.destroy.all') }}"><i class="layui-icon"></i>批量删除</button> -->

                            <button class="layui-btn" style="background-color: #6FB3E0 !important;border-color: #6FB3E0;" onclick="xadmin.open('新增','{{ route('admin.permission.create') }}',800,800)"><i class="layui-icon"></i>新增</button>

                        </div>

                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                                <thead>
                                    <tr>
                                       <!--  <th class="center" width="5%">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace " id="selectall">
                                                <span class="lbl"></span>
                                            </label>
                                        </th> -->
                                        <th width="5%"></th>
                                        <th width="15%">显示名称</th>
                                        <th width="25%">路由</th>
                                        <th width="5%">图标</th>
                                        <th width="20%">是否默认权限</th>
                                        <th width="15%">是否菜单</th>
                                        <th width="100px">操作</th>
                                    </tr>
                                      
                                </thead>
                                <tbody>
                                 
                               @foreach($permissions as $permission)
                                        <tr>
                                            <!-- <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace selectall-item" name="id" id="id-{{ $permission->id }}"
                                                           value="{{ $permission->id }}">
                                                    <span class="lbl"></span>
                                                </label>
                                            </td> -->

                                            <td class="center">
                                                <div class="action-buttons">
                                                    @if($permission->sub_permission->count())
                                                    <a href="#" data-id="{{ $permission['id'] }}" class="green bigger-140 show-details-btn" title="Show Details">
                                                        <i class="ace-icon fa fa-plus"></i>
                                                        <span class="sr-only">Details</span>
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td><p class="text-info">{{ $permission->display_name }}</p></td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{!! $permission->icon_html !!}</td>
                                            <td>{!! $permission->is_default ? '是':'否' !!}</td>
                                            <td>{!! $permission->is_menu ? '是':'否' !!}</td>
                                            <td>
                                                <a  onclick="xadmin.open('新增','{{ route('admin.permission.edit',['id'=>$permission->id]) }}',800,800)"  href="javascript:;"
                                                   class="btn btn-primary btn-xs" data-rel="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i> </a>
                                                <a class="btn btn-danger btn-xs permission-delete"
                                                   data-href="{{ route('admin.permission.destroy',['id'=>$permission->id]) }}" data-rel="tooltip" data-placement="top" title="删除">
                                                    <i class="fa fa-trash-o"></i> </a>
                                            </td>
                                        </tr>

                                        @if($permission->sub_permission->count())
                                            @foreach($permission->sub_permission as $sub)
                                                <tr class="hide parent-permission-{{ $permission->id }}" data-id="{{ $sub->id }}">
                                                    <!-- <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" class="ace selectall-item" name="id" id="id-{{ $sub->id }}" value="{{ $sub->id }}">
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td> -->
                                                    <td class="center">
                                                        <div class="action-buttons">
                                                            @if($sub->sub_permission->count())
                                                            <a href="#" data-id="{{ $sub['id'] }}" class="green bigger-140 show-details-btn" title="Show Details">
                                                                <i class="ace-icon fa fa-plus"></i>
                                                                <span class="sr-only">Details</span>
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>|-- {{ $sub->display_name }}</td>
                                                    <td>{{ $sub->name }}</td>
                                                    <td>{!! $sub->icon_html !!}</td>
                                                    <td>{!! $sub->is_default ? '是':'否' !!}</td>
                                                    <td>{!! $sub->is_menu ? '是':'否' !!}</td>
                                                    <td>
                                                            <a onclick="xadmin.open('新增','{{ route('admin.permission.edit',['id'=>$sub->id]) }}',800,800)" href="javascript:;"
                                                               class="btn btn-primary btn-xs" data-rel="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i> </a>
                                                            <a class="btn btn-danger btn-xs permission-delete"
                                                               data-href="{{ route('admin.permission.destroy',['id'=>$sub->id]) }}">
                                                                <i class="fa fa-trash-o" data-rel="tooltip" data-placement="top" title="删除"></i> </a>
                                                    </td>
                                                </tr>

                                                @if($sub->sub_permission->count())
                                                    @foreach($sub->sub_permission as $sub1)
                                                        <tr class="hide parent-permission-{{ $sub->id }}" data-id="{{ $sub1->id }}">
                                                           <!--  <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" class="ace selectall-item" name="id" id="id-{{ $sub1->id }}" value="{{ $sub1->id }}">
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td> -->
                                                            <td class="center">

                                                            </td>
                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---- {{ $sub1->display_name }}</td>
                                                            <td>{{ $sub1->name }}</td>
                                                            <td>{!! $sub1->icon_html !!}</td>
                                                            <td>{!! $sub1->is_default ? '是':'否' !!}</td>
                                                            <td>{!! $sub1->is_menu ? '是':'否' !!}</td>
                                                            <td>
                                                                <a onclick="xadmin.open('新增','{{ route('admin.permission.edit',['id'=>$sub1->id]) }}',800,800)" href="javascript:;"
                                                                   class="btn btn-primary btn-xs" data-rel="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>
                                                                <a class="btn btn-danger btn-xs permission-delete"
                                                                   data-href="{{ route('admin.permission.destroy',['id'=>$sub1->id]) }}" data-rel="tooltip" data-placement="top" title="删除">
                                                                    <i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        
        //一般直接写在一个js文件中
        layui.use(['layer', 'form', ], function () {
            var layer = layui.layer
                , form = layui.form;

          
        });
    </script>
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

    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
    <script>

        $(".show-details-btn").click(function () {
            if($(this).children('.ace-icon').hasClass('fa-plus')){
                var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
                $(this).children('.ace-icon').removeClass('fa-plus').addClass('fa-minus');

                subSelector.removeClass('hide');
            }else{
                var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
                $(this).children('.ace-icon').removeClass('fa-minus').addClass('fa-plus');
                subSelector.each(function(){
                    $(this).addClass('hide');
                    $(this).find('.ace-icon').removeClass('fa-minus').addClass('fa-plus');
                    if($(this).data("id")){
                        $('.parent-permission-' + $(this).data("id")).addClass('hide');
                    }
                });
            }
        });

        $(".permission-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除该权限吗？如果该权限有下属权限将被一起删除！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的权限吗？如果该权限有下属权限将被一起删除！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });
    </script>

</html>