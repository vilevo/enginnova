<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Experience;
use App\Manifestation;
use App\Note;
use App\Observation;
use App\FreelanceProjet;
use App\Cv;

class ParcoursController extends Controller
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
    
    public function index($id)
    {

    }

    public function postuler($id)
    {
    	$id = $id/1000;
    	$user = Auth::user();
   		$user_id =  $user->id;
        $x = $id*1000;
    	$manifestater = new Manifestation;
        $experience = new Experience;
    	$check = FreelanceProjet::select('id_fprojet')->where('id_fprojet', $id)->count();
    	if ($check == 1) {
            $check_manifestation = Manifestation::select('id_manifestation')->where('id_fprojet', $id)
                                                    ->where('id_user', $user_id)
                                                    ->count();
            $check_experience = Experience::select('id_experience')->where('id_user', $id)
                                                    ->where('id_fprojet', $user_id)
                                                    ->count();

            $check_cv = Cv::select('id_cv')->where('id_user',$user_id)->count();

            if ($check_manifestation == 0 && $check_experience == 0) {
                if($check_cv == 0)
                {
                    $manifestater->id_fprojet = $id;
                    $manifestater->id_user = $user_id;
                    $manifestater->selectionne = false;
                    $manifestater->valider = false;
                    $experience->id_user = $user_id;
                    $experience->id_fprojet = $id;
                    $experience->selectionne = false;
                    $experience->projet_traite = false;
                    $experience->id_observation = 0;
                    $experience->id_workspace = 0;
                    if ($manifestater->save() && $experience->save()) {
                        $projet = FreelanceProjet::select('reponses')->where('id_fprojet', $id)->first();
                        $data = array(
                        'reponses' => $projet->reponses+1
                        );
                        $update = FreelanceProjet::where('id_fprojet', $id)->update($data); 
                        if ($update) {
                            return redirect('user/freelance-projet/'.$x)->with('info', 'Votre candidature a été enregistrée avec succès! Le chef projet vous contactera bientot. d\'ici là vous pouvez vérifier l\'état de votre demande dans le menu parcours');
                        }
                    }
            }else{
                return redirect('user/freelance-projet/'.$x)->with('info_error', 'Veuillez mettre à jour votre cv dans le menu profil avant de déposer une candidature pour cet projet SVP!');
            }
            }else{
               return redirect('user/freelance-projet/'.$x)->with('info_error', 'Vous avez déjà déposer une candidature pour cet projet!');
            }
    		
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'cet projet n\'exsite pas'
    			]);
    	}

    }

    public function deleteCandidature($id){
        $id = $id/1000;
        $user = Auth::user();
        $user_id =  $user->id;
        $x = $id*1000;
        $check = FreelanceProjet::select('id_fprojet')->where('id_fprojet', $id)->count();
        if ($check == 1) {
            $check_manifestation = Manifestation::select('id_manifestation')->where('id_fprojet', $id)
                                                    ->where('id_user', $user_id)
                                                    ->count();
            $check_experience = Experience::select('id_experience')->where('id_user', $id)
                                                    ->where('id_fprojet', $user_id)
                                                    ->count();
            if ($check_manifestation == 1 && $check_experience == 1) {
                    $delete_manifestation = Manifestation::where('id_fprojet', $id)
                                                    ->where('id_user', $user_id)
                                                    ->delete();
                    $delete_experience = Experience::where('id_user', $id)
                                                    ->where('id_fprojet', $user_id)
                                                    ->delete();
                    if ($delete_manifestation && $delete_experience) {
                        $projet = FreelanceProjet::select('reponses')->where('id_fprojet', $id)->first();
                        $data = array(
                        'reponses' => $projet->reponses-1
                        );
                        $update = FreelanceProjet::where('id_fprojet', $id)->update($data); 
                        if ($update) {
                            return redirect('user/freelance-projet/'.$x)->with('info', 'Votre candidature a été supprimée avec succès!');
                        }

                    }
            }else{
                 return redirect('user/freelance-projet/'.$x)->with('info_error', 'Action impossible!');
            }
            
        }else{
            return view('user.error',
                [
                 'error' => true,
                 'message' => 'cet projet n\'exsite pas'
                ]);
        }
    }

}
