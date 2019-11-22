<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\FreelanceProjet;
use App\Categorie;
use App\BoosterForfait;
use App\BoosterList;
use App\Manifestation;
use App\Astuce;

class FreelanceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = FreelanceProjet::all()->count();
        $best_projets = "";
        $astuces = "";
        if ($check > 0) {
            $freelance_projets= DB::table('freelance_projets')
            ->join('users','users.id','=','freelance_projets.id_user')
            ->select(
                'freelance_projets.id_fprojet',
                'freelance_projets.titre_projet',
                'freelance_projets.contenu',
                'freelance_projets.id_user',
                'freelance_projets.reponses',
                'freelance_projets.etat',
                'freelance_projets.categorie',
                'freelance_projets.prix',
                'freelance_projets.created_at',
                'users.name',
                'users.avatar'
                )
            ->where('actif', true)
            ->orderBy('freelance_projets.id_fprojet','desc')
            ->paginate(2);
            $categories = Categorie::all();
            $projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')->count();
            if ($projets>0) {
              $best_projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')
                                    ->select(
                                        'booster_lists.id_fprojet',
                                        'booster_lists.actif',
                                        'freelance_projets.titre_projet',
                                        'freelance_projets.prix'
                                      )
                                    ->where('booster_lists.actif',true)
                                    ->orderBy('id','desc')->paginate(4);
            }
            if (Astuce::select('id')->count() > 0) {
             $astuces = Astuce::paginate(2);
            }
            return view('user.freelance', 
                [
                 'freelance_projets'=>$freelance_projets,
                 'categories'=>$categories,
                 'best_projets'=>$best_projets,
                 'astuces'=>$astuces
            ]);
        }else{
            return view('user.error',
                [
                 'error' => true,
                 'message' => 'Aucun projet n\'est disponible pour le moment'
                ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
   			 'titre_projet' => 'bail|required|min:5',
             'prix'=>'required',
   			 'contenu' => 'required',
   			 'categorie' => 'required'
   		]);
   		$user = Auth::user();
   		$user_id =  $user->id;
   		$freelance_projet = new FreelanceProjet;
   		$freelance_projet->titre_projet = $request->input('titre_projet');
        $freelance_projet->prix = $request->input('prix');
   		$freelance_projet->contenu = $request->input('contenu');
   		$freelance_projet->id_user = $user_id;
   		$freelance_projet->reponses = 0;
   		$freelance_projet->etat = 0;
   		$freelance_projet->categorie = $request->input('categorie');
        $freelance_projet->actif = false;
        $freelance_projet->booster = 0;
        if ($freelance_projet->save()) {
            return redirect('user/freelance')->with('info', 'Votre projet a été enregistré avec succés! Notre équipe est entrain de l\'étudier. La confirmation vous sera envoyée d\'ici 48h par mail merci.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$id = $id/1000;
        $best_projets = "";
        $projets_similaires = "";
        $astuces = "";
    	$freelance_projet = FreelanceProjet::select('id_fprojet')->where('id_fprojet', $id)->count();
    	if ($freelance_projet == 1) {
    		$freelance_projet= DB::table('freelance_projets')
            ->join('users','users.id','=','freelance_projets.id_user')
            ->select(
            	'freelance_projets.id_fprojet',
            	'freelance_projets.titre_projet',
            	'freelance_projets.contenu',
            	'freelance_projets.id_user',
            	'freelance_projets.reponses',
            	'freelance_projets.etat',
            	'freelance_projets.categorie',
                'freelance_projets.prix',
            	'freelance_projets.created_at',
            	'users.id',
            	'users.name',
            	'users.avatar'
            	)->where(
            		'freelance_projets.id_fprojet',$id
            	)->first();

       		 $manifestations=DB::table('manifestations')
        	->select(
        		'manifestations.id_manifestation',
        		'manifestations.id_fprojet',
        		'manifestations.id_user',
        		'manifestations.created_at',
        		'freelance_projets.id_fprojet'
            )
        	->join('users','users.id','=','manifestations.id_user')
            ->join('freelance_projets','freelance_projets.id_fprojet','=','manifestations.id_fprojet')
            ->where('manifestations.id_fprojet',$id)->get();
            $categories = Categorie::all();
            $titre= $freelance_projet->titre_projet;
            $cat = $freelance_projet->categorie;
            $check_projets = FreelanceProjet::where('categorie',$cat)
                                          ->where('actif',true)
                                          ->count();
            if ($check_projets>0) {
                 $projets_similaires = FreelanceProjet::where('categorie',$cat)
                                          ->where('actif',true)
                                          ->paginate(5); 
             }  
            $forfaits = BoosterForfait::all();
            $projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')->count();
            if ($projets>0) {
              $best_projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')
                                    ->select(
                                        'booster_lists.id_fprojet',
                                        'booster_lists.actif',
                                        'freelance_projets.titre_projet',
                                        'freelance_projets.prix'
                                      )
                                    ->where('booster_lists.actif',true)
                                    ->orderBy('id','desc')->paginate(4);
            }
            if (Astuce::select('id')->count() > 0) {
             $astuces = Astuce::paginate(2);
            }
            return view('user.freelanceProjet', 
        	[
        	 'error' => false,
        	 'freelance_projet'=>$freelance_projet,
        	 'manifestations'=>$manifestations,
             'categories'=>$categories,
             'projets_similaires'=>$projets_similaires,
             'forfaits'=>$forfaits,
             'best_projets'=>$best_projets,
             'astuces'=>$astuces	 
        	]);
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'cet projet n\'exsite pas'
    			]);
    	}


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = $id/1000;
        $check = FreelanceProjet::select('id_fprojet')->where('id_fprojet', $id)->count();
        $manifestations = "";
        if ($check == 1) {
            $forfaits = BoosterForfait::all();
        	$categories = Categorie::all();
            $freelance_projet =  FreelanceProjet::where('id_fprojet', $id)->first();
            $categorie_projet = Categorie::where('id_categorie',$freelance_projet->categorie)->first();
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
	        return view('user.editProjet', [
	        	'freelance_projet'=>$freelance_projet,
	        	'categories'=>$categories,
                'categorie_projet'=>$categorie_projet,
                'forfaits'=>$forfaits,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$id = $id/1000;
        $this->validate($request, [
   			 'titre_projet' => 'bail|required|min:5',
             'prix' => 'required',
   			 'contenu' => 'required',
   			 'categorie' => 'required'
   		]);
   		$data = array(
   			'titre_projet' => $request->input('titre_projet'),
            'prix' => $request->input('prix'),
   			'contenu' => $request->input('contenu'),
   			'categorie' => $request->input('categorie')
   		);
   		$check = FreelanceProjet::select('id_fprojet')->where('id_fprojet', $id)->count();
   		if ($check == 1) {
   			$update = FreelanceProjet::where('id_fprojet', $id)->update($data);
            if ($update) {
                $x = $id*1000;
                return redirect('user/freelance-projet/'.$x)->with('info', 'Projet modifié avec succès!');
            }
   		}else{
   			return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'cet projet n\'exsite pas'
    			]);	
   		}
   		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = $id/1000;
        $check = FreelanceProjet::select('id_fprojet')->where('id_fprojet', $id)->count();
   		if ($check == 1) {
   			$delete = FreelanceProjet::where('id_fprojet', $id)->delete();
            if ($delete) {
                $check = BoosterList::select('id')->where('id_fprojet',$id)->count();
                if ($check==1) {
                    BoosterList::where('id_fprojet',$id)->delete();
                }
                return redirect('user/freelance')->with('info', 'Projet supprimé avec succès!');
            }
   		}else{
   			return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'Oops! Une erreur s\'est produite veuillez reessayer SVP!'
    			]);	
   		}
    }

    public function bestProjet(){
        $projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')->count();
        if ($projets > 0) {
            $freelance_projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')
                                    ->select(
                                        'booster_lists.id_fprojet',
                                        'booster_lists.actif',
                                        'freelance_projets.id_fprojet',
                                        'freelance_projets.titre_projet',
                                        'freelance_projets.contenu',
                                        'freelance_projets.id_user',
                                        'freelance_projets.reponses',
                                        'freelance_projets.etat',
                                        'freelance_projets.categorie',
                                        'freelance_projets.prix',
                                        'freelance_projets.created_at'
                                      )
                                    ->where('booster_lists.actif',true)
                                    ->orderBy('id','desc')->paginate(4);
            $categories = Categorie::paginate(5);
            
            return view('user.bestProjets', 
                [
                 'freelance_projets'=>$freelance_projets,
                 'categories'=>$categories
            ]);
        }else{
            return view('user.error',
                [
                 'error' => true,
                 'message' => 'Aucun projet n\'est disponible pour le moment'
                ]);
        }
    }

    public function categorie($id){
        $id = $id/1000;
        $best_projets = "";
        $astuces = "";
        $check = Categorie::select('id_categorie')->where('id_categorie',$id)->count();
        if ($check > 0) {
            $freelance_projets= DB::table('freelance_projets')
            ->join('users','users.id','=','freelance_projets.id_user')
            ->select(
                'freelance_projets.id_fprojet',
                'freelance_projets.titre_projet',
                'freelance_projets.contenu',
                'freelance_projets.id_user',
                'freelance_projets.reponses',
                'freelance_projets.etat',
                'freelance_projets.categorie',
                'freelance_projets.prix',
                'freelance_projets.created_at',
                'users.name',
                'users.avatar'
                )
            ->where('actif', true)
            ->where('categorie',$id)
            ->orderBy('freelance_projets.id_fprojet','desc')
            ->paginate(2);
            $categories = Categorie::all();
            $projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')->count();
            if ($projets>0) {
              $best_projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')
                                    ->select(
                                        'booster_lists.id_fprojet',
                                        'booster_lists.actif',
                                        'freelance_projets.titre_projet',
                                        'freelance_projets.prix'
                                      )
                                    ->where('booster_lists.actif',true)
                                    ->orderBy('id','desc')->paginate(4);
            }
            if (Astuce::select('id')->count() > 0) {
             $astuces = Astuce::paginate(2);
            }
            return view('user.categorieProjet', 
                [
                 'freelance_projets'=>$freelance_projets,
                 'categories'=>$categories,
                 'best_projets'=>$best_projets,
                 'astuces'=>$astuces
            ]);
        }else{
            return view('user.error',
                [
                 'error' => true,
                 'message' => 'Aucun projet n\'est disponible pour le moment'
                ]);
        }
    }

}
