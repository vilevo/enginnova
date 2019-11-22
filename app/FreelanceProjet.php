<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreelanceProjet extends Model
{
	protected $primaryKey = 'id_fprojet';
	
    public function user(){
    	return $this->belongsTo('App\User');
    }


    public function manifestations(){
    	return $this->hasMany('App\Manifestation');
    }
}
