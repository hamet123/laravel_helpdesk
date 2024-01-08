<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \App\Models\User;
use Illuminate\Support\Facades\Session;

class checkUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Exclude the login route from the middleware
        if ($request->routeIs('login')) {
            return $next($request);
        }

        $user = User::find(Session::get("uid"));
        if(Session::has('uid') && ($user->role == 'user')) {
            return $next($request);
        } else {
            return redirect('/login')->with('loginError', 'Please Login first in order to access this page.');
        }
    }
}
