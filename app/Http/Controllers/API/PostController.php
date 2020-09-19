<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class PostController extends Controller
{

  public function search(Request $request)
  {

    $value = $request->value;
    $limit = $request->limit;

    $filter = DB::table('posts')
      ->join('users', 'users.id', '=', 'posts.id_user')
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
      )
      ->where('titre_post', "LIKE", "%". $value . "%")
      ->orderBy(DB::raw("(CASE WHEN titre_post= '" . $value . "' THEN 1 WHEN titre_post LIKE '" . $value . "%' THEN 2 ELSE 3 END)"))
      ->limit($limit)
      ->get();


    // if (empty($filter)) {
    //   $filter = DB::table('posts')
    //   ->join('users', 'users.id', '=', 'posts.id_user')
    //   ->select(
    //     'posts.id_post',
    //     'posts.titre_post',
    //     'posts.contenu',
    //     'posts.slug',
    //     'posts.counts_commentaires',
    //     'posts.id_user',
    //     'posts.id_categorie',
    //     'posts.created_at',
    //     'users.id',
    //     'users.name',
    //     'users.avatar'
    //   )->limit($limit)
    //   ->get();
    // }

    return $filter;
  }
}
