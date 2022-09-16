<?php

namespace App\Http\Controllers\Admin\Sys;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\PermissionRepositoryEloquent;
// use App\Http\Requests\Admin\Sys\Permission\CreateRequest;
// use App\Http\Requests\Admin\Sys\Permission\UpdateRequest;
use App\Http\Controllers\Admin\BaseController;


class PermissionController extends BaseController
{
    protected $permission;

    protected $permissionRole;

    public function __construct(PermissionRepositoryEloquent $permission)
    {
      
        $this->permission = $permission;

      

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        $permissions = $this->permission->topPermissions();
        return view('admin.rbac.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.rbac.permissions.create');
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
        //dd($param);
       
        $result = $this->permission->create($param);

        if(!$result) {
          
            return response()->json(['code'=>301,'message'=>'新模块添加失败']);
        } else {
            
            return response()->json(['code'=>200,'message'=>'新模块添加成功']);
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
        

        $permission = $this->permission->find($id);
        return view('admin.rbac.permissions.edit', compact('permission'));
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
       
        $result = $this->permission->update($request->all(), $id);
        if(!$result['status']) {
           return response()->json(['code'=>301,'message'=>'模块修改失败']);
        } else {
            
            return response()->json(['code'=>200,'message'=>'模块更新成功']);
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
        $result = $this->permission->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi permissions
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->permission->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
}
