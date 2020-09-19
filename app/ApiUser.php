<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiUser extends Model
{

  /**
   * We only needs to generate a token
   */
  protected $fillable = [
    'username',
    'password',
    'address',
    'token'
  ];


  function refreshToken()
  {
    $this->attributes['token'] = bcrypt($this->attributes['password']);
    $this->save();
  }
}
