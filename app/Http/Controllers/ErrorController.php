<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function post_not_found(){
    	return view('user.error');
    }
}
