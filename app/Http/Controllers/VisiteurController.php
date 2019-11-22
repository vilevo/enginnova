<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use App\Categorie;
use App\Commentaire;
use App\Note;
use App\FreelanceProjet;
use App\BoosterList;
use App\BoosterForfait;
use App\GestionSlide;
use App\GestionActivite;
use App\Astuce;

class VisiteurController extends Controller
{
    public function index(){
      $slides = "";
      $activites = "";
      $check_slide = GestionSlide::select('id')->count();
      $check_activite = GestionActivite::select('id')->count();
      $questions = Post::select('id_post')->count();
      $users = User::select('id')->count();
      $projets_freelances = FreelanceProjet::select('id_fprojet')->count();
      if ($check_slide>0) {
        $slides = GestionSlide::all();
      }
      if ($check_activite>0) {
        $activites = GestionActivite::all();
      }
    	return view('visiteurs.acceuil',[
        'slides'=>$slides,
        'activites'=>$activites,
        'questions'=>$questions,
        'users'=>$users,
        'projets_freelances'=>$projets_freelances
      ]);
    }

    public function enginnovaCommunity(){
    	 $check = Post::all()->count();
	        $best_projets = "";
          $astuces = "";
	        $posts= Post::join('users','users.id','=','posts.id_user')
	            ->select(
	            	'posts.id_post',
	            	'posts.titre_post',
	            	'posts.contenu',
	            	'posts.slug',
	            	'posts.counts_commentaires',
	            	'posts.created_at',
	            	'users.id',
	            	'users.name',
	            	'users.avatar'
	            	)
	            ->orderBy('posts.id_post','desc')
	            ->paginate(2);
	        if ($check > 0) {
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
	            $categories = Categorie::all();
              if (Astuce::select('id')->count() > 0) {
              $astuces = Astuce::paginate(2);
              }
	           return view('visiteurs.enginnovaCommunity', 
	            [/*'users'=>$users,*/
	             'posts'=>$posts,
	             'categories'=>$categories,
	             'best_projets'=>$best_projets,
               'astuces'=>$astuces
	             ]);
	        }else{
	          return view('visiteurs.error',
	          [
	           'error' => true,
	           'message' => 'Aucune publication n\'est disponible pour le moment'
	          ]);
	        }
	}

	public function showQuestion($id){
		$id = $id/1000;
      $best_projets = "";
      $questions_similaires = "";
      $astuces = "";
    	$post = Post::select('id_post')->where('id_post', $id)->count();
      $notes = "";
    	if ($post == 1) {
    		$post= DB::table('posts')
            ->join('users','users.id','=','posts.id_user')
            ->select(
            	'posts.id_post',
            	'posts.titre_post',
            	'posts.contenu',
            	'posts.slug',
            	'posts.counts_commentaires',
            	'posts.id_user',
              'posts.id_categorie',
            	'posts.created_at',
            	'users.id',
            	'users.name',
            	'users.avatar'
            	)->where(
            		'posts.id_post',$id
            	)->first();

       		 $commentaires=DB::table('commentaires')
       		 ->join('users','users.id','=','commentaires.id_user')
        	 ->select(
        		'commentaires.id_commentaire',
        		'commentaires.contenu',
        		'commentaires.id_user',
        		'commentaires.id_post',
            'commentaires.count_vote',
        		'commentaires.created_at',
        		'users.id',
        		'users.name',
            'users.avatar'
             )->where('commentaires.id_post',$id)
             ->orderBy('commentaires.id_commentaire','desc')
             ->get();
             $categories = Categorie::paginate(5);
             $cat = $post->id_categorie;
             $check_questions = Post::where('id_categorie',$cat)
                                          ->count();
             if ($check_questions>0) {
                  $questions_similaires = Post::where('id_categorie',$cat)
                                          ->paginate(5);
             }

              $check_note = Note::count();
              if ($check_note>0) {
                 $notes = Note::all();
               }
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
            return view('visiteurs.question', 
            	[
            	 'error' => false,
            	 'post'=>$post,
            	 'commentaires'=>$commentaires,
               'categories'=>$categories,
               'questions_similaires'=>$questions_similaires,
               'notes'=>$notes,
               'best_projets'=>$best_projets,
               'astuces'=>$astuces	 
            	]);
    	}else{
    		return view('visiteurs.error',
    			[
    			 'error' => true,
    			 'message' => 'cet post n\'exsite pas'
    			]);
    	}
	}

	public function freelance(){
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
            return view('visiteurs.freelance', 
                [
                 'freelance_projets'=>$freelance_projets,
                 'categories'=>$categories,
                 'best_projets'=>$best_projets,
                 'astuces'=>$astuces
            ]);
        }else{
            return view('visiteurs.error',
                [
                 'error' => true,
                 'message' => 'Aucun projet n\'est disponible pour le moment'
                ]);
        }
	}

	public function showFprojets($id){
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
            return view('visiteurs.freelanceProjet', 
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
    		return view('visiteurs.error',
    			[
    			 'error' => true,
    			 'message' => 'cet projet n\'exsite pas'
    			]);
    	}
	}

	public function fetchQuestions(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('posts')
                        ->where('titre_post','LIKE','%'.$query.'%')
                        ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;">';
            foreach ($data as $row) {
                $row->id_post = $row->id_post*1000;
                $output .= '<li><a href="http://localhost/ec/public/question/'.$row->id_post.'">'.$row->titre_post.'</a></li>';
            }
            $output .='</ul>';
            echo $output;
        }
    }

    public function formationAdd($type){
      if ($type == "learn-to-code-from-scratch") {
        return view('visiteurs.inscriptionLearn2CodeFromScratch');
      }elseif ($type == "Learning-program-pro") {
        return view('visiteurs.inscriptionLearningpro');
      }
    }

    public function lireActivite($id){
      $best_projets = "";
      $check = GestionActivite::where('id',$id)->count();
      $projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')->count();
      if ($check==1) {
        $activite = GestionActivite::find($id);
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
        $autres_activites = GestionActivite::where('id','!=',$id)->get();
        return view('visiteurs.lireActivite',[
          'activite'=>$activite,
          'best_projets'=>$best_projets,
          'autres_activites'=>$autres_activites
        ]);
      }else{
        return view('visiteurs.error',
          [
           'error' => true,
           'message' => 'Oups une erreur s\'est produite veuillez réessayer SVP!'
          ]);
      }
    }

    public function geeking($id){
      $best_projets = "";
      $check = Astuce::where('id',$id)->count();
      $projets = BoosterList::join('freelance_projets','freelance_projets.id_fprojet','=','booster_lists.id_fprojet')->count();
      if ($check==1) {
        $astuce = Astuce::find($id);
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
        $similaires = Astuce::where('id','!=',$id)->get();
        return view('visiteurs.geeking',[
          'astuce'=>$astuce,
          'best_projets'=>$best_projets,
          'similaires'=>$similaires
        ]);
      }else{
        return view('visiteurs.error',
          [
           'error' => true,
           'message' => 'Oups une erreur s\'est produite veuillez réessayer SVP!'
          ]);
      }
    }
}
