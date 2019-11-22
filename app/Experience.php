<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
	protected $primaryKey = 'id_experience';

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
