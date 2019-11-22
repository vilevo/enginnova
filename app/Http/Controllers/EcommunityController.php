<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcommunityController extends Controller
{
    public function index(){
    	return view('visiteurs.enginnovaCommunity');
    }
}
