<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Cache;
use Auth;

class activeUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user == null) {
            if (Auth::check()) {
                $user = Auth::user();
            }
        }

        if ($user != null) {
            $expireTime = Carbon::now()->addMinutes(1);
            Cache::put('active-user' . $user->id, true, $expireTime);
        }

        return $next($request);
    }
}
