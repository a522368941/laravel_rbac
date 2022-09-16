@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        {!! Breadcrumbs::render('admin-dictionary-edit') !!}
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal form-bordered" action="{{ route('admin.dictionary.update',['id'=>$dictionary->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group {{ $errors->has('cate_type_name') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label no-padding-right">名称 <span class="asterisk">*</span></label>

                        <div class="col-sm-9">
                            <input type="text" class="col-xs-10 col-sm-5" name="cate_type_name" value="{{$dictionary->cate_type_name }}">
                            @if ($errors->has('cate_type_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cate_type_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('cate_type') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label no-padding-right">类型代码 <span class="asterisk">*</span></label>

                        <div class="col-sm-9">
                            <input type="text" class="col-xs-10 col-sm-5" name="cate_type" value="{{$dictionary->cate_type }}">
                            @if ($errors->has('cate_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cate_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info btn-primary" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                保存
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn" type="button" onclick="window.location.href='{{ route('admin.dictionary.index') }}'">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                返回
                            </button>
                        </div>
                        </div>



                </form>
            </div>
        </div>
    </div>

@endsection
