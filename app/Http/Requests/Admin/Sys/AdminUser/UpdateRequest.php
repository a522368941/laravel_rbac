<?php

namespace App\Http\Requests\Admin\Sys\AdminUser;

use App\Http\Requests\Admin\Request;

class UpdateRequest extends Request
{

    public function rules()
    {
        return [
            'true_name' => 'required',
            'phone' => 'required',
            'password' => 'nullable|between:6,20',  //sometimes
        ];
    }

    public function messages()
    {
        return [
            'true_name.required' => '姓名必须填写',
            'phone.required' => '手机号必须填写',
            'password.between' => '密码必须是6~20位之间'
        ];
    }
}
