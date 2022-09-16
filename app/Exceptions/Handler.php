<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['code'=>500,'error' => '秘钥验证失败'], 500);
        }
        // dd($exception->guards());die;
        if(in_array('admin', $exception->guards())) {
            return redirect()->guest('/admin/login');
        }
       
    }

    // public function render($request, Exception $exception)
    // {
    //     //判断jwt错误异常
    //     if ($exception instanceof TokenExpiredException){
    //         return response()->json(['code'=>0,'msg'=>$exception->getMessage()], $exception->getStatusCode());
    //     }
    //     if ($exception instanceof TokenInvalidException){
    //         return response()->json(['code'=>0,'msg'=>$exception->getMessage()], $exception->getStatusCode());
    //     }
    //     if ($exception instanceof JWTException){
    //         return response()->json(['code'=>0,'msg'=>$exception->getMessage()], $exception->getStatusCode());
    //     }
    //     if ($exception instanceof UnauthorizedHttpException){
    //         return response()->json(['code'=>0,'msg'=>$exception->getMessage()], $exception->getStatusCode());
    //     }
    //     //print_r($exception);die;
    //     return parent::render($request, $exception);
    // }


}
