<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Teamchat;
use App\TeamchatMsg;
use App\Workspace;
use App\User;


class TeamchatController extends Controller
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

    public function teamchatAdd(Request $request, $id){
    	$check_ws = Workspace::select('id')->where('id',$id)->count();
    	$user_id = Auth::user()->id;
    	if($check_ws == 1){
    		$check_chat = Teamchat::select('id')->where('id_workspace',$id)->count();
	    	if ($check_chat == 0) {
	    		$this->validate($request, [
	   			 'message' => 'required'
	   			]);
	    	 	
	    	 	$chat = new Teamchat;
	    	 	$chat->id_workspace = $id;	 	
	    	 	if ($chat->save()) {
	    	 		$chat_msg = new TeamchatMsg;
	    	 		$chat_msg->id_workspace = $id;
		    	 	$chat_msg->id_chat = $chat->id;
		    	 	$chat_msg->id_user = $user_id;
		    	 	$chat_msg->message = $request->input('message');
		    	 	if ($chat_msg->save()) {
		    	 		$fprojet = Workspace::where('id',$id)->first();
	    	 			$x = $fprojet->id_fprojet*1000;
		    	 		return redirect('user/workspace/'.$x)->with('info', 'message envoyé avec succès!');
		    	 	}
		    	}
	    	 }else{
	    	 	$this->validate($request, [
	   			 'message' => 'required'
	   			]);
	   			$chat = Teamchat::where('id_workspace',$id)->first();
		    	$chat_msg = new TeamchatMsg;
		    	$chat_msg->id_workspace = $id;
		    	$chat_msg->id_chat = $chat->id;
		    	$chat_msg->id_user = $user_id;
		    	$chat_msg->message = $request->input('message');
		    	if ($chat_msg->save()) {
		    	 	$fprojet = Workspace::where('id',$id)->first();
		    	 	$x = $fprojet->id_fprojet*1000;
		    	 	return redirect('user/workspace/'.$x)->with('info', 'message envoyé avec succès!');
		    	}
	    	 }
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'Oops! une erreur s\'est produite , veuillez réessayer SVP!'
    			]);
    	}
    	
    }
}
