<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

  public function create(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'name' => 'nullable|string',
      'email' => 'required|email|unique:users,email',
      'password' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => "Validations failed"
      ])->withErrors($validator);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      'public_token' => bcrypt($request->password)
    ]);

    // Send the confirmation email

    return response()->json([
      'token' => $user->public_token
    ]);
  }
}
