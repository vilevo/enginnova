<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teamplanning extends Model
{
    protected $fillable = [
        'titre', 'debut', 'fin',
    ];
}
