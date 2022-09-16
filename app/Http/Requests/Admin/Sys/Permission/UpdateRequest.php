<?php

namespace App\Http\Requests\Admin\Sys\Permission;

use App\Http\Requests\Admin\Request;

class UpdateRequest extends Request
{

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'url' => 'required|max:1000',
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '权限名称必须填写',
            'name.max' => '权限名称最多100个字符',
            'url.required' => '路由必须填写',
            'url.max' => '路由最多1000个字符',
            'display_name.max' => '权限显示名称最多100个字符',
            'description.max' => '权限说明最多100字符'
        ];
    }
}
