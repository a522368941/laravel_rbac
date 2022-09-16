<?php namespace App\Presenters;

use App\Repositories\Yy\RoleRepositoryEloquent;
use App\Transformers\RoleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use Auth;

/**
 * Class RolePresenter
 *
 * @package namespace App\Presenters;
 */
class YyRolePresenter extends FractalPresenter
{
    protected $role;

    public function __construct(RoleRepositoryEloquent $role)
    {
        $this->role = $role;
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoleTransformer();
    }

    /**
     *  Roles checkbox
     * @param array $roles
     * @return string
     */
    public function rolesCheckbox($hasRoles = [])
    {
        $roles = $this->role->get();


        if(!$roles->count()) {
            return '<a class="btn btn-danger-alt btn-xs" href="'.route('yyadmin.role.create').'"> <i class="fa fa-hand-o-right"> 添加角色</i></a>';
        }

        $checkbox = '';
        foreach ($roles as $role) {
            if(in_array($role->name,$hasRoles)) {
                $checkbox .= '<div class="checkbox block"><label><input type="checkbox" checked="checked"  name="roles[]" value="' . $role->id . '">' . $role->display_name . '</label></div>';
            } else {
                $checkbox .= '<div class="checkbox block"><label><input type="checkbox" name="roles[]" value="' . $role->id . '">' . $role->display_name . '</label></div>';
            }
        }

        return $checkbox;
    }
}
