<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cv;
use App\User;

class CvController extends Controller
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

     public function updateCv(Request $request, $id){
        $this->validate($request,[
            'cv'=> 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100|max:2048'
        ]);
        $user_id = $id/1000;
        $cvName = time().'.'.$request->cv->getClientOriginalExtension();
        $saveCv = $request->cv->move(public_path('cv'), $cvName);
        if ($saveCv) {
            $check_cv = Cv::select('id_cv')->where('id_user',$user_id)->count();
            if ($check_cv == 1) {
                $data = array(
                'cv' => $cvName
                );
                $update = Cv::where('id_user', $user_id)->update($data); 
                if ($update) {
                	// $cv = Cv::select('cv')->where('id_user',$user_id)->first();
                	// $request->cv->delete(public_path('cv'), $cv);
                    $x = $user_id*1000;
                    return redirect('user/profil/'.$x)->with('info_cv', 'Votre CV a été enregistré avec succès! Notre équipe est entrain de l\'étudier. La confirmation vous sera envoyée d\'ici 48h par mail merci.');
                }
            }else{
                $cv = new Cv;
                $cv->id_user = $user_id;
                $cv->cv = $cvName;
                $cv->actif=false;
                if ($cv->save()) {
                    $x = $user_id*1000;
                    return redirect('user/profil/'.$x)->with('info_cv', 'Votre CV a été enregistré avec succès! Notre équipe est entrain de l\'étudier. La confirmation vous sera envoyée d\'ici 48h par mail merci.');
                }
            }
        }else{
            return view('user.error',
                [
                 'error' => true,
                 'message' => 'Oops une erreur s\'est produite , veuillez reessayer svp!' 
                ]);
        }
    }

    public function fetch($id)
    {
        $data = Cv::where('id_user',$id)->first();
        return response($data);
    }

}
