<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminUserRepository;
use App\Http\Models\Administrator;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdminUserRepositoryEloquent extends BaseRepository implements AdminUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Administrator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Store user
     * @param array $payload
     * @return bool
     */
    public function store($payload = [])
    {
        $id = $this->model->insertGetId([
            'company_id' => $payload['company_id'],
            'true_name' => $payload['true_name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
            'password' => bcrypt($payload['password']),
            'is_super' => $payload['is_super'],
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        if(!$id) {
            return false;
        }
        $roles=explode(',', rtrim($payload['roles'],','));
        if($id && $roles) {
            $this->attachRoles($id, $roles);
        }
        return true;
    }

    /**
     * update admin user
     * @param array $attributes
     * @param $id
     * @return array
     */
    public function update(array $attributes, $id)
    {
//        $isAble = $this->model->where('id', '<>', $id)->where('name', $attributes['name'])->count();
//        if($isAble) {
//            return [
//                'status' => false,
//                'msg' => '用户名已被使用'
//            ];
//        }

//        $isAble = $this->model->where('id', '<>', $id)->where('email', $attributes['email'])->count();
//        if($isAble) {
//            return [
//                'status' => false,
//                'msg' => '邮箱已被使用'
//            ];
//        }

        $data = [];
        if($attributes['password']) {
            $data['password'] = bcrypt($attributes['password']);
        }
        $data['true_name'] = $attributes['true_name'];
        $data['phone'] = $attributes['phone'];
//        $data['email'] = $attributes['email'];
        $data['is_super'] = $attributes['is_super'];
        $data['updated_at']=date('Y-m-d H:i:s');
        $result = parent::update($data, $id);
       
        if(!$result) {
            return [
                'status' => false,
                'msg' => '用户更新失败'
            ];
        }
        $this->model->find($id)->roles()->detach();

        if(isset($attributes['roles'])) {
            $attributes['roles']=explode(',', rtrim($attributes['roles'],','));
            $this->attachRoles($id, $attributes['roles']);
        }
        return ['status' => true];
    }

    /**
     * delete admin user
     * @param $id
     * @return bool|int
     */
    public function delete($id)
    {
        $user = $this->model->find($id);
        if(!$user) {
            return false;
        }
        $user->roles()->detach();
        return parent::delete($id);
    }

    /**
     * Attach user roles by user id
     * @param $userId
     * @param $roles
     */
    public function attachRoles($userId, $roles)
    {
        $user = $this->model->find($userId);
        $user->attachRoles($roles);
    }

    public function query($param){
        return $this->model
            ->when(isset($param['company_id']),function ($query) use($param){
                return $query->where("company_id",$param['company_id']);
            })
            ->when(!empty($param['email']),function($query) use ($param){
                return $query->where("email","=",$param['email']);
            })
            ->when(!empty($param['true_name']),function($query) use ($param){
                return $query->where("true_name","like","%".$param['true_name']."%");
            })
            ->when(!empty($param['true_name']),function($query) use ($param){
                return $query->where("true_name","like","%".$param['true_name']."%");
            })
           

            ->when(isset($param['is_disabled']) && (!empty($param['is_disabled']) || $param['is_disabled'] === '0') ,function($query) use ($param){
                return $query->where("is_disabled",'=',$param['is_disabled']);
            });
    }


}
