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
            $tickets=$userData->attachedTickets;
            return view("userPages.pendingTickets")->with("user",$userData)->with("tickets",$tickets);
        }
        else{
            return redirect("/login")->with("loginError","Please Login First to view all pending Tickets");
        }
    }
    public function getClosedTickets(){
        if(Session::has('uid')){
            $userData = User::find(Session::get('uid'));
            $tickets = $userData->attachedTickets;
            return view("userPages.closedTickets")->with("user",$userData)->with("tickets",$tickets);
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
            ]);
            
            
            Ticket::create([
                "subject"           => $validatedTicket["subject"],
                "select_department" => $validatedTicket["select_department"],
                "user_id"           => Session::get("uid"),
                "description"       => $validatedTicket["description"],
                "status"            => "pending",
            ]);

            $validatedAttachments = $req->validate([
                "attachments.*" => "required|mimes:png,jpg,jpeg,gif,pdf,doc,docx|max:2048",
            ]);

            if($req->hasFile('attachments')) {
                foreach ($validatedAttachments["attachments"] as $attachment) {
                    $attachmentName = $attachment->store('attachments','public');
                    Attachment::create([
                        "path" => $attachmentName,
                        "ticket_id" => Ticket::latest()->first()->id,
                    ]);
                }
            }
          
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

    public function editTicket(Request $req){
        $ticket = Ticket::find($req->id);
        if($ticket->user_id == session('uid')) {
           $validatedTicket = $req->validate([
            "subject" => "required",
            "select_department" => "required",
            "description" => "required",
           ]);
           $ticket->update($validatedTicket);
            $validatedAttachments = $req->validate([
                "attachments.*" => "required|mimes:png,jpg,jpeg,gif,pdf,doc,docx|max:2048",
            ]);
            if($req->hasFile('attachments')) {
                foreach ($validatedAttachments["attachments"] as $attachment) {
                    $attachmentName = $attachment->store('attachments','public');
                    Attachment::create([
                        "path" => $attachmentName,
                        "ticket_id" => Ticket::latest()->first()->id,
                    ]);
                }
            }
            return redirect('/user-dashboard')->with('ticketUpdatedSuccessfully', 'Ticket has been updated successfully');
           
        }
    }

    public function closeTicket($id, Request $req){
        $foundTicket = Ticket::find($id);
        if($foundTicket->user_id == session('uid')){
            $foundTicket->status = 'closed';
            $foundTicket->save();
            return redirect('/user-dashboard')->with('ticketClosedSuccessfully','Ticket has been closed successfully');
        }
        else {
            return "Your are not authorised to close this ticket";
        }
    }

    public function reOpenTicket($id, Request $req){
        $foundTicket = Ticket::find($id);
        if($foundTicket->user_id == session('uid')){
            $foundTicket->status = 'pending';
            $foundTicket->save();
            return redirect('/user-dashboard')->with('ticketReopenedSuccessfully','Ticket has been Re-Opened successfully');
        }
        else {
            return "Your are not authorised to re-open this ticket";
        }
    }
    public function getEditTicketPage($id, Request $req){
        if(Session::has('uid')){
            $findTicket = Ticket::find($id);
            $user = $findTicket->attachedUser;
            $attachments = $findTicket->attachedAttachments;
            return view('userPages.editTicket')->with('ticket',$findTicket)->with('user',$user)->with('attachments',$attachments);
        }
    }

}