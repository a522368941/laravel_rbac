<?php

namespace App\Http\Middleware;

use Closure;
use Zizaco\Entrust\EntrustFacade as Entrust;
use App\Http\Models\Permission;
use Route,URL,Auth;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard('admin')->user()->is_super){
            return $next($request);
        }
        $curRoute1 = Route::currentRouteName();
        if(!$curRoute1){
            return $next($request);
        }

        $ADMINUSER_PERMISSIONS = session('ADMINUSER_PERMISSIONS');
        if(empty($ADMINUSER_PERMISSIONS)){
            $permissions = Permission::select('name','url')->get();
            $permissionsArr = [];
            foreach($permissions as $v){
                if(!empty($v->url)&&$v->url!='#'){
                    $permissionKeyArr = explode(",",$v->url);
                    foreach($permissionKeyArr as $m){
                        $permissionsArr[$m] = $v->name;
                    }
                }
            }
            session(array('ADMINUSER_PERMISSIONS'=>json_encode($permissionsArr)));

        }else{
            $permissionsArr = json_decode($ADMINUSER_PERMISSIONS,true);
        }


        $curRoute = Route::currentRouteName();
        $permissionCode = isset($permissionsArr[$curRoute])?$permissionsArr[$curRoute]:'';

        $previousUrl = URL::previous();
        if(empty($permissionCode)||!Auth::guard('admin')->user()->can($permissionCode)) {
            if($request->ajax() && ($request->getMethod() != 'GET')) {
                return response()->json([
                    'status' => -1,
                    'code' => 403,
                    'msg' => '您没有权限执行此操作'
                ]);
            } else {
                return  response()->view('admin.errors.403', compact('previousUrl'));
            }
        }

        return $next($request);
    }
}
