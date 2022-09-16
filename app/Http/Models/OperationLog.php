<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    protected $table = 'sys_operationlog';

    protected $guarded = ['_token'];


}