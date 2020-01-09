<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use App\Categorie;
use App\Commentaire;
use App\Note;
use App\FreelanceProjet;
use App\BoosterList;
use App\Astuce;

class PostController extends Controller
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
            $users = User::all();
            if (Astuce::select('id')->count() > 0) {
             $astuces = Astuce::paginate(2);
            }
           return view('user.enginnovaCommunity', 
            [/*'users'=>$users,*/
             'posts'=>$posts,
             'categories'=>$categories,
             'best_projets'=>$best_projets,
             'astuces'=>$astuces,
             'users'=>$users
             ]);
        }else{
          return view('user.error',
          [
           'error' => true,
           'message' => 'Aucune publication n\'est disponible pour le moment'
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
   			 'titre_post' => 'bail|required|min:5',
   			 'contenu' => 'required',
   			 'categorie' => 'required'
   		]);
   		$user = Auth::user();
   		$user_id =  $user->id;
   		$posts = new Post;
   		$posts->titre_post = $request->input('titre_post');
   		$posts->contenu = $request->input('contenu');
   		$posts->slug = $request->input('titre_post');
   		$posts->id_user = $user_id;
   		$posts->counts_commentaires = 0;
   		$posts->id_categorie = $request->input('categorie');
   		if ($posts->save()) {
          return redirect('user/enginnova-community')->with('info', 'Votre question a été publiée avec succès!');
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
      $questions_similaires = "";
    	$post = Post::select('id_post')->where('id_post', $id)->count();
      $notes = "";
      $astuces = "";
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
            return view('user.question', 
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
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'cet post n\'exsite pas'
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
        $post = Post::select('id_post')->where('id_post', $id)->count();
        if ($post == 1) {
          $post = Post::where('id_post', $id)->first();
        	$categories = Categorie::all();
          $categorie_question = Categorie::where('id_categorie',$post->id_categorie)->first();
        	return view('user.editQuestion', [
        		'post'=>$post,
        		'categories'=>$categories,
            'categorie_question'=>$categorie_question
        		]);
        }else{
        	  return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'cet post n\'exsite pas'
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
   			 'titre_post' => 'bail|required|min:5',
   			 'contenu' => 'required',
   			 'categorie' => 'required'
   		]);
   		$data = array(
   			'titre_post' => $request->input('titre_post'),
   			'contenu' => $request->input('contenu'),
   			'id_categorie' => $request->input('categorie')
   		);
   		$post = Post::select('id_post')->where('id_post', $id)->count();
   		if ($post == 1) {
   			$update = Post::where('id_post', $id)->update($data);
        if ($update) {
            $x = $id*1000;
            return redirect('user/question/'.$x)->with('info', 'Question modifiée avec succès!');
        }
   		}else{
   			return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'cet post n\'exsite pas'
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
        $id_post = $id/1000;
        $post = Post::select('id_post')->where('id_post', $id_post)->count();
   		if ($post == 1) {
        $deletec = Commentaire::where('id_post', $id_post)->delete();
   			$deletep = Post::where('id_post', $id_post)->delete();
        if ($deletec && $deletep) {
          return redirect('user/enginnova-community')->with('info', 'Post supprimé avec succès!');
        }
   		}else{
   			return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'Oops! Une erreur s\'est produite veuillez reessayer SVP!'
    			]);
   		}
    }

    public function categorie($id){
        $id = $id/1000;
        $best_projets = "";
        $astuces = "";
        $check = Categorie::select('id_categorie')->where('id_categorie',$id)->count();
        $posts= Post::join('users','users.id','=','posts.id_user')
            ->select(
              'posts.id_post',
              'posts.titre_post',
              'posts.contenu',
              'posts.slug',
              'posts.counts_commentaires',
              'posts.id_categorie',
              'posts.created_at',
              'users.id',
              'users.name',
              'users.avatar'
              )
            ->where('id_categorie',$id)
            ->orderBy('posts.id_post','desc')
            ->paginate(2);
        if ($check > 0) {
            $categories = Categorie::paginate(5);
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
           return view('user.categorieQuestion', 
            [/*'users'=>$users,*/
             'posts'=>$posts,
             'categories'=>$categories,
             'best_projets'=>$best_projets,
             'astuces'=>$astuces
             ]);
        }else{
          return view('user.error',
          [
           'error' => true,
           'message' => 'Aucune publication n\'est disponible pour le moment'
          ]);
        } 
    }
}
