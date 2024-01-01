<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Attachment;


class MainController extends Controller
{
    public function getHome(){
        return  view("home");
    }
    public function getAllTickets(Request $req){
        if(Session::has('uid')){
            $userData = User::find(Session::get('uid'))->toArray();
            $ticketsData = Ticket::where('user_id',$userData['id'])->get()->toArray();
            return view("userPages.dashboard")->with("user",$userData)->with("tickets",$ticketsData);
        }
        else {
            return redirect("/login")->withErrors("loginFirst","Please login First");
        }
        
    }
    public function getPendingTickets(){
        if(Session::has('uid')){
            $userData = User::find(Session::get('uid'));
            return view("userPages.pendingTickets")->with("user",$userData);
        }
        else{
            return redirect("/login")->with("loginError","Please Login First to view all pending Tickets");
        }
    }
    public function getClosedTickets(){
        if(Session::has('uid')){
            $userData = User::find(Session::get('uid'));
            return view("userPages.closedTickets")->with("user",$userData);
        }
        else{
            return redirect("/login")->with("loginError","Please Login First to view all closed Tickets");
        }
    }
    public function getMyProfile(){
        if(Session::has('uid')){
            $userData = User::find(Session::get('uid'));
            return view("userPages.myProfile")->with("user",$userData);
        }
        else{
            return redirect("/login")->with("loginError","Please Login First to view your Profile");
        }
    }
    public function getCreateTicket(){
        if(Session::has('uid')){
            $userData = User::find(Session::get('uid'));
            return view("userPages.createTicket")->with("user",$userData);
        }
        else{
            return redirect("/login")->with("loginError","Please Login First to Raise a Ticket");
        }
    }

    public function createTicket(Request $req){
        if(Session::has("uid")){
            $userData = User::find(Session::get("uid"));
            $validatedTicket=$req->validate([
                "subject" => "required",
                "select_department" => "required",
                "description" => "required",
                "attachment" => "required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048"
            ]);
            $attachmentPath = $req->file("attachment")->store("ticketAttachments","public");
            
            Ticket::create([
                "subject"           => $validatedTicket["subject"],
                "select_department" => $validatedTicket["select_department"],
                "user_id"           => Session::get("uid"),
                "description"       => $validatedTicket["description"],
                "status"            => "pending",
                "attachment"        => $attachmentPath,
            ]);
          
            $req->session()->flash('ticketRaisedSuccessfully','Ticket has been raised successfully');
           return redirect('/user-dashboard');
            
            
        } else{
            $req->session()->flash("loginError","Please Login First");
            return redirect("/login");
        }
    }
    
public function getTicket($id){
        if(Session::has("uid")){
            $userData = User::find(Session::get("uid"));
            $ticket = Ticket::find($id);
            $ticketUser = $ticket->attachedUser;
            $ticketAttachments = $ticket->attachedAttachments;
            return view('userPages.ticket')->with('ticket', $ticket)->with('ticketUser', $ticketUser)->with('ticketAttachments', $ticketAttachments);
        }
        else {
            return redirect("/login")->with("loginError","Please Login First to View a Ticket");
        }

}





}