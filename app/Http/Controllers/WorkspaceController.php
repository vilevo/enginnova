<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Calendar;
use App\FreelanceProjet;
use App\Manifestation;
use App\Experience;
use App\Workspace;
use App\Teamchat;
use App\TeamchatMsg;
use App\Teamplanning;
use App\User;


class WorkspaceController extends Controller
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

    public function index($id){
    	$idp = $id/1000;
    	$chats = "";
    	$calendar_details = "";
    	$fprojet = "";
    	$experience_users = "";
    	$taches = "";
    	$workspace_check = Workspace::select('id')->where('id_fprojet',$idp)->count();
    	if ($workspace_check == 1) {
    		$workspace = Workspace::where('id_fprojet',$idp)->first();
    		$id_workspace = $workspace->id;
    		$events = Teamplanning::select('id')->where('id_workspace',$workspace->id)->count();
    		if ($events > 0) {
    			$events = Teamplanning::where('id_workspace',$workspace->id)->get();
    			$event_list = [];
		    	foreach ($events as $key => $event) {
		    		$event_list[] = Calendar::event(
		    			$event->titre,
		    			true,
		    			new \DateTime($event->debut),
		    			new \DateTime($event->fin.' + 1 day ')
		    		);
		    	}
	    		$calendar_details = Calendar::addEvents($event_list);
	    		$taches = Teamplanning::where('id_workspace',$workspace->id)->get();
    		}
    		$check_chat = Teamchat::select('id')->where('id_workspace',$workspace->id)->count();
    		if ($check_chat==1) {
    			$teamchat = Teamchat::where('id_workspace',$workspace->id)->first();
    			$chats = TeamchatMsg::join('users','users.id','=','teamchat_msgs.id_user')
    								->select(
    									'teamchat_msgs.id',
    									'teamchat_msgs.id_user',
    									'teamchat_msgs.message',
    									'teamchat_msgs.created_at',
    									'users.name',
    									'users.avatar'
    								)
    								->where('id_chat',$teamchat->id)
    								->orderBy('Teamchat_Msgs.id','asc')
    								->paginate(10);
    		}
    		$check_user = FreelanceProjet::select('id_fprojet')->where('id_fprojet',$idp)->count();
    		if($check_user == 1){
    			$fprojet = FreelanceProjet::join('users','users.id','=','freelance_projets.id_user')
    								->select(
    									'freelance_projets.id_fprojet',
    									'freelance_projets.id_user',
    									'users.name',
    									'users.avatar',
    									'users.profession'
    								)
    								->where('freelance_projets.id_fprojet',$idp)
    								->first();
    		}
    		$check_experience = Experience::select('id_experience')->where('id_workspace',$id_workspace)->count();
    		if ($check_experience>0) {
    			$experience_users = Experience::join('users','users.id','=','experiences.id_user')
    								->select(
    									'experiences.id_experience',
    									'experiences.id_user',
    									'experiences.selectionne',
    									'experiences.id_workspace',
    									'users.name',
    									'users.avatar',
    									'users.profession'
    								)
    								->where('experiences.id_workspace',$id_workspace)
    								->where('experiences.selectionne',true)
    								->orderBy('users.name','asc')
    								->get();
    		}
    		return view('user.workSpace',[
    			'workspace' => $workspace,
    			'chats' => $chats,
    			'id_workspace' => $id_workspace,
    			'calendar_details' => $calendar_details,
    			'taches' => $taches,
    			'fprojet' => $fprojet,
    			'experience_users' => $experience_users
    		]);
    	}else{
    		return view('user.error',
    			[
    			 'error' => true,
    			 'message' => 'Aucun candidat n\'a encore accepté le job'
    			]);
    	}
    	
    }

    public function projetEnd($id){
    	
    }

    public function fetch_chats($id){
    	header("Content-Type:application/json");
    	$results = [];
    	$idp = $id/1000;
    	$workspace_check = Workspace::select('id')->where('id_fprojet',$idp)->count();
    	if ($workspace_check == 1) {
    		$workspace = Workspace::where('id_fprojet',$idp)->first();
    		$check_chat = Teamchat::select('id')->where('id_workspace',$workspace->id)->count();
    		if ($check_chat==1) {
    			$teamchat = Teamchat::where('id_workspace',$workspace->id)->first();
    			$chats = TeamchatMsg::join('users','users.id','=','teamchat_msgs.id_user')
    								->select(
    									'teamchat_msgs.id',
    									'teamchat_msgs.id_user',
    									'teamchat_msgs.message',
    									'teamchat_msgs.created_at',
    									'users.name',
    									'users.avatar'
    								)
    								->where('id_chat',$teamchat->id)
    								->orderBy('Teamchat_Msgs.id','desc')
    								->get();
    		$results[] = [
    			'header' => "200",
    			'data' => $chats
    		];
    		return json_encode($results);
    		}else{
	    		$results = [
	    			'header' => "error",
	    			'reponse' => "Aucune discussion. Lancez une discussion"
	    		];
	    		return json_encode($results);
    		}
    	}else{
	    		$results = [
	    			'header' => "error",
	    			'reponse' => "Une erreur s'est produite veuillez reessayer SVP"
	    		];
	    		return json_encode($results);
    		}
    }
}
