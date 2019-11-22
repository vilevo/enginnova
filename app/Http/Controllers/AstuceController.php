<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Astuce;
use App\BoosterList;
use App\BoosterForfait;

class AstuceController extends Controller
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

    public function show($id){
         $best_projets = "";
    	if (Astuce::select('id',$id)->count() == 1) {
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
    		$astuce = Astuce::find($id);
    		$similaires = Astuce::where('id','!=',$id)->get();
    		return view('user.geeking',[
                'astuce'=>$astuce,
                'similaires'=>$similaires,
                'best_projets'=>$best_projets
            ]);
    	}else{
    		return view('user.error',
          [
           'error' => true,
           'message' => 'Oups une erreur s\'est produite veuillez réessayer SVP!'
          ]);
    	}
    }
}
