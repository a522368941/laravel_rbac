@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        {!! Breadcrumbs::render('admin-dictionary-index') !!}
    </div>
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                </div>
                <div class="col-md-6 col-sm-6">
                    <span class="btn btn-info btn-sm pull-right" onclick="window.location.href='{{ route('admin.dictionary.create') }}'"><i class="glyphicon glyphicon-plus"></i> 新增</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>类型</th>
                        <th>名称</th>
                        <th width="120px">操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($dictionarys as $dictionary)
                        <tr>
                            <td>{{ $dictionary->cate_type }}</td>
                            <td>{{ $dictionary->cate_type_name }}</td>
                            <td>
                                @if(Auth::guard('admin')->user()->is_super ||Auth::guard('admin')->user()->can('admin.dictionary.edit'))
                                <a href="{{ route('admin.dictionary.edit',['id'=>$dictionary->id]) }}"
                                   class="btn btn-primary btn-xs" data-rel="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil" ></i> </a>
                                @endif
                                @if(Auth::guard('admin')->user()->is_super ||Auth::guard('admin')->user()->can('admin.dictionary.destroy'))
                                <a class="btn btn-danger btn-xs role-delete" data-href="{{ route('admin.dictionary.destroy',['id'=>$dictionary->id]) }}" data-rel="tooltip" data-placement="top" title="删除">
                                    <i class="fa fa-trash-o" ></i> </a>
                                @endif
                                @if(Auth::guard('admin')->user()->is_super ||Auth::guard('admin')->user()->can('admin.dictionaryattribute.index'))
                                    <a class="btn btn-info btn-xs" href="{{ route('admin.dictionaryattribute.index',['cate_type'=>$dictionary->cate_type]) }}" data-rel="tooltip" data-placement="top" title="属性管理">
                                        <i class="glyphicon glyphicon-list-alt" ></i> </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-4">@include('admin.common.show-page-status',['result'=>$dictionarys])</div>
            <div class="col-xs-8"><div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">{!! $dictionarys->links('admin.common.show-page') !!}</div></div>
        </div>

    </div>

@endsection

@section('javascript')
    @parent
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script type="text/javascript">
        $(".role-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除数据字典?',
                href: $(this).data('href'),
                successTitle: '数据字典删除成功'
            });
        });

    </script>

@endsection
