<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home/index/index');
});

Route::namespace('admin')->prefix('admin')->group(function () {
	
    Route::get('login', 'LoginController@index')->name('admin/login');
    Route::post('submitLogin', 'LoginController@submitLogin')->name('admin/submitLogin');
    Route::get('logout', 'LoginController@logout')->name('admin/logout');
  
    Route::get('/home', 'IndexController@home')->name('admin/home');
    Route::middleware('auth:admin','role','log')->group(function(){
    	
        Route::get('/', 'IndexController@index');
    	 //用户管理
        Route::get('admin_user/resetpassword',['as'=>'admin.admin_user.resetpassword','uses'=>'Sys\AdminUserController@resetpassword']);
        Route::post('admin_user/savepassword',['as'=>'admin.admin_user.savepassword','uses'=>'Sys\AdminUserController@savepassword']);

        // Route::get('admin_user', 'Sys\AdminUserController@index')->name('admin_user');

        Route::resource('admin_user', 'Sys\AdminUserController',['as'=>'admin']);
        Route::post('admin_user/destroyall',['as'=>'admin.admin_user.destroy.all','uses'=>'Sys\AdminUserController@destroyAll']);
        Route::post('admin_user/disable/{id}',['as'=>'admin.admin_user.disable','uses'=>'Sys\AdminUserController@disable']);
        Route::get('admin_user/{id}/permissions',['as'=>'admin.admin_user.permissions','uses'=>'Sys\AdminUserController@permissions']);
        Route::post('admin_user/{id}/permissions',['as'=>'admin.admin_user.permissions','uses'=>'Sys\AdminUserController@storePermissions']);
        //角色管理
        Route::resource('role', 'Sys\RoleController',['as'=>'admin']);
        Route::post('role/destroyall',['as'=>'admin.role.destroy.all','uses'=>'Sys\RoleController@destroyAll']);
        Route::get('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'Sys\RoleController@permissions']);
        Route::post('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'Sys\RoleController@storePermissions']);
        //权限管理
        Route::resource('permission', 'Sys\PermissionController',['as'=>'admin']);
        Route::post('permission/destroyall',['as'=>'admin.permission.destroy.all','uses'=>'Sys\PermissionController@destroyAll']);
        
        //登录日志
        Route::get('loginlog/index',['as'=>'admin.loginlog.index','uses'=>'Sys\LoginlogController@index']);
        //操作日志
        Route::get('operationlog/index',['as'=>'admin.operationlog.index','uses'=>'Sys\OperationlogController@index']);



        Route::resource('product','ProductController',['as'=>'admin']);

    });
});




