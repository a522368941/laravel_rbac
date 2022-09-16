@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        {!! Breadcrumbs::render('admin-user-show') !!}
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                @lang('auth.my_profile')
            </h1>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="checkbox">@lang('auth.label_role')</label>
                        <div class="col-sm-9">
                            @inject('rolePresenter','App\Presenters\RolePresenter')

                            {!! $rolePresenter->rolesCheckbox($hasRoles) !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label no-padding-right">@lang('auth.label_true_name') </label>

                        <div class="col-sm-9">
                            <input type="text" name="true_name" class="col-xs-10 col-sm-5" value="{{ $user->true_name }}" disabled>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label no-padding-right">@lang('auth.label_user_name')</label>

                        <div class="col-sm-9">
                            <input type="text" name="email" class="col-xs-10 col-sm-5" value="{{ $user->email }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">@lang('auth.label_admin') <span class="asterisk"></span></label>

                        <div class="col-sm-9">
                            <select class="col-xs-10 col-sm-5" name="is_super" disabled>
                                <option value="1" {{ $user->is_super == 1 ? 'selected':'' }}>@lang('common.yes')</option>
                                <option value="0" {{ $user->is_super == 0 ? 'selected':'' }}>@lang('common.no')</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
