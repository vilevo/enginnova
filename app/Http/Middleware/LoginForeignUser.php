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
        $token = $request->header('X-Foreign-Authorization');
        if ($token == null) {
            return response()->json([
                'error' => "Foreign Authorization Token not found"
            ], 401);
        }

        $fuser = User::query()->where('public_token', $token)->get()->first();

        if ($fuser == null) {
            return response()->json([
                'error' => "Foreign Authorization Token expired"
            ], 401);
        }

        Auth::loginUsingId($fuser->id);

        return $next($request);
    }
}
