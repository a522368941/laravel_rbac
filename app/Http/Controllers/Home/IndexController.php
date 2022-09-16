<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Auth;
class IndexController  extends Controller
{
    public function index(){
    	
    	
    	return view('home.index.index');
    }
   
}
