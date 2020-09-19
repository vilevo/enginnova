<?php

namespace App\Http\Middleware;

use App\ApiUser;
use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckApiUser
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
        $token = $request->header('X-Api-Authorization');
        if ($token == null) {
            return response()->json([
                'error' => "X-Api-Authorization Token not found"
            ], 401);
        }

        $apiUser = ApiUser::query()->where('token', $token)->get()->first();

        if ($apiUser == null) {
            return response()->json([
                'error' => "X-Api-Authorization Token expired"
            ], 401);
        }
        
        return $next($request);
    }
}
