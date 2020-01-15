<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','verifyToken',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isOnline()
    {
        return Cache::has('active-user' . $this->id);
    }

     public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function projets(){
        return $this->hasMany('App\Projet');
    }

     public function commentaires(){
        return $this->hasMany('App\Commentaire');
    }

    public function manifestations(){
        return $this->hasMany('App\Manifestation');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }

    public function experiences(){
        return $this->belongsTo('App\Experience');
    }

}
