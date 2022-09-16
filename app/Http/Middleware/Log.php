<?php
/**
 * 操作日志中间件
 */
namespace App\Http\Middleware;

use Closure;
use Route,Auth;
use App\Http\Models\OperationLog;
use App\Http\Models\Permission;

class Log
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$type='admin')
    {
        $user_id = 0;
        $user_name = '';
        if(Auth::check()) {
            $user_id = (int) Auth::id();
            $user_name = Auth::user()->email;
        }
        $routename = Route::currentRouteName();

        if('GET' != $request->method()){

            if($type=='admin'){
                $permission = new Permission();
                $log = new OperationLog(); # 提前创建表、model
               
            }

            $display_name = "";
            if(isset($routename)){
                $display_name = $permission->where("url",'like','%'.$routename.'%')->value('description');
            }
            $input = $request->all();
            $input = json_encode($input, JSON_UNESCAPED_UNICODE);
            if(strlen($input)>10000){
                $input = "";
            }
            $log->admin_id = $user_id;
            $log->username = $user_name;
            $log->title = $display_name;
            $log->path = $request->path();
            $log->method = $request->method();
            $log->ip = __get_ip();
            $log->input = $input;
            $log->route_name = $routename;
            $log->save();   # 记录日志

        }




        return $next($request);
    }
}
