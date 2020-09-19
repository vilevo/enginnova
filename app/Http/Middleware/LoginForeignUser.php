<?php

namespace App\Http\Middleware;

use App\ApiUser;
use App\User;
use Closure;
use Auth;
use Illuminate\Http\Request;

class LoginForeignUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->get('token');

        if ($token != null) {

            $fuser = User::query()->where('public_token', $token)->get()->first();

            if ($fuser == null) {
                return response()->json([
                    'error' => "Foreign Authorization Token expired"
                ], 401);
            }

            Auth::loginUsingId($fuser->id, true);
        }

        return $next($request);
    }
}
