<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\FreelanceProjet;
use App\Manifestation;
use App\Experience;
use App\Workspace;
use App\User;
use App\Observation;

class GestionprojetController extends Controller
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

    public function index($id){
    	$id = $id/1000;
    	$freelance_projet = FreelanceProjet::select('id_fprojet')->where('id_fprojet', $id)->count();
    	if ($freelance_projet == 1) {
	    	$manifestations = "";
			$check_manif = Manifestation::select('id_manifestation')->where('id_fprojet',$id)->count();
	            if ($check_manif>0) {
	                $manifestations = Manifestation::join('users','users.id','=','manifestations.id_user')
	                                    ->join('freelance_projets','freelance_projets.id_fprojet','=','manifestations.id_fprojet')
	                                    ->select(
	                                    'manifestations.id_manifestation',
	                                    'manifestations.id_fprojet',
	                                    'manifestations.id_user',
	                                    'manifestations.selectionne',
	                                    'manifestations.valider',
	                                    'manifestations.created_at',
	                                    'users.id',
	                                    'users.name',
	                                    'users.profession',
	                                    'users.avatar',
	                                    'freelance_projets.id_fprojet'
	                                )
	                                ->where('manifestations.id_fprojet',$id)
	                                ->orderBy('manifestations.id_manifestation','asc')
	                                ->get();
	            }
	    	return view('user.gestionProjet',[
	    				'manifestations'=>$manifestations
	    	]);
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'cet projet n\'exsite pas'
    			]);
    	}
    }

    public function selectionner($idu, $idp){
    	$idu = $idu/1000;
    	$idp = $idp/1000;
    	$check_manif = Manifestation::select('id_manifestation')
    								->where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->count();
    	if ($check_manif==1) {
    		$data = array(
    			'selectionne' => true
    		);

    		$update = Manifestation::where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->update($data);
    		if ($update) {
    			$x = $idp*1000;
    			return redirect('user/gestion-projet/'.$x)->with('info', 'Candidat sélectionné avec succès!');
    		}
    	}

    }

    public function deSelectionner($idu, $idp){
    	$idu = $idu/1000;
    	$idp = $idp/1000;
    	$check_manif = Manifestation::select('id_manifestation')
    								->where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->count();
    	if ($check_manif==1) {
    		$manif = Manifestation::where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->first();
    		if ($manif->valider == true) {
    			$data = array(
    			'selectionne' => false,
    			'valider' => false
    			);

    			$data_exp = array(
    				'selectionne' => false,
    				'id_workspace' => 0
    			);

    			$exp = Experience::where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->update($data_exp);
    		}else{
    			$data = array(
    			'selectionne' => false
    			);
    		}
    		

    		$update = Manifestation::where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->update($data);
    		if ($update) {
    			$x = $idp*1000;
    			return redirect('user/gestion-projet/'.$x)->with('info', 'sélection du candidat annulée avec succès!');
    		}
    	}
    }

    public function accepteJob($idu, $idp){
    	$idu = $idu/1000;
    	$idp = $idp/1000;
    	$check_manif = Manifestation::select('id_manifestation')
    								->where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->count();
    	if ($check_manif==1) {
    		$data = array(
    			'valider' => true
    		);

    		$update = Manifestation::where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->update($data);
    		$data_exp = array(
    			'selectionne' => true
    		);
    		$update_exp = Experience::where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->update($data_exp);
    		$check_user = Experience::select('id_experience')
    								->where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->count();
    		if ($check_user == 1) {
    			$check_ws = Workspace::select('id')->where('id_fprojet',$idp)->count();
	    		if ($check_ws == 0) {
	    			$workspace = new Workspace;
	    			$workspace->id_fprojet = $idp;
	    			$workspace->debut = NOW();
	    			$workspace->fin = NOW();
		    		$workspace->save();
		    		$ws_user = Experience::where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->first();
	    			$data = array(
	    				'id_workspace' => $workspace->id
	    			);

	    			$update_wk = Experience::where('id_fprojet',$idp)
		    								->where('id_user',$idu)
		    								->update($data);
	    		}else{
	    			$ws = Workspace::where('id_fprojet',$idp)->first();
	    			$ws_user = Experience::where('id_fprojet',$idp)
    								->where('id_user',$idu)
    								->first();
	    			$data = array(
	    				'id_workspace' => $ws->id
	    			);

	    			$update_wk = Experience::where('id_fprojet',$idp)
		    								->where('id_user',$idu)
		    								->update($data);
	    		}
    		
    		}
    		
    		if ($update && $update_exp) {
    			$x = $idp*1000;
    			return redirect('user/workspace/'.$x)->with('welcome', 'Hello bienvenu dans le workspace. c\'est ici que vous allez travailler ensemble avec le chef projet.');
    		}
    	}
    }

    public function endProjet($idp, $idw){
        $id = $idp/1000;
        $freelance_projet = FreelanceProjet::select('id_fprojet')->where('id_fprojet', $id)->count();
        if ($freelance_projet == 1) {
            $manifestations = "";
            $check_manif = Manifestation::select('id_manifestation')->where('id_fprojet',$id)->count();
                if ($check_manif>0) {
                    $manifestations = Manifestation::join('users','users.id','=','manifestations.id_user')
                                        ->join('freelance_projets','freelance_projets.id_fprojet','=','manifestations.id_fprojet')
                                        ->select(
                                        'manifestations.id_manifestation',
                                        'manifestations.id_fprojet',
                                        'manifestations.id_user',
                                        'manifestations.selectionne',
                                        'manifestations.valider',
                                        'manifestations.created_at',
                                        'users.id',
                                        'users.name',
                                        'users.profession',
                                        'users.avatar',
                                        'freelance_projets.id_fprojet'
                                    )
                                    ->where('manifestations.id_fprojet',$id)
                                    ->orderBy('manifestations.id_manifestation','asc')
                                    ->get();
                }
            $observations = Observation::all();
            return view('user.endProjet',[
                        'manifestations'=>$manifestations,
                        'observations'=>$observations,
                        'idw'=>$idw,
                        'idp'=>$idp
            ]);
        }else{
            return view('user.error',
                [
                 'error' => true,
                 'message' => 'cet projet n\'exsite pas'
                ]);
        }
    }

    public function theEnd($idp, $idw){
            $idp = $idp/1000;
            $fprojet = "";
            $check = FreelanceProjet::select('id_fprojet')
                                    ->where('id_fprojet',$idp)
                                    ->count();
            
            if ($check == 1) {
                $data = array(
                    'etat' => 1
                );

                $update = FreelanceProjet::where('id_fprojet',$idp)->update($data);

                if ($update) {
                    return redirect('user/home')->with('info','Projet terminé avec succès. Notre équipe vous contactera dans les plus brefs délais pour les finalisations merci.');
                }
            }
    }
}
