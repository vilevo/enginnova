<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Categorie;
use App\FreelanceProjet;
use App\Manifestation;
use App\Cv;
use App\BoosterList;
use App\BoosterForfait;
use App\Post;
use App\Experience;
use App\Astuce;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();
        $user_id =  $user->id;
        $best_projets = "";
        $user_projets = "";
        $notif_selections = "";
        $wp_projets = "";
        $astuces = "";
        $check_cv = Cv::select('id_cv')->where('id_user', $user_id)->count();
        $check_selection = Manifestation::select('id_manifestation')
                                        ->where('id_user',$user_id)
                                        ->where('selectionne',true)
                                        ->where('valider',false)
                                        ->count();
        $categories = Categorie::all();
        $users = User::all();
        if ($check_cv == 0) {
            $notif_cv = "Veuillez mettre en ligne votre CV pour pouvoir postuler aux projets freelance.";
            $user_id = $user_id;
        }else{
            $notif_cv=false;
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
        $check_up = FreelanceProjet::select('id_fprojet')->where('id_user',$user_id)->count();
        if ($check_up>0) {
            $user_projets = FreelanceProjet::where('id_user',$user_id)->get();
        }
        $forfaits = BoosterForfait::all();
        if ($check_selection>0) {
            $notif_selections = Manifestation::join('freelance_projets','freelance_projets.id_fprojet','=','manifestations.id_fprojet')
                                    ->select(
                                    'manifestations.id_manifestation',
                                    'manifestations.id_user',
                                    'manifestations.selectionne',
                                    'manifestations.valider',
                                    'freelance_projets.id_fprojet',
                                    'freelance_projets.titre_projet',
                                )
                                ->where('manifestations.id_user',$user_id)
                                ->where('manifestations.selectionne',true)
                                ->where('manifestations.valider',false)
                                ->orderBy('manifestations.id_manifestation','asc')
                                ->get();
        }
        $check_wp = Experience::select('id_experience')
                                ->where('id_user',$user_id)
                                ->where('selectionne',true)
                                ->count();
        if ($check_wp > 0) {
            $wp_projets = Experience::join('freelance_projets','freelance_projets.id_fprojet','=','experiences.id_fprojet')
                                    ->select(
                                    'experiences.id_experience',
                                    'experiences.id_user',
                                    'experiences.id_fprojet',
                                    'experiences.selectionne',
                                    'experiences.projet_traite',
                                    'experiences.created_at',
                                    'freelance_projets.id_fprojet',
                                    'freelance_projets.titre_projet',
                                    'freelance_projets.etat'
                                )
                                ->where('experiences.id_user',$user_id)
                                ->where('experiences.selectionne',true)
                                ->orderBy('experiences.id_experience','desc')
                                ->get();
        }

        if (Astuce::select('id')->count() > 0) {
             $astuces = Astuce::paginate(2);
        }
        return view('user.home', [
            'notif_cv'=>$notif_cv,
            'id_user'=>$user_id,
            'categories'=>$categories,
            'best_projets'=>$best_projets,
            'user_projets'=>$user_projets,
            'forfaits'=>$forfaits,
            'notif_selections'=>$notif_selections,
            'wp_projets'=>$wp_projets,
            'astuces'=>$astuces,
            'users'=>$users
        ]);
    }

    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('posts')
                        ->where('titre_post','LIKE','%'.$query.'%')
                        ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;">';
            foreach ($data as $row) {
                $row->id_post = $row->id_post*1000;
                $output .= '<li><a href="http://localhost/ec/public/user/question/'.$row->id_post.'">'.$row->titre_post.'</a></li>';
            }
            $output .='</ul>';
            echo $output;
        }
    }

    public function add_post()
    {
        $categories = Categorie::all();
        return view('user.addPost', ['categories'=>$categories]);
    }

    public function add_projet()
    {   
        $categories = Categorie::all();
        return view('user.addProjet', ['categories'=>$categories]);
    }

    public function add_projet_benevolat()
    {   
        $categories = Categorie::all();
        return view('user.addProjetBenevolat', ['categories'=>$categories]);
    }

}
