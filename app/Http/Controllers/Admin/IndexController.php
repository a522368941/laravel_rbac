<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Auth;
class IndexController  extends Controller
{
    public function index(){
    	
    	$user=Auth::guard('admin')->user();
    	return view('admin.index.index',compact('user'));
    }
    public function home(){
    	$user=Auth::guard('admin')->user();
    	return view('admin.index.home');
    }
}
