<?php

namespace App\Http\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AdminUserRole extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $table = 'sys_administrator_role';

    public function isSponsor($admin_id){
        //根据登录的管理员id判断是否是服务单位
        $role_id = DB::table('sys_administrator_role')->where('administrator_id',$admin_id)->value('role_id');
        if($role_id == '18'){
            //服务单位roleid
            return true;
        }else{
            return false;
        }
    }

}
