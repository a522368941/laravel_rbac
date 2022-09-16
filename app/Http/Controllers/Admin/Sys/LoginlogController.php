<?php

namespace App\Http\Controllers\Admin\Sys;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Models\LoginLog;

use Toastr, Breadcrumbs;

class LoginlogController extends BaseController
{
    protected $loginlog;

    public function __construct(LoginLog $loginlog)
    {
        
        $this->loginlog = $loginlog;

       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $parm = $request->all();
        $loginlog = $this->loginlog
         ->when(!empty($parm['username']),function($query) use ($parm){
            return $query->where("username",$parm['username']);
        })
        ->when(!empty($parm['reg_begin']),function($query) use ($parm){
            return $query->where("created_at",">=",$parm['reg_begin'].' 00:00:00');
        })
        ->when(!empty($parm['reg_end']),function($query) use ($parm){
            return $query->where("created_at","<=",$parm['reg_end'].' 23:59:59');
        })
        ->orderBy("id","desc")->paginate(10)->withPath('/'.$request->route()->uri);
        return view('admin.loginlog.index',compact('loginlog','parm'));
    }

}
