<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use App\FreelanceProjet;
use App\BoosterList;

class ApiController extends Controller
{
  public function api_enginnovaCommunity()
  {
    $check = Post::all()->count();
    $posts = Post::join('users', 'users.id', '=', 'posts.id_user')
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
      ->orderBy('posts.id_post', 'desc')
      ->get();

    if ($check > 0) {
      return
        [
          'posts' => $posts
        ];
    } else {
      return
        [
          'error' => true,
          'message' => 'Aucune publication n\'est disponible pour le moment'
        ];
    }
  }

  public function api_freelance()
  {
    $best_projets  = [];
    $check = FreelanceProjet::all()->count();
    if ($check > 0) {
      $freelance_projets = DB::table('freelance_projets')
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
        ->where('actif', true)
        ->orderBy('freelance_projets.id_fprojet', 'desc')
        ->get();

      $projets = BoosterList::join('freelance_projets', 'freelance_projets.id_fprojet', '=', 'booster_lists.id_fprojet')->count();

      if ($projets > 0) {
        $best_projets = BoosterList::join('freelance_projets', 'freelance_projets.id_fprojet', '=', 'booster_lists.id_fprojet')
          ->select(
            'booster_lists.id_fprojet',
            'booster_lists.actif',
            'freelance_projets.titre_projet',
            'freelance_projets.prix'
          )
          ->where('booster_lists.actif', true)
          ->orderBy('id', 'desc')->paginate(4);
      }
      return
        [
          'freelance_projets' => $freelance_projets,
          'best_projets' => $best_projets
        ];
    } else {
      return
        [
          'error' => true,
          'message' => 'Aucun projet n\'est disponible pour le moment'
        ];
    }
  }
}
