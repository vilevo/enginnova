<?php

namespace App\Http\Controllers;

use App\ApiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Cv;
use App\FreelanceProjet;
use App\User;
use App\Categorie;
use App\Post;
use App\BoosterProjet;
use App\BoosterList;
use App\Manifestation;
use App\GestionSlide;
use App\GestionActivite;
use App\Astuce;
use App\Mentor;


class AdministrateurController extends Controller
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

    public function index()
    {
        $new_cvs = Cv::select('id_cv')->where('actif', false)->count();
        $new_projets = FreelanceProjet::select('id_fprojet')->where('actif', false)->count();
        $new_boosts = BoosterProjet::count();
        $posts = Post::all();
        $users = User::all();
        $fprojets = FreelanceProjet::all();
        $new_manif = Manifestation::select('id_manifestation')
            ->where('selectionne', true)
            ->count();

        return view('admin.administrateur', [
            'new_cvs' => $new_cvs,
            'new_projets' => $new_projets,
            'users' => $users,
            'posts' => $posts,
            'new_boosts' => $new_boosts,
            'fprojets' => $fprojets,
            'new_manif' => $new_manif
        ]);
    }

    public function cvInactif()
    {
        $new_cvs = Cv::select('id_cv')->where('actif', false)->get();
        return view('admin.cv', ['new_cvs' => $new_cvs]);
    }

    public function fProjet()
    {
        $new_projets = FreelanceProjet::select('id_fprojet')->where('actif', false)->get();
        return view('admin.freelancesProjets', ['new_projets' => $new_projets]);
    }

    public function projetAboost()
    {
        $new_boosts = BoosterProjet::all();
        return view('admin.projetsBoost', ['new_boosts' => $new_boosts]);
    }

    public function manif()
    {
        $manifestations = Manifestation::join('users', 'users.id', '=', 'manifestations.id_user')
            ->select(
                'manifestations.id_manifestation',
                'manifestations.id_fprojet',
                'manifestations.id_user',
                'manifestations.selectionne',
                'manifestations.valider',
                'manifestations.created_at',
                'users.id',
                'users.name',
                'users.email',
                'users.telephone'
            )
            ->where('manifestations.selectionne', true)
            ->orderBy('manifestations.id_manifestation', 'asc')
            ->get();

        return view('admin.freelanceSelection', ['manifestations' => $manifestations]);
    }

    public function cv($id)
    {
        $cv = Cv::join('users', 'users.id', '=', 'cvs.id_user')
            ->select(
                'cvs.id_cv',
                'cvs.cv',
                'cvs.actif',
                'users.id',
                'users.name',
                'users.email',
                'users.telephone'
            )
            ->where('actif', false)
            ->where('id_cv', $id)
            ->first();
        return view('admin.admin_cv', [
            'cv' => $cv
        ]);
    }

    public function freelanceProjet($id)
    {
        $categories = Categorie::all();
        $check = BoosterList::select('id')->where('id_fprojet', $id)->count();
        $boost_projet = "";
        if ($check == 1) {
            $boost_projet = BoosterList::join('booster_forfaits', 'booster_forfaits.id', '=', 'booster_lists.type_forfait')
                ->select(
                    'booster_lists.id',
                    'booster_lists.id_user',
                    'booster_lists.id_fprojet',
                    'booster_lists.type_forfait',
                    'booster_lists.unite',
                    'booster_lists.debut',
                    'booster_lists.fin',
                    'booster_lists.actif',
                    'booster_lists.created_at',
                    'booster_forfaits.name'
                )
                ->where('id_fprojet', $id)
                ->first();
        }

        $freelance_projet =  FreelanceProjet::join('users', 'users.id', '=', 'freelance_projets.id_user')
            ->select(
                'freelance_projets.id_fprojet',
                'freelance_projets.titre_projet',
                'freelance_projets.contenu',
                'freelance_projets.categorie',
                'freelance_projets.prix',
                'users.id',
                'users.name',
                'users.email',
                'users.telephone'
            )
            ->where('id_fprojet', $id)
            ->first();
        $cat = $freelance_projet->categorie;
        $categorie_projet = Categorie::where('id_categorie', $cat)->first();

        return view('admin.admin_freelanceProjet', [
            'freelance_projet' => $freelance_projet,
            'categories' => $categories,
            'categorie_projet' => $categorie_projet,
            'boost_projet' => $boost_projet
        ]);
    }

    public function activerCv($id)
    {
        $data = array(
            'actif' => true
        );
        $update = Cv::where('id_cv', $id)->update($data);
        if ($update) {
            return redirect('admin/administrateur')->with('info', 'CV activé avec succès!');
        }
    }

    public function activerFprojet(Request $request, $id)
    {
        $this->validate($request, [
            'titre_projet' => 'bail|required|min:5',
            'prix' => 'required',
            'contenu' => 'required',
            'categorie' => 'required'
        ]);
        $data = array(
            'titre_projet' => $request->input('titre_projet'),
            'prix' => $request->input('prix'),
            'contenu' => $request->input('contenu'),
            'categorie' => $request->input('categorie'),
            'actif' => true
        );

        $update = FreelanceProjet::where('id_fprojet', $id)->update($data);
        if ($update) {
            return redirect('admin/administrateur')->with('info', 'Projet activé avec succès!');
        }
    }

    public function boosterProjet(Request $request, $id)
    {
        $this->validate($request, [
            'debut' => 'required',
            'fin' => 'required'
        ]);
        $data = array(
            'debut' => $request->input('debut'),
            'fin' => $request->input('fin'),
            'actif' => true
        );

        $update = BoosterList::where('id_fprojet', $id)->update($data);
        if ($update) {
            BoosterProjet::where('id_fprojet', $id)->delete();
            return redirect('admin/administrateur')->with('info', 'boost activé avec succès!');
        }
    }

    public function candidatsSelectionne()
    {
        $manifestations = "";
        $check_manif = Manifestation::select('id_manifestation')->count();
        if ($check_manif > 0) {
            $manifestations = Manifestation::join('users', 'users.id', '=', 'manifestations.id_user')
                ->join('freelance_projets', 'freelance_projets.id_fprojet', '=', 'manifestations.id_fprojet')
                ->select(
                    'manifestations.id_manifestation',
                    'manifestations.id_fprojet',
                    'manifestations.id_user',
                    'manifestations.selectionne',
                    'manifestations.valider',
                    'manifestations.created_at',
                    'users.id',
                    'users.name',
                    'users.profession',
                    'users.avatar',
                    'freelance_projets.id_fprojet'
                )
                ->where('manifestations.selectionne', true)
                ->where('manifestations.valider', true)
                ->orderBy('manifestations.id_manifestation', 'asc')
                ->get();
        }
        return view('user.gestionProjet', [
            'manifestations' => $manifestations
        ]);
    }

    public function sliderList()
    {
        $slides = GestionSlide::all();
        return view('admin.sliderList', ['slides' => $slides]);
    }

    public function sliderEdit($id)
    {
        $slide = "";
        $check = GestionSlide::select('id')->where('id', $id)->count();
        if ($check == 1) {
            $slide = GestionSlide::find($id);
        }

        return view('admin.updateSlide', ['slide' => $slide]);
    }

    public function sliderUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'titre_1' => 'required',
            'titre_2' => 'required',
            'contenu' => 'required'
        ]);

        $data = array(
            'titre_1' => $request->input('titre_1'),
            'titre_2' => $request->input('titre_2'),
            'contenu' => $request->input('contenu')
        );

        $update = GestionSlide::where('id', $id)->update($data);
        if ($update) {
            return redirect('admin/slider-edit/' . $id)->with('info', 'slide mise a jour avec succes');
        }
    }

    public function newActivite()
    {
        $activites = "";
        $check = GestionActivite::select('id')->count();
        if ($check > 0) {
            $activites = GestionActivite::all();
        }
        return view('admin.createActivite', ['activites' => $activites]);
    }

    public function createActivite(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100|max:2048',
            'contenu' => 'required'
        ]);

        //get filename with extension
        $filenamewithextension = $request->file('photo')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('photo')->getClientOriginalExtension();

        //filename to store
        $photoName = $filename . '_' . time() . '.' . $extension;

        //Upload File to s3
        $savePhoto = Storage::disk('s3')->put($photoName, fopen($request->file('photo'), 'r+'), 'public');
        if ($savePhoto) {
            $activite = new GestionActivite;
            $activite->titre = $request->input('titre');
            $activite->contenu = $request->input('contenu');
            $activite->photo = $photoName;
            if ($activite->save()) {
                return redirect('admin/new-activite')->with('info', 'Activité publiée avec succès');
            }
        }
    }

    public function editActivite($id)
    {
        $activite = "";
        $check = GestionActivite::select('id')->where('id', $id)->count();
        if ($check == 1) {
            $activite = GestionActivite::find($id);
        }

        return view('admin.updateActivite', ['activite' => $activite]);
    }

    public function updateActivite(Request $request, $id)
    {
        $this->validate($request, [
            'titre' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100|max:2048',
            'contenu' => 'required'
        ]);

        //get filename with extension
        $filenamewithextension = $request->file('photo')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('photo')->getClientOriginalExtension();

        //filename to store
        $photoName = $filename . '_' . time() . '.' . $extension;

        //Upload File to s3
        $savePhoto = Storage::disk('s3')->put($photoName, fopen($request->file('photo'), 'r+'), 'public');
        $data = array(
            'titre' => $request->input('titre'),
            'photo' => $photoName,
            'contenu' => $request->input('contenu')
        );
        $update = GestionActivite::where('id', $id)->update($data);
        if ($update) {
            return redirect('admin/new-activite')->with('info', 'Activité modifiée avec succès');
        }
    }

    public function newAstuce()
    {
        $astuces = "";
        $check = Astuce::select('id')->count();
        if ($check > 0) {
            $astuces = Astuce::all();
        }
        return view('admin.createAstuce', ['astuces' => $astuces]);
    }

    public function createAstuce(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100|max:2048',
            'contenu' => 'required'
        ]);

        //get filename with extension
        $filenamewithextension = $request->file('photo')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('photo')->getClientOriginalExtension();

        //filename to store
        $photoName = $filename . '_' . time() . '.' . $extension;

        //Upload File to s3
        $savePhoto = Storage::disk('s3')->put($photoName, fopen($request->file('photo'), 'r+'), 'public');
        if ($savePhoto) {
            $astuce = new Astuce;
            $astuce->titre = $request->input('titre');
            $astuce->contenu = $request->input('contenu');
            $astuce->photo = $photoName;
            if ($astuce->save()) {
                return redirect('admin/trucs-astuces')->with('info', 'astuce publiée avec succès');
            }
        }
    }

    public function editAstuce($id)
    {
        $astuce = "";
        $check = Astuce::select('id')->where('id', $id)->count();
        if ($check > 0) {
            $astuce = Astuce::find($id);
        }
        return view('admin.updateAstuce', ['astuce' => $astuce]);
    }

    public function updateAstuce(Request $request, $id)
    {
        $this->validate($request, [
            'titre' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100|max:2048',
            'contenu' => 'required'
        ]);

        //get filename with extension
        $filenamewithextension = $request->file('photo')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('photo')->getClientOriginalExtension();

        //filename to store
        $photoName = $filename . '_' . time() . '.' . $extension;

        //Upload File to s3
        $savePhoto = Storage::disk('s3')->put($photoName, fopen($request->file('photo'), 'r+'), 'public');
        $data = array(
            'titre' => $request->input('titre'),
            'photo' => $photoName,
            'contenu' => $request->input('contenu')
        );
        $update = Astuce::where('id', $id)->update($data);
        if ($update) {
            return redirect('admin/trucs-astuces')->with('info', 'Astuce modifiée avec succès');
        }
    }

    public function gestionMentor()
    {
        $mentors = Mentor::all();
        return view('admin.gestionMentor', ['mentors' => $mentors]);
    }

    public function newMentor(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required',
            'profession' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100|max:2048',
            'about' => 'required'
        ]);

        //get filename with extension
        $filenamewithextension = $request->file('photo')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('photo')->getClientOriginalExtension();

        //filename to store
        $photoName = $filename . '_' . time() . '.' . $extension;

        //Upload File to s3
        $savePhoto = Storage::disk('s3')->put($photoName, fopen($request->file('photo'), 'r+'), 'public');
        $mentor = new Mentor;
        $mentor->nom = $request->input('nom');
        $mentor->profession = $request->input('profession');
        $mentor->avatar = $photoName;
        $mentor->about = $request->input('about');
        if ($mentor->save()) {
            return redirect('admin/gestion-mentor')->with('info', 'Mentor enrégistré avec succès');
        }
    }

    public function traiteUsers()
    {
        $users = User::paginate(20);
        return view('admin.traiteUsers', ['users' => $users]);
    }

    public function destroySlide($id)
    {

        $check = GestionSlide::select('id')->where('id', $id)->count();
        if ($check > 0) {
            GestionSlide::where('id', $id)->delete();
        }
        return redirect('admin/sliderList')->with('info', 'Supprimé avec succès!');
    }

    public function destroyActivite($id)
    {

        $check = GestionActivite::select('id')->where('id', $id)->count();
        if ($check > 0) {
            GestionActivite::where('id', $id)->delete();
        }
        return redirect('admin/new-activite')->with('info', 'Supprimée avec succès!');
    }

    public function destroyAstuce($id)
    {

        $check = Astuce::select('id')->where('id', $id)->count();
        if ($check > 0) {
            Astuce::where('id', $id)->delete();
        }
        return redirect('admin/trucs-astuces')->with('info', 'Supprimé avec succès!');
    }

    public function destroyCv($id)
    {

        // $check = Astuce::select('id')->where('id',$id)->count();
        // if ($check>0) {
        //     Astuce::where('id',$id)->delete();
        // }
        // return redirect('admin/trucs-astuces')->with('info','Supprimé avec succès!');
    }

    public function destroyProjet($id)
    {

        // $check = Astuce::select('id')->where('id',$id)->count();
        // if ($check>0) {
        //     Astuce::where('id',$id)->delete();
        // }
        // return redirect('admin/trucs-astuces')->with('info','Supprimé avec succès!');
    }


    /**
     * GEt the list of authorized users that can use the api
     */
    function apiUserIndex()
    {
        $u = ApiUser::all();

        return view('admin.apiusers')->with('users', $u);
    }

    /**
     * 
     */
    function createApiUser(Request $request)
    {
        $data = $request->validate([
            // Enginnova App
            'username' => "required|string",
            // Password
            "password" => "required|string",
            'address' => "required|string",
        ]);



        $apiU = ApiUser::create([
            'username' => $request->username,
            "password" => bcrypt($request->password),
            'address' => $request->address
        ]);

        $apiU->refreshToken();


        return redirect()->back();
    }

    function refreshApiUserToken($id)
    {
        $apiU = ApiUser::findOrFail($id);
        $apiU->refreshToken();
        
        return redirect()->back();
    }
}
