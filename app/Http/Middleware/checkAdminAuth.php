<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(Session::get('uid'));
        if(Session::has('uid') && ($user->role=='admin') ) {
        return $next($request);
        }
        else{
            return redirect('/login')->with('loginError','You need to have administrative privileges in order to access that page.');
        }
    }
}
