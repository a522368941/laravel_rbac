<?php

namespace App\Http\Controllers\Admin\Sys;

use App\Http\Models\Permission;
use App\Http\Models\Role;
use App\Repositories\PermissionRepositoryEloquent;
use App\Repositories\RoleRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Requests;
// use App\Http\Requests\Admin\Sys\Role\CreateRequest;
// use App\Http\Requests\Admin\Sys\Role\UpdateRequest;
use App\Http\Controllers\Admin\BaseController;
use Toastr, Breadcrumbs;

class RoleController extends BaseController
{
    protected $role;
    protected $permission;

    public function __construct(RoleRepositoryEloquent $role, PermissionRepositoryEloquent $permission)
    {
        
        $this->role = $role;
        $this->permission = $permission;

        //Breadcrumbs::setView('admin._partials.breadcrumbs');

        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       

        $roles = Role::paginate(10)->withPath('/'.$request->route()->uri);
        return view('admin.rbac.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.rbac.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $role = Role::where('name',trim($param['name']))->first();
        if($role){
           
            return response()->json(['code'=>301,'message'=>'角色标识不允许重复!']);
        }
        $param['company_id'] = session('CID');
        $result = $this->role->create($param);

        if(!$result) {
            
             return response()->json(['code'=>301,'message'=>'新角色添加失败!']);
        } else {
            
            return response()->json(['code'=>200,'message'=>'新角色添加成功!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      

        $role = $this->role->find($id);
        if($role->company_id != session('CID')){
            return view('admin.errors.403');
        }
        return view('admin.rbac.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        
        $result = $this->role->update($request->all(), $id);
        if(!$result['status']) {
            return response()->json(['code'=>301,'message'=>$result['msg']]);
            
        } else {
           
            return response()->json(['code'=>200,'message'=>'角色更新成功!']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
      

        $result = $this->role->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi roles
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $role = Role::find($id);
           
            $result = $this->role->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Display a role's permissions
     * @param $id
     * @return \Illuminate\View\View
     */
    public function permissions($id)
    {
       
        $role = $this->role->find($id);
        
        $permissions = $this->permission->topNoDefaultPermissions();
        $rolePermissions = $this->role->rolePermissions($id);
        return view('admin.rbac.roles.permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Set role's permissions
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePermissions($id, Request $request)
    {
        $role = Role::find($id);
       

        $id_arr = $request->input('permissions', []);

        //附加默认权限
        $default = Permission::where('is_default',1)->get();
        if(count($default)>0){
            foreach($default as $value){
                if(!in_array($value->id,$id_arr)){
                    $id_arr[] = $value->id;
                }
            }
        }

        $result = $this->role->savePermissions($id, $id_arr);
        if($result){
            return response()->json(['code'=>200,'message'=>'角色权限更新成功!']); 
        }else{
             return response()->json(['code'=>301,'message'=>'角色权限更新失败!']);
        }
        
    }
}
