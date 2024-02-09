<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Attachment;
use App\Models\Department;
use App\Models\Status;
use App\Models\UserInfo;

function getPendingStatusId(){
    $statuses = Status::all();
    foreach($statuses as $status){
        if($status->status_name == 'pending'){
       return $status->id;
    }}
}
function getClosedStatusId(){
    $statuses = Status::all();
    foreach($statuses as $status){
        if($status->status_name == 'closed'){
       return $status->id;
    }}
}

class AgentController extends Controller
{
    public function getAgentDashboard(){
        return view('agentPages.agentDashboard');
    }

    public function getAssignedTickets(){
        $tickets = Ticket::where('agent_id', Session::get('uid'))->where('status_id','!=',getClosedStatusId())->paginate(5);
        return view('agentPages.assignedTickets')->with('tickets', $tickets);
    }

    public function closeTicketByAgent($id, Request $req){
        $ticket = Ticket::findOrFail($id);
        $currentUser = User::find(Session::get('uid'));
        if(!$ticket){
            return redirect()->back()->with('noTicketFoundError', 'We cannot find ticket with the given ID.');
        } else {
            if(($ticket->user_id == $currentUser->id) || $currentUser->role == 'admin' || $currentUser->role == 'agent'){
                $ticket->status_id = getClosedStatusId();
                $ticket->save();
                return redirect('/agent-closed-tickets')->with('agentTicketClosedSuccessfully', 'Ticket was successfully closed');
            } else {
                return redirect()->back()->with('noPermissionError', 'You do not have permission to perform this action.');
            }
        }
    }

    public function getAgentClosedTickets(){
        $tickets = Ticket::where('agent_id', Session::get('uid'))->where('status_id','=',getClosedStatusId())->paginate(5);
        return view('agentPages.closedTickets')->with('tickets', $tickets);
    }

    public function reOpenTicketByAgent($id){
        $ticket = Ticket::findOrFail($id);
        $currentUser = User::find(Session::get('uid'));
        if(!$ticket){
            return redirect()->back()->with('noTicketFoundError', 'We cannot find ticket with the given ID.');
        } else {
            if(($ticket->user_id == $currentUser->id) || $currentUser->role == 'admin' || $currentUser->role == 'agent'){
                $ticket->status_id = getPendingStatusId();
                $ticket->save();
                return redirect('/assigned-tickets')->with('agentTicketreOpenedSuccessfully', 'Ticket was Re-Opened Successfully.');
            } else {
                return redirect()->back()->with('noPermissionError', 'You do not have permission to perform this action.');
            }
        }
    }
    public function getAgentProfile(){
        $user = User::find(Session::get('uid'));
        $userDetails = $user->attachedInfo;
        return view('agentPages.agentProfile')->with('userDetails',$userDetails)->with('user',$user);
    }

    public function searchUsers(){
        return view('agentPages.searchUser');
    }

    public function searchAgentTickets(){
        return view('agentPages.searchTicket');
    }

    public function uploadAgentProfilePic(Request $req){
        $userData = User::find(Session::get('uid'));
        $validatedData = $req->validate([
            "file" => "nullable|file|max:2048",
        ]);

        if($req->hasFile('file')) {
            $profilePic = $req->file('file');
            $allowedExtensions = ['png', 'jpg', 'jpeg'];

            // Check if the file extension is in the allowed list
            if(in_array(strtolower($profilePic->getClientOriginalExtension()), $allowedExtensions)) {
                $profilePicName = $profilePic->store('profile_pic', 'public');
                $userData->profile_pic_path = $profilePicName;
                $userData->save();
                return redirect('/agent-profile')->with('profilePicUpdatedSuccessfully', 'Profile Picture has been updated successfully');
            } else {
                return redirect('/agent-profile')->with('fileTypeError', 'Invalid File Type');
            }
        } else {
            return redirect('/agent-profile')->with('noFileError', 'No File Selected');
        }
    
}


public function editAgentProfile(Request $req){
    $userData = User::find(Session::get('uid'));
    $req->validate([
        "email" => "nullable|email",
        "name" => "nullable",
        "phone" => "nullable|numeric",
        "address" => "nullable",
        "facebook" => "nullable|url",
        "twitter" => "nullable|url",
        "instagram" => "nullable|url",
        "youtube" => "nullable|url"
    ]);

    UserInfo::create([
        "user_id" => Session::get('uid'),
        "phone" => $req->phone,
        "address" => $req->address,
        "facebook" => $req->facebook,
        "twitter" => $req->twitter,
        "instagram" => $req->instagram,
        "youtube" => $req->youtube,
    ]);

    // Updating User Full Name
    $userData->name = $req->name;
    $userData->save();

    return redirect('/agent-profile')->with('profileUpdatedSuccessfully', 'Profile has been updated successfully');

}


public function updateAgentProfile(Request $req){
    $userData = User::find(Session::get('uid'));
    $userDetails = $userData->attachedInfo;
    $userInfoId = $userDetails->id;

    $infoToUpdate = UserInfo::find($userInfoId);
    $req->validate([
        "phone" => "nullable|numeric",
        "address" => "nullable",
        "facebook" => "nullable|url",
        "twitter" => "nullable|url",
        "instagram" => "nullable|url",
        "youtube" => "nullable|url"
    ]);

    $infoToUpdate->phone = $req->phone;
    $infoToUpdate->address = $req->address;
    $infoToUpdate->facebook = $req->facebook;
    $infoToUpdate->twitter = $req->twitter;
    $infoToUpdate->instagram = $req->instagram;
    $infoToUpdate->youtube = $req->youtube;
    $infoToUpdate->save();

     // Updating User Full Name
     $userData->name = $req->name;
     $userData->save();
    return redirect('/agent-profile')->with('profileUpdatedSuccessfully', 'Profile has been updated successfully');

}

public function searchTicketByAgent(Request $req){
    $validatedTicketNumber = $req->validate([
        'ticket_no'=> 'required|integer',
    ]);

    $ticket = Ticket::find($req->ticket_no);

    if($ticket){
       $user = $ticket->attachedUser;
       return view('agentPages.searchTicket', ['ticket' => $ticket, 'user'=>$user, 'searchTicketData'=> true]);
    }
    else {
        return redirect('/search-agent-tickets')->with('noTicketFound','No Record Found for this ticket number');
    }
}

public function searchUserByAgent(Request $req){
    $validatedUserIdentifier = $req->validate([
        'user_identifier'=>'required',
    ]);

    $user = User::where('email','=',$req->user_identifier)->orWhere('username','=',$req->user_identifier)->orWhere('name','=',$req->user_identifier)->first();
    $userDetails = $user->attachedInfo;
    if($user){
        return view('agentPages.searchUser',['user'=>$user, 'userDetails'=>$userDetails]);
    } else {
        return redirect('/search-users')->with('noUserFound','We could not find any users with the specified details.');
    }
}

}
