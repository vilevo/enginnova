<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
	protected $primaryKey = 'id_projet';
	
    public function user(){
    	return $this->belongsTo('App\User');
    }


    public function manifestations(){
    	return $this->hasMany('App\Manifestation');
    }
}
