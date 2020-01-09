<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\FreelanceProjet;
use App\Categorie;

class ProjetbenevolatController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
   			 'titre_projet' => 'bail|required|min:5',
   			 'contenu' => 'required',
   			 'categorie' => 'required'
   		]);
   		$user = Auth::user();
   		$user_id =  $user->id;
   		$freelance_projet = new FreelanceProjet;
   		$freelance_projet->titre_projet = $request->input('titre_projet');
        $freelance_projet->prix = "gratuit";
   		$freelance_projet->contenu = $request->input('contenu');
   		$freelance_projet->id_user = $user_id;
   		$freelance_projet->reponses = 0;
   		$freelance_projet->etat = 0;
   		$freelance_projet->categorie = $request->input('categorie');
        $freelance_projet->actif = false;
        $freelance_projet->booster = 0;
        $freelance_projet->type = "benevolat";
        if ($freelance_projet->save()) {
            return redirect('user/freelance')->with('info', 'Votre projet a été enregistré avec succés! Notre équipe est entrain de l\'étudier. La confirmation vous sera envoyée d\'ici 48h par mail merci.');
        }
    }
}
