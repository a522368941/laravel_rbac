
@extends('admin.layouts.app')

@section('title', '管理员管理') 


@section('content')
        <div class="x-nav">
           
            <a class="layui-btn layui-btn-small"  style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
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
                                        <input type="text" value="@isset($param['email']){{$param['email']}}@endisset" name="email"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                                    </div>
                                   
                                    <div class="layui-inline layui-show-xs-block">
                                        <input type="text" value="@isset($param['true_name']){{$param['true_name']}}@endisset" name="true_name"  placeholder="请输入姓名" autocomplete="off" class="layui-input">
                                    </div>

                                    <div class="layui-input-inline layui-show-xs-block">
                                        <select name="is_disabled"  class="form-control">
                                                    <option value="">请选择状态</option>
                                                    <option value="0" @isset($param['is_disabled'])@if(0==$param['is_disabled'])selected="selected" @endif @endisset>启用</option>
                                                    <option value="1" @isset($param['is_disabled'])@if(1==$param['is_disabled'])selected="selected" @endif @endisset>禁用</option>
                                        </select>
                                    </div>
                              
                                
                                <div class="layui-input-inline layui-show-xs-block">
                                    <button class="layui-btn" lay-submit="" lay-filter="sreach">
                                        <i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                           
                           
                                  <button  class="layui-btn" style="background-color: #6FB3E0 !important;border-color: #6FB3E0;" onclick="xadmin.open('添加','{{ route('admin.admin_user.create') }}',800,800)"><i class="layui-icon"></i>添加</button>


                            </div>

                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                                <thead>
                                    <tr>
                                     <th>用户名</th>
                                        <th>姓名</th>
                                       
                                        <th>手机号</th>
                                        <th>超级管理员</th>
                                        <th>所属角色</th>
                                     
                                        <th>创建时间</th>
                                        <th>状态</th>
                                        <th width="140px">操作</th>
                                    </tr>
                                      
                                </thead>
                                <tbody>
                                 
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->true_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{!! $user->is_super ? '<span class="label label-danger">是</span>':'<span class="label label-default">否</span>' !!}</td>
                                        <td>
                                            @if($user->roles()->count())
                                                @foreach($user->roles()->get() as $role)
                                                    <span class="badge badge-info">{{ $role->display_name }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge">无</span>
                                            @endif
                                        </td>
                                        
                                        <td>{{ $user->created_at }}</td>
                                        <td>@if($user->is_disabled==1)<span class="label label-danger">禁用</span>@else<span class="label label-default">启用</span> @endif</td>
                                        <td>
                                            

                                            <a title="编辑"  onclick="xadmin.open('编辑','{{ route('admin.admin_user.edit',['id'=>$user->id]) }}',800,800)" href="javascript:;">
                                            <i class="layui-icon">&#xe642;</i>
                                            </a>
                                            <a style="padding: 0px 5px" class="user-delete" title="删除" data-href="{{ route('admin.admin_user.destroy',['id'=>$user->id]) }}" href="javascript:;">
                                                <i class="layui-icon">&#xe640;</i>
                                            </a> 

                                            @if($user->is_disabled==0)
                                                <a data-href="{{ route('admin.admin_user.disable',['id'=>$user->id]) }}"
                                                   class="btn btn-inverse btn-xs btn-disable" title="禁用"><i class="fa fa-lock"></i></a>
                                            @endif
                                            @if($user->is_disabled==1)
                                                <a data-href="{{ route('admin.admin_user.disable',['id'=>$user->id]) }}"
                                                   class="btn btn-inverse btn-xs btn-disable" title="启用"><i class="fa fa-unlock"></i></a>
                                            @endif
                                            
                                         
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page tcdPageCode" style="text-align: left;">
                                    <div class="row">
                                        <div class="col-xs-4">@include('admin.common.show-page-status',['result'=>$users])</div>
                                        <div class="col-xs-8"><div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate" style="overflow: hidden;clear: both;">{!! $users->appends($param)->links('admin.common.show-page') !!}</div></div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

@endsection


@section('javascript')
    @parent
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
    <script type="text/javascript">
        $(".user-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除用户?',
                href: $(this).data('href'),
                successTitle: '用户删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的用户?',
                href: $(this).data('href'),
                successTitle: '用户删除成功'
            });
        });

        $(".btn-disable").click(function () {
            var btntitle = $(this).attr('title');
            Rbac.ajax.delete({
                confirmTitle: '确定要'+btntitle+'吗?',
                href: $(this).data('href'),
                successTitle: '操作成功',
                type:"post"
            });
        });
    </script>

</html>

@endsection

