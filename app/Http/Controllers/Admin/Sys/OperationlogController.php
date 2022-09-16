<?php

namespace App\Http\Controllers\Admin\Sys;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Models\OperationLog;


class OperationlogController extends BaseController
{
    protected $operationlog;

    public function __construct(OperationLog $operationlog)
    {
        
        $this->operationlog = $operationlog;

      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $mods = [
            
            'admin.product.update'=>'编辑产品',
            'admin.product.recommend'=>'推荐产品',
            'admin.product.audit'=>'审核产品',
          
            'admin.product.destroy'=>'删除产品',
            'admin.admin_user.disable'=>'禁用管理员',
            'admin.admin_user.permissions'=>'设置展会权限',
           
            'admin.admin_user.store'=>'新增管理员',
            'admin.admin_user.destroy'=>'删除管理员',
            'admin.admin_user.destroy.all'=>'删除管理员',
            'admin.admin_user.update'=>'编辑管理员',
            'admin.permission.store'=>'新增模块',
            'admin.permission.update'=>'编辑模块',
            'admin.permission.destroy'=>'删除模块',
            'admin.permission.destroy.all'=>'删除模块',
            'admin.role.store'=>'新增角色',
            'admin.role.update'=>'编辑角色',
            'admin.role.destroy'=>'删除角色',
            'admin.role.destroy.all'=>'删除角色',
            'admin.role.permissions'=>'修改权限',
            'admin.admin_user.resetpassword'=>'修改密码',
            'admin.admin_user.savepassword'=>'修改密码',
           
            'admin.news.store'=>'新增资讯',
            'admin.news.update'=>'编辑资讯',
            'admin.news.destroy'=>'删除资讯',
            'admin.news.destroy.all'=>'删除资讯',
            'admin.newscate.store'=>'新增资讯分类',
            'admin.newscate.update'=>'编辑资讯分类',
            'admin.newscate.destroy'=>'删除资讯分类',
            'admin.newscate.destroy.all'=>'删除资讯分类',
            'admin.friendlink.store'=>'新增友情链接',
            'admin.friendlink.update'=>'编辑友情链接',
            'admin.friendlink.destroy'=>'删除友情链接',
          
            'admin.keywords.store'=>'新增关键字',
            'admin.keywords.update'=>'编辑关键字',
            'admin.keywords.destroy'=>'删除关键字',
        ];

        $parm = $request->all();
        $operationlog= $this->operationlog->when(!empty($parm['username']),function($query) use ($parm){
            return $query->where("username",$parm['username']);
        })
        ->when(!empty($parm['reg_begin']),function($query) use ($parm){
            return $query->where("created_at",">=",$parm['reg_begin'].' 00:00:00');
        })
        ->when(!empty($parm['reg_end']),function($query) use ($parm){
                return $query->where("created_at","<=",$parm['reg_end'].' 23:59:59');
        })
        ->when(!empty($parm['route_name']),function($query) use ($parm){
            return $query->where("route_name",$parm['route_name']);
        })
        ->orderBy("id","desc")->paginate(10)->withPath('/'.$request->route()->uri);
        
        return view('admin.operationlog.index',compact('operationlog','mods','parm'));
    }

}
