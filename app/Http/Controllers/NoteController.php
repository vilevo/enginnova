<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Note;
use App\Commentaire;

class NoteController extends Controller
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
    
    public function like($idc,$idu,$id){
      $idc = $idc/1000;
      $idu = $idu/1000;
      $check_idc = Commentaire::select('id_commentaire')->where('id_commentaire', $idc)->count();
      if ($check_idc == 1) {
            $note = new Note;
            $user = Auth::user();
   			    $user_id =  $user->id;
            $query = Commentaire::where('id_commentaire',$idc)->first();
            $check_note = Note::select('id_note')
            ->where('id_sender', $user_id)
            ->where('id_commentaire', $idc)
            ->count();
            if ($check_note == 1) {
            	 return redirect('user/question/'.$id)->with('info_error', 'Vous avez déjà voter pour cette réponse!'); 
            }else{
            	$note->id_commentaire = $idc;
            	$note->id_sender = $user_id;
            	$note->id_receiver = $idu;
            	if ($note->save()) {
                 $data = array(
                    'count_vote' =>$query->count_vote+1
                  );
                $update_vote = Commentaire::where('id_commentaire',$idc)->update($data);
                if ($update_vote) {
                  return redirect('user/question/'.$id)->with('info', 'Votre vote a été enregistré avec succès!');
                }
            	}
            }        
          
      }else{
        return redirect('user/question/'.$id)->with('info_error', 'Oops! Une erreur s\'est produite veuillez reessayer SVP!');
      }
    }

    public function unlike($idc,$idu){
      $idc = $idc/1000;
      $idu = $idu/1000;
      $check_idc = Commentaire::select('id_commentaire')->where('id_commentaire', $idc)->count();
      if ($check_idc == 1) {
            $user = Auth::user();
   			    $user_id =  $user->id;
            $query = Commentaire::where('id_commentaire',$idc)->first();
            $check_note = Note::select('id_note')
            ->where('id_sender', $user_id)
            ->where('id_commentaire', $idc)
            ->count();
            if ($check_note == 1) {
               Note::where('id_sender',$user_id)
                    ->where('id_commentaire',$idc)->delete();
            	 $data = array(
                    'count_vote' =>$query->count_vote-1
                  );
                $update_vote = Commentaire::where('id_commentaire',$idc)->update($data);
            	if ($update_vote) {
            		return view('user.error',
				          [
				           'error' => true,
				           'message' => 'Votre vote a été supprimé avec succès!'
				          ]);
            	}
            }else{
            	return view('user.error',
			          [
			           'error' => true,
			           'message' => 'Oops! Une erreur s\'est produite veuillez reessayer SVP!'
			          ]);
            }            
      }else{
        return view('user.error',
          [
           'error' => true,
           'message' => 'Oops! Une erreur s\'est produite veuillez reessayer SVP!'
          ]);
      }
    }
}
