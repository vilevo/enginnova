<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\LearnPro;

class LearnproController extends Controller
{
    public function index(){
    	return view('visiteurs.LearningProgramPro');
    }

     public function create(Request $request){
    	$this->validate($request,[
    		'nom' => 'required|string',
    		'numero' => 'required|string',
    		'email' => 'required|string|email|max:255',
    		'module' => 'required|string'
    	]);

    	$ls = new LearnPro;
    	$check = LearnPro::select('id')
    							->where('numero',$request->input('numero'))
    							->where('email',$request->input('email'))
    							->count();
    	if ($check == 1) {
    		return redirect("formation-inscription/Learning-program-pro")->with('info_error','Inscription non validée. Vous etes déjà inscris...');
    	}else{
    		$ls->nom = $request->input('nom');
	    	$ls->numero = $request->input('numero');
	    	$ls->email = $request->input('email');
	    	$ls->module = $request->input('module');

	    	if ($ls->save()) {
	    		return redirect("formation-inscription/Learning-program-pro")->with('info','Inscription validée. Nous vous contacterons dans les plus brefs délais pour les autres formalités...');
	    	}
    	}
    }
}
