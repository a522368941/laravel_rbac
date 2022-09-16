<?php

namespace App\Http\Requests\Admin\Sys\AdminUser;

use App\Http\Requests\Admin\Request;

class CreateRequest extends Request
{

    public function rules()
    {
        return [
            'true_name' => 'required',
            'email' => 'required|max:20|alpha_dash|unique:sys_administrators,email',
            'phone' => 'required',
            'password' => 'required|between:6,20',
        ];
    }

    public function messages()
    {
        return [
            'true_name.required' => '姓名必须填写',
            'phone.required' => '手机号必须填写',
            'email.alpha_dash' => '用户名仅允许字母、数字、破折号（-）以及底线（_）',
            'email.max' => '用户名最多20个字符',
            'email.required' => '用户名必须填写',
            'email.unique' => '用户名已存在',
            'password.required' => '密码必须填写',
            'password.between' => '密码必须是6~20位之间'
        ];
    }
}
