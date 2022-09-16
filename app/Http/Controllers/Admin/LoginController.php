<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use DB,Validator;
class LoginController  extends Controller
{
    public function index(){
        
    	return view('admin.login.index');
    }


    public function logout(){
        
        $user=Auth::guard('admin')->user();
        if($user){
            $login_info = [
                'ip' => __get_ip(),
                'created_at' =>date("Y-m-d H:i:s"),
                'admin_id' => $user->id,
                'username' => $user->email,
                'company_id' => 0,
                'type' => 2,
                   
            ];

            //插入到数据库
            DB::table('sys_loginlog')->insert($login_info);
        }
        
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function submitLogin(Request $request)
    {
        //$this->validateLogin($request);

        $validator = Validator::make($request->all(), [
            'email'=> 'required|string',
            'password' => 'required|string|min:6',
            'captcha' => 'required|captcha',
            
        ], [
            'email.required'=>'请输入您的用户名',
            'password.required'=>'请输入密码',
            'captcha.required' =>'请输入验证码',
            'captcha.captcha' =>'验证码错误',
            'password.min' => '请输入最少六位密码',
            
        ]);
        if ($validator->fails()) {
            $failmessage = $validator->errors()->getMessages();
            $firsmessage = array_shift($failmessage);

            
            return response()->json(['code'=>301,'message'=>$firsmessage[0]]);
        }


        $email = $request->input("email");
       
        $password  = $request->input("password");
       	$captcha = $request->input("captcha");

       	$res=Auth::guard('admin')->attempt(['email'=>$email,'password'=>$password]); 	
        if($res){
           
            $user=Auth::guard('admin')->user();
            $login_info = [
                'ip' => __get_ip(),
                'created_at' =>date("Y-m-d H:i:s"),
                'admin_id' => $user->id,
                'username' => $user->email,
                'company_id' => 0,
                'type' => 1,
               
            ];

            //插入到数据库
            DB::table('sys_loginlog')->insert($login_info);

            return response()->json(['code'=>200,'message'=>'登录成功']);
           
        }else{
           
            return response()->json(['code'=>301,'message'=>'账户密码错误']);
        }
        
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
            
        ], [
            'email.required'=>'请输入您的用户名',
            'password.required'=>'请输入密码',
            'captcha.required' =>'请输入验证码',
            'captcha.captcha' =>'验证码错误'
            
        ]);
    }

}
