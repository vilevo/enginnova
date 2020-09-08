<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

  public function create(Request $request)
  {
    $request->validate([
      'name' => 'nullable|string',
      'email' => 'required|email|unique:users,email'
    ]);

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
