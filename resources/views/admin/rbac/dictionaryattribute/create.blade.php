@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        {!! Breadcrumbs::render('admin-dictionaryattribute-create') !!}
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal form-bordered" action="{{ route('admin.dictionaryattribute.store') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="cate_type" value="{{$cate_type}}">
                    <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label no-padding-right">code <span class="asterisk">*</span></label>

                        <div class="col-sm-9">
                            <input type="text" class="col-xs-10 col-sm-5" name="code" value="{{ old('code') }}">
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('cname') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label no-padding-right">代码名称 <span class="asterisk">*</span></label>

                        <div class="col-sm-9">
                            <input type="text" class="col-xs-10 col-sm-5" name="cname" value="{{ old('cname') }}">
                            @if ($errors->has('cname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('sortid') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label no-padding-right">排序 </label>

                        <div class="col-sm-9">
                            <input type="text" class="col-xs-10 col-sm-5" name="sortid" value="{{ old('sortid') }}">
                            @if ($errors->has('sortid'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sortid') }}</strong>
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
                            <button class="btn" type="button" onclick="window.location.href='{{ route('admin.dictionaryattribute.index',['cate_type'=>$cate_type]) }}'">
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
