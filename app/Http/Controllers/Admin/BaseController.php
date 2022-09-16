<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;


class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');

      
    }

    
}
