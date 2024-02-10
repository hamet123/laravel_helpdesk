<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class checkAgentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(Session::get('uid'));
        if(Session::has('uid') && (($user->role=='agent') || ($user->role=='admin')) ) {
        return $next($request);
        }
        else{
            if (Session::has('uid')) {
                return redirect('/')->with('adminLoginError','You need to have administrative privileges in order to access that page.');
            } else {
                return redirect('/login')->with('adminLoginError','Please Login first to access this page.');
            }
        }
    }
}
