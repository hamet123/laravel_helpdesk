<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\UserInfo;
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
            "security_question"=>"required | integer",
            "security_answer"=>"required",
            "password"=>"required | confirmed",
            "password_confirmation"=>"required",
        ]);

        if($validatedUser){
        $validatedUser['security_answer'] = bcrypt($validatedUser['security_answer']);
        User::create($validatedUser);
        $user = User::where('username',$req->username)->first();
        $req->session()->put("uid", $user->id); 
        $req->session()->put("role", $user->role);
        $req->session()->put("name", $user->name); 
        $req->session()->flash('loginRegister','Your account has been created successfully.');

        return redirect("/user-dashboard");
        } else {
            return redirect('login')->with('somethingWentWrong', 'Something went wrong. Please try again later !!!');
        }
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
       \Session::flush();
       \Auth::logout();
        // $req->session()->pull('uid',null);
        $req->session()->flash('logout','You have successfully logged out.');
        return redirect('/login');
    }

    public function getForgotPassword(){
        return view('authenticate.forgotPassword');
    }

    public function forgotPassword(Request $req){
        $validatedUserCredentials = $req->validate([
            "email"=>"required | email",
            "security_question"=>"required| integer",
            "security_answer"=>"required",
        ]);

        $user = User::where('email',$validatedUserCredentials['email'])->first();
       if($user){
        if(($validatedUserCredentials['security_question'] == $user->security_question) && (Hash::check($validatedUserCredentials['security_answer'],$user->security_answer))){
            return view('authenticate.changeYourPassword')->with('user', $user);
        } else {
            return redirect('/forgot-password')->with('securityQuestionError', 'Security Question and Answer does not match !');
        }
       } else {
        return redirect('/forgot-password')->with('emailError', 'Email does not exist!');
       }
        
        
    }
    

    public function changeYourPassword(Request $req){
        
            $user = User::find($req->uid);
            $req->validate([
                'password'=> 'required|confirmed',
                'password_confirmation'=> 'required',  
            ]);

            if($req->filled('uid')){
                $user->password = Hash::make($req->password);
                $user->save();
                return redirect('/login')->with('passwordChangedSuccess','Your Password has been changed successfully');
            }
                else return redirect('/login')->withErrors(['somethingWentWrong'=> 'Something went wrong ! Please try again later !!']);
    
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
        'security_question' => 2,
        'security_answer' => '$2y$12$5unXoNiXhR5k1.aA0ONeHuh6WGPgpDhsKdy8gfrnAC/d.1Jl4u01G',
    ]);

    $adminUser = User::create([
        'name'=> 'Admin',
        'email'=> 'ayushsood965@gmail.com', 
        'password'=> '$2y$12$5unXoNiXhR5k1.aA0ONeHuh6WGPgpDhsKdy8gfrnAC/d.1Jl4u01G',
        'role'=> 'admin',
        'username'=> 'ayush965',
        'department_id' => NULL,
        'security_question' => 2,
        'security_answer' => '$2y$12$5unXoNiXhR5k1.aA0ONeHuh6WGPgpDhsKdy8gfrnAC/d.1Jl4u01G',
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


    public function searchQuery(Request $request)
    {
        $query = $request->input('query');

        $results1 = Comment::where('comment', 'LIKE', "%$query%")->get()->map(function ($result) {
            $result['model_type'] = 'Comment';
            return $result;
        });
        
        $results2 = Ticket::where('subject', 'LIKE', "%$query%")->get()->map(function ($result) {
            $result['model_type'] = 'Ticket';
            return $result;
        });
        
        $results3 = Ticket::where('description', 'LIKE', "%$query%")->get()->map(function ($result) {
            $result['model_type'] = 'Ticket';
            return $result;
        });
        
        $results4 = User::where('name', 'LIKE', "%$query%")->get()->map(function ($result) {
            $result['model_type'] = 'User';
            return $result;
        });
        
        $results5 = UserInfo::where('address', 'LIKE', "%$query%")->get()->map(function ($result) {
            $result['model_type'] = 'UserInfo';
            return $result;
        });
        
        $results6 = UserInfo::where('phone', 'LIKE', "%$query%")->get()->map(function ($result) {
            $result['model_type'] = 'UserInfo';
            return $result;
        });
        
        $results7 = Ticket::where('id', 'LIKE', "%$query%")->get()->map(function ($result) {
            $result['model_type'] = 'Ticket';
            return $result;
        });
        
        $combinedResults = $results1
            ->merge($results2)
            ->merge($results3)
            ->merge($results4)
            ->merge($results5)
            ->merge($results6)
            ->merge($results7);
        
        return view('searchResults', ['results' => $combinedResults]);
        
    }


}