<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function getLoginPage(){
        if(session()->has('uid')){
            return redirect("/");
        }
        else{
            return view("authenticate.login");
        }
        
    }

    public function getRegisterPage(){
        if(session()->has('uid')){
            return redirect("/");
        }
        else{
            return view("authenticate.register");
        }
    }

    public function getDashboardPage(Request $req){
        if(Session::has('uid')){
            return view("userPages.dashboard");
        }
        else {
            return redirect("/login");
        }
    }

    public function registerUser(Request $req){
        $validatedUser = $req->validate([
            "name"=>"required",
            "username"=>"required | unique:users,username| min:8 | max:12",
            "email"=>"required | email | unique:users,email",
            "password"=>"required | confirmed",
            "password_confirmation"=>"required",
        ]);

    
        User::create($validatedUser);
        $user = User::where('username',$req->username)->get()->toArray();
        $req->session()->put("uid", $user[0]['id']); 
        $req->session()->flash('loginRegister','Your account has been created successfully.');

        return redirect("/user-dashboard");
    }

    public function loginUser(Request $req){
        $validatedUserCredentials = $req->validate([
            "email"=>"required | email",
            "password"=>"required"
        ]);

        if(Auth::attempt($validatedUserCredentials)){
            $user = User::where('email',$validatedUserCredentials['email'])->get()->toArray();
            $req->session()->put('uid',$user[0]['id']);
            $req->session()->flash('loginSuccess','You have Successfully Logged In');
            return redirect("/user-dashboard");
        }
        else {
            return redirect("/login")->withErrors(['login' => 'Invalid credentials']);;
        }
        
    }

    public function logoutUser(Request $req){
        $req->session()->pull('uid',null);
        $req->session()->flash('logout','You have successfully logged out.');
        return redirect('/login');
    }

    public function changePassword(Request $req){
        if(Session::has('uid')){
            $user = User::find(Session::get('uid'));
            $req->validate([
                'current_password'=> 'required',
                'password'=> 'required|confirmed',
                'password_confirmation'=> 'required',  
            ]);

            if(Hash::check($req->current_password,$user->password)){
                $user->password = Hash::make($req->password);
                $user->save();
                return redirect('/my-profile')->with('passwordChangedSuccess','Your Password has been changed successfully');
            }
                else return redirect('/my-profile')->withErrors(['wrongCurrentPassword'=> 'You have entered incorrect current password']);
    }
    else{
        return redirect('/login')->with('LoginError','Please Login First');
    }
}
}