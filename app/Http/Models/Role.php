<?php

namespace App\Http\Models;

use Zizaco\Entrust\EntrustRole;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Role extends EntrustRole implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'display_name', 'description','company_id'];

    /**
     * belongs to many for admin_user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Http\Models\Administrator','sys_administrator_role');
    }

}