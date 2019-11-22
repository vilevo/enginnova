<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifestation extends Model
{
	protected $primaryKey = 'id_manifestation';

    public function projet(){
    	return $this->belongsTo('App\Projet');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
