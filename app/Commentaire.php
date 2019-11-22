<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
	protected $primaryKey = 'id_commentaire';

    public function post(){
    	return $this->belongsTo('App\Post');
    }

    public function projet(){
    	return $this->belongsTo('App\Projet');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
