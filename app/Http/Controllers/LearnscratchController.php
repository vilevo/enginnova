<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\LearnScratch;

class LearnscratchController extends Controller
{
    public function index(){
    	return view('visiteurs.learn2CodeFromScratch');
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'nom' => 'required|string',
    		'numero' => 'required|string',
    		'email' => 'required|string|email|max:255',
    		'niveau' => 'required|string'
    	]);

    	$ls = new LearnScratch;
    	$check = LearnScratch::select('id')
    							->where('numero',$request->input('numero'))
    							->where('email',$request->input('email'))
    							->count();
    	if ($check == 1) {
    		return redirect("formation-inscription/learn-to-code-from-scratch")->with('info_error','Inscription non validée. Vous etes déjà inscris...');
    	}else{
    		$ls->nom = $request->input('nom');
	    	$ls->numero = $request->input('numero');
	    	$ls->email = $request->input('email');
	    	$ls->niveau = $request->input('niveau');

	    	if ($ls->save()) {
	    		return redirect("formation-inscription/learn-to-code-from-scratch")->with('info','Inscription validée. Nous vous contacterons dans les plus brefs délais pour les autres formalités...');
	    	}
    	}
    }
}
