<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthWithToken
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
        if (!$user = User::whereNotNULL('token')->whereToken($request->token)->first()){
            abort(403);
        }
        Auth::login($user);
        return $next($request);
        Auth::logout();
    }
}
