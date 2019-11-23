<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\BoosterProjet;
use App\BoosterList;

class BoosterpController extends Controller
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
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $this->validate($request, [
   			 'forfait' => 'required'
   		]);
   		$id = $id/1000;
   		$user = Auth::user();
   		$check = BoosterProjet::select('id')->where('id_fprojet',$id)->count();
   		if ($check == 1) {
   			$x = $id*1000;
          return redirect('user/freelance-projet/'.$x)->with('info_error', 'Votre demande est déjà en cours de traitement.');
   		}else{
   			$user_id =  $user->id;
	   		$booster_projet = new BoosterProjet;
	   		$booster_projet->id_user = $user_id;
	   		$booster_projet->id_fprojet = $id;
	   		$booster_projet->type_forfait = $request->input('forfait');
	   		$check = BoosterList::select('id')->where('id_user',$user_id)->where('id_fprojet',$id)->count();
	   		if ($check == 1) {
	   			$query = BoosterList::where('id_user',$user_id)->where('id_fprojet',$id)->first();
	   			if ($query->actif == false ) {
	   				if ($booster_projet->type_forfait == 1) {
			   			$data = array(
		   					'unite' => ($query->unite*0)+1
		   				);
			   		}elseif ($booster_projet->type_forfait == 2) {
			   			$data = array(
		   					'unite' => ($query->unite*0)+2
		   				);
			   		}
					$update = BoosterList::where('id_user',$user_id)->where('id_fprojet',$id)->update($data);
					if ($update) {
						$x = $id*1000;
						return redirect('user/freelance-projet/'.$x)->with('info', 'Votre requette a été enregistré avec succès! Vous allez recevoir un mail ou un appel pour confirmation dans les plus brefs délai.');
					}
	   			}else{
	   				$x = $id*1000;
		          return redirect('user/freelance-projet/'.$x)->with('info_error', 'Vous avez déjà souscrit à un forfait! Le forfait en cours doit finir avant de le renouveler merci.');
	   			}
	   			
	   		}else{	   			
	   			  	$boost_list = new BoosterList;
			   		$boost_list->id_user = $user_id;
			   		$boost_list->id_fprojet = $id;
			   		$boost_list->type_forfait = $request->input('forfait');
			   		if ($boost_list->type_forfait == 1) {
			   			$boost_list->unite = 1;
			   		}elseif ($boost_list->type_forfait == 2) {
			   			$boost_list->unite = 2;
			   		}
			   		$boost_list->debut = "2019-10-07";
			   		$boost_list->fin = "2019-10-07";
			   		$boost_list->actif = false;
			   		if ($booster_projet->save() && $boost_list->save()) {
			   			 $x = $id*1000;
		          		return redirect('user/freelance-projet/'.$x)->with('info', 'Votre requette a été enregistré avec succès! Vous allez recevoir un mail ou un appel pour confirmation dans les plus brefs délai.');
			   		}
		   			
	   		}
	   		
	   	}

    }
    

}
