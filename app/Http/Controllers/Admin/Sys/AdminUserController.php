<?php

namespace App\Http\Controllers\Admin\Sys;

use App\Http\Models\Administrator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\AdminUserRepositoryEloquent;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\DB;
use Breadcrumbs, Toastr;
use Auth;
//use App\Http\Controllers\Controller;

class AdminUserController extends BaseController
{
    protected $adminUser;

    protected $adminUserRole;

    public function __construct(AdminUserRepositoryEloquent $adminUser)
    {
       
        $this->adminUser = $adminUser;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $param = $request->all();
       
        $users = $this->adminUser
            ->query($param)
            ->paginate(10)
            ->withPath('/'.$request->route()->uri);
        
            
        return view('admin.rbac.admin_users.index', compact('users','param'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.rbac.admin_users.create');
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
        $param['company_id'] = session('CID');
        $param['is_super'] = '0'; //默认不是超级管理员
       
       
        $result = $this->adminUser->store($param);
        if(!$result) {
            return response()->json(['code'=>301,'message'=>'新用户添加失败']);
           
        }else{
            return response()->json(['code'=>200,'message'=>'新用户添加成功']);
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
       
        $user = $this->adminUser->find($id);
        
        $hasRoles = $user->roles()->pluck('name')->toArray();

        return view('admin.rbac.admin_users.show',compact('user','hasRoles'));
    }

    public function home(){
        return view('admin.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        $user = $this->adminUser->find($id);
        
        $hasRoles = $user->roles()->pluck('name')->toArray();
        //dd($user);
        return view('admin.rbac.admin_users.edit', compact('user', 'hasRoles'));
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
        $result = $this->adminUser->update($request->all(), $id);
        
        if(!$result['status']) {
           
            return response()->json(['code'=>301,'message'=>'用户更新失败']);
        } else {
           
            return response()->json(['code'=>200,'message'=>'用户更新成功']);
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
        $user = $this->adminUser->find($id);
       
        $result = $this->adminUser->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
            $user = $this->adminUser->find($id);
           
            $result = $this->adminUser->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     *重置密码
     */
    public function resetpassword(){
       
        return view('admin.rbac.admin_users.resetpassword');
    }

    public function savepassword(Request $request){

        $user = Auth::user();
        $oldpassword = $request->post('oldpassword');
        $password = $request->post('password');
       
        // echo $user->password;
        if (!\Hash::check($oldpassword, $user->password)) { //原始密码和数据库里的密码进行比对
            
             return response()->json(['code'=>301,'message'=>'旧密码错误']);
        }else{
            $user->password = bcrypt($password);       //使用bcrypt函数进行新密码加密
            $user->save();      //成功后，保存新密码
            return response()->json(['code'=>200,'message'=>'修改密码成功']);
           
        }

        

    }

    /**
     * 禁用启用
     * @param $id
     */
    public function disable($id){

        $administrator = Administrator::find($id);

        if($administrator->is_disabled==0){
            $result = $administrator->update(['is_disabled'=>1]);
        }else if($administrator->is_disabled==1){
            $result = $administrator->update(['is_disabled'=>0]);
        }

        if(!$result) {
            return ['status'=>0];
        } else {
            return ['status'=>1];
        }
    }

    public function permissions($id)
    {
        

        $user = Administrator::find($id);
       
       
       
        return view('admin.rbac.admin_users.permissions', compact('user'));
    }

   
    
}
