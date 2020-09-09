<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class FreelanceJobController extends Controller
{

  public function search(Request $request)
  {

    $value = $request->value;
    $limit = $request->limit;

    $filter = DB::table('freelance_projets')
      ->join('users', 'users.id', '=', 'freelance_projets.id_user')
      ->select(
        'freelance_projets.id_fprojet',
        'freelance_projets.titre_projet',
        'freelance_projets.contenu',
        'freelance_projets.id_user',
        'freelance_projets.reponses',
        'freelance_projets.etat',
        'freelance_projets.categorie',
        'freelance_projets.prix',
        'freelance_projets.type',
        'freelance_projets.created_at',
        'users.name',
        'users.avatar'
      )
      ->where('titre_projet', "LIKE", "%". $value . "%")
      ->orderBy(DB::raw("(CASE WHEN titre_projet= '" . $value . "' THEN 1 WHEN titre_projet LIKE '" . $value . "%' THEN 2 ELSE 3 END)"))
      ->limit($limit)
      ->get();


    // if (empty($filter)) {
    //   $filter = DB::table('freelance_projets')
    //     ->join('users', 'users.id', '=', 'posts.id_user')
    //     ->select(
    //       'freelance_projets.id_fprojet',
    //       'freelance_projets.titre_projet',
    //       'freelance_projets.contenu',
    //       'freelance_projets.id_user',
    //       'freelance_projets.reponses',
    //       'freelance_projets.etat',
    //       'freelance_projets.categorie',
    //       'freelance_projets.prix',
    //       'freelance_projets.type',
    //       'freelance_projets.created_at',
    //       'users.name',
    //       'users.avatar'
    //     )->limit($limit)
    //     ->get();
    // }

    return $filter;
  }
}
