<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
     public function user(){
    	return $this->belongsTo('App\User');
    }
}
