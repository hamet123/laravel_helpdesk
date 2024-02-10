<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \App\Models\User;
use Illuminate\Support\Facades\Session;

class CheckUserAuth
{
    public function handle(Request $request, Closure $next): Response
    {

        // Your existing logic to check user authentication
        $user = User::find(Session::get("uid"));
        if (Session::has('uid') && (($user->role=='user') || ($user->role=='admin'))) {
            return $next($request);
        } else {
            if (Session::has('uid')) {
                return redirect('/')->with('loginError', 'You do not have permissions to access this page.');
            } else {
                return redirect('/login')->with('loginError', 'Please Login First to View this Page.');
            }
        }
    }
}
