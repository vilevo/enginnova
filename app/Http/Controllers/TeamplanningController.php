<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Teamplanning;
use App\Workspace;

class TeamplanningController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function planningAdd(Request $request, $id){
    	$check_ws = Workspace::select('id')->where('id',$id)->count();
    	if($check_ws == 1){
    		$fprojet = Workspace::where('id',$id)->first();
	    	$this->validate($request, [
	   			 'titre' => 'bail|required|min:5',
	   			 'debut' => 'required',
	   			 'fin' => 'required'
	   			]);
	    	$teamplanning = new Teamplanning;
	    	$teamplanning->titre = $request->input('titre');
	    	$teamplanning->id_fprojet = $fprojet->id_fprojet;
	    	$teamplanning->id_workspace = $fprojet->id;
	    	$teamplanning->valider = false;
	    	$teamplanning->debut = $request->input('debut');
	    	$teamplanning->fin = $request->input('fin');
	    	if ($teamplanning->save()) {
	    		$x = $fprojet->id_fprojet*1000;
	    		return redirect('user/workspace/'.$x)->with('info_p', 'Tache ajoutée au planning avec succès!');
	    	}
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'Oops! une erreur s\'est produite , veuillez réessayer SVP!'
    			]);
    	}
    }

    public function tacheFaite($idt,$idp){
    	$idp = $idp*1000;
    	$check_tache = Teamplanning::select('id')->where('id',$idt)->count();
    	if ($check_tache==1) {
    		$data = array(
    			'valider' => true
    		);
    		$update = Teamplanning::where('id',$idt)->update($data);
    		if ($update) {
    			return redirect('user/workspace/'.$idp);
    		}
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'Oops! une erreur s\'est produite , veuillez réessayer SVP!'
    			]);
    	}
    }

    public function destroy($idt,$idp){
    	$idp = $idp*1000;
    	$check_tache = Teamplanning::select('id')->where('idt',$idt)->count();
    	if ($check_tache==1) {
    		$delete = Teamplanning::where('id',$idt)->delete();
    		if ($delete) {
    			return redirect('user/workspace/'.$idp);
    		}
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'Oops! une erreur s\'est produite , veuillez réessayer SVP!'
    			]);
    	}
    }
}
