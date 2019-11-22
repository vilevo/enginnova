<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\FreelanceProjet;
use App\Experience;
use App\Observation;

class ObservationController extends Controller
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

    public function update(Request $request){
    	header("Content-Type:application/json");
    	
    	// $this->validate($request, [
    	// 	'observation' => 'required'
    	// ]);
    	
    	if ($request->get('observation') && $request->get('id') && $request->get('idw')) {
    		$observation = $request->get('observation');
    		$idu = $request->get('id');
    		$idw = $request->get('idw');
    		$data = array(
    		'projet_traite' => true,
    		'id_observation' => $observation
	    	);
	    	$update = Experience::where('id_user',$idu)->where('id_workspace',$idw)->update($data);
	    	// if ($update) {
	    	// 	$result = "Votre note a ete enregistre avec succes!"

	    	// 	echo $result;
	    	// }
    	}
    	
    }
}
