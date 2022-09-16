@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        {!! Breadcrumbs::render('admin-dictionaryattribute-index') !!}
    </div>
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                </div>
                <div class="col-md-6 col-sm-6">
                    <span class="btn btn-default btn-sm pull-right" onclick="window.location.href='{{ route('admin.dictionary.index') }}'"><i class="ace-icon fa fa-undo bigger-110"></i> 返回</span>
                    <span class="btn btn-info btn-sm pull-right" style="margin-right:10px;" onclick="window.location.href='{{ route('admin.dictionaryattribute.create',['cate_type'=>$cate_type]) }}'"><i class="glyphicon glyphicon-plus"></i> 新增</span>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>类型</th>
                        <th>code</th>
                        <th>代码名称</th>
                        <th>排序</th>
                        <th width="80px">操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($dictionaryattributes as $dictionaryattribute)
                        <tr>

                            <td>{{ $cate_type }}</td>
                            <td>{{ $dictionaryattribute->code }}</td>
                            <td>{{ $dictionaryattribute->cname }}</td>
                            <td>{{ $dictionaryattribute->sortid }}</td>
                            <td>
                                @if(Auth::guard('admin')->user()->is_super ||Auth::guard('admin')->user()->can('admin.dictionaryattribute.edit'))
                                <a href="{{ route('admin.dictionaryattribute.edit',['id'=>$dictionaryattribute->id,'cate_type'=>$cate_type]) }}"
                                   class="btn btn-primary btn-xs" data-rel="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil" ></i> </a>
                                @endif
                                @if(Auth::guard('admin')->user()->is_super ||Auth::guard('admin')->user()->can('admin.dictionaryattribute.edit'))
                                    <a class="btn btn-danger btn-xs role-delete" data-href="{{ route('admin.dictionaryattribute.destroy',['id'=>$dictionaryattribute->id]) }}" data-rel="tooltip" data-placement="top" title="删除">
                                    <i class="fa fa-trash-o" ></i> </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-4">@include('admin.common.show-page-status',['result'=>$dictionaryattributes])</div>
            <div class="col-xs-8"><div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">{!! $dictionaryattributes->appends(['cate_type'=>$cate_type])->links('admin.common.show-page') !!}</div></div>
        </div>

    </div>

@endsection

@section('javascript')
    @parent
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script type="text/javascript">
        $(".role-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除该数据字典属性?',
                href: $(this).data('href'),
                successTitle: '数据字典属性删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的数据字典属性?',
                href: $(this).data('href'),
                successTitle: '数据字典属性删除成功'
            });
        });
    </script>

@endsection
