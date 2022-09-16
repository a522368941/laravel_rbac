<?php

namespace App\Http\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission implements Transformable
{
    use TransformableTrait;
    
    protected $table = 'sys_permissions';

    protected $fillable = ['fid', 'icon', 'name','url', 'display_name', 'description', 'is_menu', 'is_default', 'sort'];

    protected $appends = ['icon_html', 'sub_permission','name_true'];

    public function getIconHtmlAttribute()
    {
        return $this->attributes['icon'] ? '<i class="menu-icon fa fa-' . $this->attributes['icon'] . '"></i>' : '';
    }

    public function getNameAttribute($value)
    {
        if(starts_with($value, '#')) {
            return head(explode('-', $value));
        }
        return $value;
    }

    public function getNameTrueAttribute($value)
    {
        return $this->attributes['name'];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ($value == '#') ? '#-' . time() : $value;
    }

    public function getSubPermissionAttribute()
    {
        return  $this->where('fid',$this->attributes['id'])->orderBy('sort', 'asc')->get();
    }

    public function getSubNoDefaultPermissionAttribute()
    {
        return  $this->where('fid',$this->attributes['id'])->where('is_default', 0)->orderBy('sort', 'asc')->get();
    }
}
