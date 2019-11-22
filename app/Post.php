<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $primaryKey = 'id_post';
	
     public function user(){
    	return $this->belongsTo('App\User');
    }

     public function commentaires(){
    	return $this->hasMany('App\Commentaire');
    }
}
