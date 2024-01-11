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
    public function getHome(){
        return  view("home");
    }

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
        $user = User::where('username',$req->username)->first();
        $req->session()->put("uid", $user->id); 
        $req->session()->put("role", $user->role);
        $req->session()->put("name", $user->name); 
        $req->session()->flash('loginRegister','Your account has been created successfully.');

        return redirect("/user-dashboard");
    }

    public function loginUser(Request $req){
        $validatedUserCredentials = $req->validate([
            "email"=>"required | email",
            "password"=>"required"
        ]);

        if(Auth::attempt($validatedUserCredentials)){
            $user = User::where('email',$validatedUserCredentials['email'])->first();
            $req->session()->put('uid',$user->id);
            $req->session()->put('role',$user->role);
            $req->session()->put("name", $user->name); 
            $req->session()->flash('loginSuccess','You have Successfully Logged In');
            if($user->role=='admin'){
                return redirect("/admin-dashboard");
            }
            if($user->role== 'user'){
                return redirect("/user-dashboard");
            }
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


public function createDummyUsers(){
    $user = User::create([
        'name'=> 'User',
        'email'=> 'ayush_94@live.com', 
        'password'=> '$2y$12$5unXoNiXhR5k1.aA0ONeHuh6WGPgpDhsKdy8gfrnAC/d.1Jl4u01G',
        'role'=> 'user',
        'username'=> 'hamet123',
    ]);

    $adminUser = User::create([
        'name'=> 'Admin',
        'email'=> 'ayushsood965@gmail.com', 
        'password'=> '$2y$12$5unXoNiXhR5k1.aA0ONeHuh6WGPgpDhsKdy8gfrnAC/d.1Jl4u01G',
        'role'=> 'admin',
        'username'=> 'ayush965',
    ]);

    return "User Account and Admin account created successfully - admin ID - ayushsood965@gmail.com Password - 1 / user Id - ayush_94@live.com, Password - 1";
}


public function notFound(){
    return view('errors.404');
}

public function createAgent(Request $req){
    $validatedAgent = $req->validate([
        'name'=> 'required',
        'email'=> 'required|unique:users,email|email',
        'username'=> 'required|unique:users,username',
        'department'=> 'required',
        'password'=> 'required|confirmed',
        'password_confirmation'=> 'required',
    ]);
    
    $validatedAgent['role']='agent';
    if(User::create($validatedAgent)){
        return redirect('/manage-agents')->with('agentCreatedSuccessfully','Agent created successfully');
    } else {
        return redirect('/manage-agents')->with('agentCreationFailed','Agent Creation Failed');
    }

}
}