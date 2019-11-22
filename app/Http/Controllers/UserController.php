<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\User;
use App\Experience;
use App\Cv;
use App\Note;
use App\Profession;
use App\Categorie;
use App\Post;
use App\Observation;

class UserController extends Controller
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
        $freelance_projets= DB::table('users')
            ->orderBy('name','asc')
            ->get();
        return ['users'=>$users];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'avatar'=> 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100|max:2048'
    	]);
    	$user_id = Auth::user()->id;
    	$avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        $saveAvatar = $request->avatar->move(public_path('avatars'), $avatarName);
        if ($saveAvatar) {
            $check = User::select('avatar')->where('id', $user_id)->first();
            if ($check == "default.png") {
                $data = array(
                'avatar' => $avatarName
                );
                 $data = User::where('id', $user_id)->update($data); 
            }else{
                // $path = asset("avatars/".$check);
                // if (File::exists($path)) {
                //     File::delete($path);
                // }
                $data = array(
                'avatar' => $avatarName
                );
                 $data = User::where('id', $user_id)->update($data); 
            }
        	if ($data) {
                $x = $user_id*1000;
                return redirect('user/profil/'.$x)->with('info_avatar', 'Photo de profil modifiée avec succès!');
            }
        }else{
        	return view('user.profil',
    			[
    			 'error' => true,
    			 'message' => 'Oops une erreur s\'est produite , veuillez reessayer svp!' 
    			]);
        }
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
    	$user = User::select('id')->where('id', $id)->count();
        $questions = "";
        $experiences = "";
        $nbr_projet_traite = 0;
    	if ($user == 1) {
            $user = User::where('id', $id)->first();
            $check_note = Note::select('id_note')->where('id_receiver', $id)->count();
            if ($check_note > 0) {
                $note = $check_note;
            }else{
                $note = 0;
            }
            $check_exp = Experience::select('id_experience')
                                    ->where('id_user',$id)
                                    ->where('selectionne',true)
                                    ->count();
            if ($check_exp > 0) {
                $experiences= Experience::join('freelance_projets','freelance_projets.id_fprojet','=','experiences.id_fprojet')
                ->join('observations','observations.id_observation','=','experiences.id_observation')
                ->select(
                    'experiences.id_experience',
                    'experiences.id_user',
                    'experiences.id_fprojet',
                    'experiences.selectionne',
                    'experiences.projet_traite',
                    'experiences.id_observation',
                    'experiences.created_at',
                    'observations.name',
                    'freelance_projets.id_fprojet',
                    'freelance_projets.titre_projet',
                    'freelance_projets.id_user',
                    'freelance_projets.etat'
                )
                ->where('experiences.id_user',$id)
                ->where('experiences.selectionne',true)
                ->where('freelance_projets.etat',true)
                ->orderBy('experiences.id_experience','desc')
                ->get();

                $nbr_projet_traite = Experience::where('projet_traite', true)
                                                ->where('id_user',$id)
                                                ->count();
            }

            $check_cv = Cv::select('id_cv')->where('id_user',$id)->count();
            if ($check_cv == 1) {
                $cv = Cv::where('actif',true)
                        ->where('id_user',$id)
                        ->first();
            }else{
                $cv =false;
            }
            $professions = Profession::all();
            $categories = Categorie::all();
            $check_questions = Post::select('id_post')->where('id_user',$id)->count();
            if ($check_questions>0) {
                $questions = Post::where('id_user',$id)->orderBy('id_post','desc')->paginate(2);
            }
                return view('user.profil', 
                    [
                     'error' => false,
                     'user'=>$user,
                     'note'=>$note,
                     'experiences'=>$experiences,
                     'questions'=>$questions,
                     'cv'=>$cv,
                     'nbr_projet_traite'=>$nbr_projet_traite,
                     'point_total'=>$note+$nbr_projet_traite,
                     'professions'=>$professions,
                     'categories'=>$categories    
                    ]);
       		 
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'Cet utilisateur n\'existe pas! Veuillez reessayer SVP!'
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
   			 'name' => 'bail|required|min:5',
   			 'email' => 'required',
   			 'telephone' => 'required',
             'profession' => 'required',
   			 'competences' => 'required',
   			 'ville' => 'required',
   			 'adresse' => 'required',
   			 'description' => 'required'
   		]);
   		$data = array(
   			'name' => $request->input('name'),
   			'email' => $request->input('email'),
   			'telephone' => $request->input('telephone'),
            'profession' => $request->input('profession'),
            'competences' => $request->input('competences'),
            'ville' => $request->input('ville'),
            'adresse' => $request->input('adresse'),
            'description' => $request->input('description')
   		);
   		
   		$check = User::select('id')->where('id', $id)->count();
   		if ($check == 1) {
   			$update = User::where('id', $id)->update($data);
            if ($update) {
                $x = $id*1000;
                return redirect('user/profil/'.$x)->with('info', 'Vos infos perso ont été modifiée avec succès!');
            }
   		}else{
   			return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'cet utilisateur n\'exsite pas'
    			]);	
   		}
   		
    }

}
