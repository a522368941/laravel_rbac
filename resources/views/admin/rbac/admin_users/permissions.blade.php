@extends('admin.layouts.app')

@section('content')
    <style>
        .sub-permissions-ul li {
            float: left;

        }
    </style>
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        {!! Breadcrumbs::render('admin-user-permission') !!}
    </div>

    <div class="page-content">
        <div class="title-wrap">
            <p style="color: red">不设置则所有展会都有权限</p>
        </div>
        <div class="row">

            <div class="col-xs-12">

                    <form action="{{ route('admin.admin_user.permissions',['id'=>$user->id]) }}" method="post"
                          id="role-permissions-form">
                        <div class="panel-body panel-body-nopadding">
                            @foreach($permissions as $permission)
                                <div class="top-permission col-md-12">
                                    <a href="javascript:;" class="display-sub-permission-toggle">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                    @if(in_array($permission['id'],$userPermissions))
                                        <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}"
                                               class="top-permission-checkbox" checked/>
                                    @else
                                        <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}"
                                               class="top-permission-checkbox"/>
                                    @endif
                                    <label><h5>&nbsp;&nbsp;{{ $permission['name'] }}</h5></label>
                                </div>
                                <div class="topt-permission">
                                    @if($area_code == '8')
                                        @if(count($permission->subExhiPermissionsByCity($permission['pc_name'])))
                                            @foreach($permission->subExhiPermissionsByCity($permission['pc_name']) as $sub)
                                                <div class="sec-permission col-md-11 col-md-offset-1">
                                                    <label><input type="checkbox" name="permissions[]"
                                                                  value="{{ $sub['id'] }}"
                                                                  class="sec-permission-checkbox" {{ in_array($sub['id'],$userPermissions) ? 'checked':'' }}/>
                                                        <span class="fa fa-bars"></span>
                                                    </label>
                                                    <label><h5>&nbsp;&nbsp;{{ $sub['pc_name'] }}</h5></label>

                                                </div>

                                            @endforeach
                                        @endif
                                    @else
                                        @if(count($permission->subExhiPermissions($permission['id'])))
                                        @foreach($permission->subExhiPermissions($permission['id']) as $sub)
                                            <div class="sec-permission col-md-11 col-md-offset-1">
                                                    <label><input type="checkbox" name="permissions[]"
                                                                  value="{{ $sub['id'] }}"
                                                                  class="sec-permission-checkbox" {{ in_array($sub['id'],$userPermissions) ? 'checked':'' }}/>
                                                        <span class="fa fa-bars"></span>
                                                    </label>
                                                    <label><h5>&nbsp;&nbsp;{{ $sub['pc_name'] }}</h5></label>

                                            </div>

                                        @endforeach
                                    @endif
                                    @endif
                                </div>

                            @endforeach
                            {{ csrf_field() }}
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info btn-primary" id="save-role-permissions">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    保存
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset" onclick="window.location.href='{{ route('admin.admin_user.index') }}'">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    返回
                                </button>
                            </div>

                        </div>

                    </form>

            </div><!-- col-sm-9 -->

        </div><!-- row -->
    </div>

@endsection

@section('javascript')
    @parent
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
    <script type="text/javascript">
        $("#save-role-permissions").click(function (e) {
            e.preventDefault();
            Rbac.ajax.request({
                href: $("#role-permissions-form").attr('action'),
                data: $("#role-permissions-form").serialize(),
                successTitle: '展会权限保存成功'
            });
        });
    </script>
@endsection