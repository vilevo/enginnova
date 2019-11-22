<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	protected $primaryKey = 'id_note';

     public function user(){
    	return $this->belongsTo('App\User');
    }
}
