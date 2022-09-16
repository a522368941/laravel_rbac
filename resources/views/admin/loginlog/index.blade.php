
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
                            <form class="layui-form layui-col-space5" action="" method="get">

                                    <div class="layui-inline layui-show-xs-block">
                                        <input type="text" value="@isset($parm['username']){{$parm['username']}}@endisset" name="username"  placeholder="账号" autocomplete="off" class="layui-input">
                                    </div>
                                   
                                   <div class="layui-input-inline layui-show-xs-block">
                                        <input readonly="" class="layui-input" value="@isset($parm['reg_begin']){{$parm['reg_begin']}}@endisset" placeholder="创建日期" name="reg_begin" id="start">
                                    </div>
                                    <div class="layui-input-inline layui-show-xs-block">
                                        <input readonly=""  class="layui-input" placeholder="结束日期" value="@isset($parm['reg_end']){{$parm['reg_end']}}@endisset" name="reg_end" id="end">
                                    </div>

                                 
                                  
                              
                                
                                <div class="layui-input-inline layui-show-xs-block">
                                    <button class="layui-btn" lay-submit="" lay-filter="sreach">
                                        <i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                           
                           
                                


                            </div>

                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                                <thead>
                                    <tr>
                                        <th>账号</th>
                                        <th>操作</th>
                                        <th>ip</th>
                                        <th>时间</th>
                                    </tr>
                                          
                                </thead>
                                <tbody>
                                 
                                @foreach($loginlog as $one)
                                    <tr>
                                        <td>{{$one->username}}</td>
                                        <td>@if($one->type==1)登录@elseif($one->type==2)登出@endif</td>
                                        <td>{{$one->ip}}</td>
                                        <td>{{$one->created_at}}</td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page tcdPageCode" style="text-align: left;">
                                    <div class="row">
                                        <div class="col-xs-4">@include('admin.common.show-page-status',['result'=>$loginlog])</div>
                                        <div class="col-xs-8"><div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate" style="overflow: hidden;clear: both;">{!! $loginlog->links('admin.common.show-page') !!}</div></div>
                                    </div>
                            </div>
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
  
    

</html>