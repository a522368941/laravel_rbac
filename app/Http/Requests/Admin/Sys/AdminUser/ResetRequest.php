<?php

namespace App\Http\Requests\Admin\Sys\AdminUser;

use App\Http\Requests\Admin\Request;

class ResetRequest extends Request
{

    public function rules()
    {
        return [
            'oldpassword'=>'required|between:6,20',
            'password'=>'required|between:6,20|confirmed',
        ];
    }

    public function messages()
    {
        return  [
            'required' => '密码不能为空',
            'between' => '密码必须是6~20位之间',
            'confirmed' => '新密码和确认密码不匹配'
        ];
    }
}
