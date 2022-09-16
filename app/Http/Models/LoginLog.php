<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $table = 'sys_loginlog';

    protected $guarded = ['_token'];


}