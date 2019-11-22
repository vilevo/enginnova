<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Calendar;
use App\Events;

class EventsController extends Controller
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
    	$events = Events::get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
    			$event->event_name,
    			true,
    			new \DateTime($event->start_date),
    			new \DateTime($event->end_date.' + 1 day ')
    		);
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
    	return view('admin.events',['calendar_details'=>$calendar_details]);
    }

    public function addEvents(Request $request){
    	$this->validate($request, [
   			 'event_name' => 'bail|required|min:5',
             'start_date'=>'required',
   			 'end_date' => 'required'
   		]);

   		$event = new Events;
   		$event->event_name = $request->input('event_name');
   		$event->start_date = $request->input('start_date');
   		$event->end_date = $request->input('end_date');
   		if ($event->save()) {
   			return redirect('admin/events')->with('info','Evenement enregistré avec succès!');
   		}
    }
}
