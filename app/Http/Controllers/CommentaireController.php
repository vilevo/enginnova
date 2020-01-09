<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\RepliedToQuestion;
use App\Commentaire;
use App\Post;
use App\Note;
use App\User;

class CommentaireController extends Controller
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
    
    public function index(){
      $id = 1;

      // $commentaires=DB::table('commentaires')
      //      ->join('users','users.id','=','commentaires.id_user')
      //      ->join('posts','posts.id_post','=','commentaires.id_commentaire')
      //      ->select(
      //       'commentaires.id_commentaire',
      //       'commentaires.contenu',
      //       'commentaires.id_user',
      //       'commentaires.id_post',
      //       'commentaires.created_at',
      //       'users.id',
      //       'users.name',
      //       'posts.id_post'
      //        )->where('commentaires.id_post',$id)
      //        ->orderBy('commentaires.id_commentaire','desc')
      //        ->get();
      $commentaires = Commentaire::all();
      return view('user.test' , ['commentaires'=>$commentaires]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $this->validate($request, [
   			 'contenu' => 'required',
   			 'x' => 'required'
   		]);
   		$user = Auth::user();
   		$user_name = $user->name;
   		$user_id = $user->id;
   		$commentaires = new Commentaire;
   		$commentaires->contenu = $request->input('contenu');
   		$commentaires->id_user = $user_id;
   		$commentaires->id_post = $request->input('x');
      $commentaires->count_vote = 0;
   		if ($commentaires->save()) {
        //notification
        Auth::user()->notify(new RepliedToQuestion($commentaires));
        //mettre a jour la table post avec comme parametre count_commentaires
        $x = $request->input('x');
        $cc = Post::select('counts_commentaires')
          ->where('id_post',$x)
          ->get()->first();
        $ccx = $cc->counts_commentaires + 1;
        $data = array(
          'counts_commentaires' => $ccx
        );
        $update = Post::where('id_post', $x)->update($data);
        if($update){
           $x = $x*1000;
          return redirect('user/question/'.$x)->with('info', 'Votre réponse a été publié avec succès!');
        }
        // creation dune note
        // $note = new Note;
        // $note->id_commentaire = $    
      }
    }

    public function edit($id)
    {
        $id = $id/1000;
        $commentaire = Commentaire::find($id);
        if ($commentaire != null) {
        	return view('user.editCommentaire', ['commentaire'=>$commentaire]);
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
    	
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idc,$id)
    {
    	$idc = $idc/1000;
    	$idp = $id/1000;
    	$check_idp = Post::select('id_post')->where('id_post', $idp)->count();
    	$check_idc = Commentaire::select('id_commentaire')->where('id_commentaire', $idc)->count();
    	if ($check_idp == 1 && $check_idc == 1) {
    		$dc = Commentaire::where('id_commentaire', $idc)->delete();
	        if ($dc) {
  	        	$cc = Post::select('counts_commentaires')
  	   			->where('id_post',$idp)->first();
    	   		$ccx = $cc->counts_commentaires - 1;
    	   		$data = array(
    	   			'counts_commentaires' => $ccx
    	   		);
    	   		$update = Post::where('id_post', $idp)->update($data);
            if ($update) {
                $idp = $idp*1000;
                return redirect('user/question/'.$idp)->with('info', 'réponse supprimé avec succès!'); 
            }     	
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
