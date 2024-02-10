<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Comment;
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
            if($user->role== 'agent'){
                return redirect("/agent-dashboard");
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

public function changeAdminPassword(Request $req){
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
            return redirect('/admin-profile')->with('passwordChangedSuccess','Your Password has been changed successfully');
        }
            else return redirect('/admin-profile')->withErrors(['wrongCurrentPassword'=> 'You have entered incorrect current password']);
}
else{
    return redirect('/login')->with('LoginError','Please Login First');
}
}


public function changeAgentPassword(Request $req){
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
            return redirect('/agent-profile')->with('passwordChangedSuccess','Your Password has been changed successfully');
        }
            else return redirect('/agent-profile')->withErrors(['wrongCurrentPassword'=> 'You have entered incorrect current password']);
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
        'department_id' => NULL,
    ]);

    $adminUser = User::create([
        'name'=> 'Admin',
        'email'=> 'ayushsood965@gmail.com', 
        'password'=> '$2y$12$5unXoNiXhR5k1.aA0ONeHuh6WGPgpDhsKdy8gfrnAC/d.1Jl4u01G',
        'role'=> 'admin',
        'username'=> 'ayush965',
        'department_id' => NULL,
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
        'department_id'=> 'required',
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

    public function ticketConfig(Request $req) {
        $validatedConfig = $req->validate([
            'id' => 'required',
        ]);

        if($validatedConfig){
            $ticket = Ticket::find($req->id);
            if($req->department !== NULL){
                $ticket->department_id = $req->department;
            }
            if($req->status !== NULL){
            $ticket->status_id = $req->status;
            }
            $ticket->save();
            return redirect("/ticket/$req->id")->with('ticketConfigChanged', 'Ticket Details were changed successfully');
        } else {
            return redirect("/ticket/$req->id")->with('ticketConfigChangeFailed', 'Ticket Details were not changed');
        }
    }


    public function addComment(Request $req){
        $validatedComment = $req->validate([
            'comment' => 'required|min:15',
        ]);

        if($validatedComment){
            $comment = new Comment;
            $comment->comment = $req->comment;
            $comment->user_id = Session::get('uid');
            $comment->ticket_id = $req->ticket_id;
            $comment->save();
            return redirect("/ticket/$req->ticket_id")->with('commentAddedSuccess', 'Comment Added Successfully');
        } else {
            return redirect("/ticket/$req->ticket_id")->with('commentAddFailed', 'Comment Add Failed');
        }
    }

    public function deleteComment($id){
        $comment = Comment::find($id);
        if(Session::get('uid')==$comment->user_id){
            $comment->delete();
            return redirect("/ticket/$comment->ticket_id")->with('commentDeletedSuccess', 'Comment Deleted Successfully');
        } else {
            return redirect("/ticket/$comment->ticket_id")->with('commentDeleteFailed', 'You do not have permission to delete this comment');
        }
    }   
}