<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
	protected $primaryKey = 'id_observation';

     public function user(){
    	return $this->belongsTo('App\User');
    }
    
}
