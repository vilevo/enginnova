<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mentor;

class MentorController extends Controller
{
	public function index()
	{
		$mentors = Mentor::paginate(10);
		return view('visiteurs.enginnovaMentors', ['mentors'=>$mentors]);
	}

    public function fetchMentor($id){
    	$check = Mentor::where('id',$id)->count();
    	if ($check==1) {
    		$data = Mentor::where('id',$id)->first();
    		return response($data);
    	}else{
    		$data = array(
    			"statut"=>"404",
    			"error"=>"cet mentor est introuvable"
    		);
    		return response($data);
    	}
    }
}
