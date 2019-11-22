<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
	protected $primaryKey = 'id_categorie';

    public function posts(){
    	return $this->hasMany('App\Post');
    }

    public function projets(){
    	return $this->hasMany('App\Projet');
    }
}
