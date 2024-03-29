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
use App\Models\Comment;
use App\Models\Status;
use App\Models\UserInfo;
use Barryvdh\DomPDF\Facade\Pdf;
use Excel;
use App\Exports\TicketExport;

function getPendingStatusId()
{
    $statuses = Status::all();
    foreach ($statuses as $status) {
        if ($status->status_name == 'pending') {
            return $status->id;
        }
    }
}

function getClosedStatusId()
{
    $statuses = Status::all();
    foreach ($statuses as $status) {
        if ($status->status_name == 'closed') {
            return $status->id;
        }
    }
}

class MainController extends Controller
{
    public function getAllTickets(Request $req)
    {
        $statuses = Status::all();
        $departments = Department::all();
        $userData = User::find(Session::get('uid'))->toArray();
        $ticketsData = Ticket::where('user_id', $userData['id'])->paginate(5);
        return view('userPages.dashboard')->with('user', $userData)->with('tickets', $ticketsData)->with('statuses', $statuses)->with('departments', $departments);
    }
    public function getPendingTickets()
    {
        $statuses = Status::all();
        $departments = Department::all();
        $userData = User::find(Session::get('uid'));
        $tickets = Ticket::where('user_id', $userData->id)
            ->where('status_id', '!=', getClosedStatusId())
            ->paginate(5);
        return view('userPages.pendingTickets', ['tickets' => $tickets])
            ->with('user', $userData)
            ->with('statuses', $statuses)
            ->with('departments', $departments);
    }
    public function getClosedTickets()
    {
        $statuses = Status::all();
        $departments = Department::all();
        $userData = User::find(Session::get('uid'));
        $tickets = Ticket::where('user_id', $userData->id)
            ->where('status_id', '=', getClosedStatusId())
            ->paginate(5);
        return view('userPages.closedTickets')->with('user', $userData)->with('tickets', $tickets)->with('statuses', $statuses)->with('departments', $departments);
    }
    public function getMyProfile()
    {
        $userData = User::find(Session::get('uid'));
        $userDetails = $userData->attachedInfo;
        return view('userPages.myProfile')->with('user', $userData)->with('userDetails', $userDetails);
    }

    public function getCreateTicket()
    {
        $departments = Department::all();
        $userData = User::find(Session::get('uid'));
        return view('userPages.createTicket')->with('user', $userData)->with('departments', $departments);
    }

    public function createTicket(Request $req)
    {
        $userData = User::find(Session::get('uid'));
        $validatedTicket = $req->validate([
            'subject' => 'required',
            'department_id' => 'required',
            'description' => 'required',
        ]);

        Ticket::create([
            'subject' => $validatedTicket['subject'],
            'department_id' => $validatedTicket['department_id'],
            'user_id' => $userData['id'],
            'description' => $validatedTicket['description'],
            'status_id' => getPendingStatusId(),
            'agent_id' => Department::find($validatedTicket['department_id'])->linkedUser['id'],
        ]);

        $validatedAttachments = $req->validate([
            'attachments.*' => 'required|mimes:png,jpg,jpeg,gif,pdf,doc,docx|max:2048',
        ]);

        if ($req->hasFile('attachments')) {
            foreach ($validatedAttachments['attachments'] as $attachment) {
                $attachmentName = $attachment->store('attachments', 'public');
                Attachment::create([
                    'path' => $attachmentName,
                    'ticket_id' => Ticket::latest()->first()->id,
                ]);
            }
        }

        $req->session()->flash('ticketRaisedSuccessfully', 'Ticket has been raised successfully');
        return redirect('/user-dashboard');
    }

    public function getTicket($id)
    {
        $userData = User::find(Session::get('uid'));
        $comments = Comment::where('ticket_id', $id)->get();
        $ticket = Ticket::find($id);
        $departments = Department::all();
        $statuses = Status::all();
        $ticketUser = $ticket->attachedUser;
        $ticketAttachments = $ticket->attachedAttachments;
        return view('ticket')->with('ticket', $ticket)->with('ticketUser', $ticketUser)->with('ticketAttachments', $ticketAttachments)->with('departments', $departments)->with('statuses', $statuses)->with('comments', $comments);
    }

    public function downloadticket($id)
    {
        $ticket = Ticket::find($id);
        $departments = Department::all();
        $statuses = Status::all();
        $ticketUser = $ticket->attachedUser;
        // return view('pdf.printTicket',compact('ticket', 'departments', 'statuses', 'ticketUser'));
        $pdf = Pdf::loadView('pdf.printTicket', compact('ticket', 'departments', 'statuses', 'ticketUser'));
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'montserrat']);
        return $pdf->download('printTicket/' . $ticket['id'] . '.pdf');
        // return $pdf->stream();
    }

    public function editTicket(Request $req)
    {
        $ticket = Ticket::find($req->id);
        if ($ticket->user_id == session('uid')) {
            $validatedTicket = $req->validate([
                'subject' => 'required',
                'department_id' => 'required',
                'description' => 'required',
            ]);
            $ticket->update($validatedTicket);
            $validatedAttachments = $req->validate([
                'attachments.*' => 'required|mimes:png,jpg,jpeg,gif,pdf,doc,docx|max:2048',
            ]);
            if ($req->hasFile('attachments')) {
                foreach ($validatedAttachments['attachments'] as $attachment) {
                    $attachmentName = $attachment->store('attachments', 'public');
                    Attachment::create([
                        'path' => $attachmentName,
                        'ticket_id' => Ticket::latest()->first()->id,
                    ]);
                }
            }
            return redirect('/user-dashboard')->with('ticketUpdatedSuccessfully', 'Ticket has been updated successfully');
        } else {
            return redirect('/')->with('loginError', 'You are not authorized to do this action.');
        }
    }

    public function closeTicket($id, Request $req)
    {
        $foundTicket = Ticket::find($id);
        if ($foundTicket->user_id == session('uid')) {
            $foundTicket->status_id = getClosedStatusId();
            $foundTicket->save();
            return redirect('/user-dashboard')->with('ticketClosedSuccessfully', 'Ticket has been closed successfully');
        } else {
            return 'Your are not authorised to close this ticket';
        }
    }

    public function reOpenTicket($id, Request $req)
    {
        $foundTicket = Ticket::find($id);
        if ($foundTicket->user_id == session('uid')) {
            $foundTicket->status_id = getPendingStatusId();
            $foundTicket->save();

            return redirect('/user-dashboard')->with('ticketReopenedSuccessfully', 'Ticket has been Re-Opened successfully');
        } else {
            return 'Your are not authorised to re-open this ticket';
        }
    }
    public function getEditTicketPage($id, Request $req)
    {
        $findTicket = Ticket::find($id);
        $departments = Department::all();
        $user = $findTicket->attachedUser;
        $attachments = $findTicket->attachedAttachments;
        return view('userPages.editTicket')->with('ticket', $findTicket)->with('user', $user)->with('attachments', $attachments)->with('departments', $departments);
    }

    // public function uploadProfilePic(Request $req){
    //     if(Session::has('uid')){
    //         $userData = User::find(Session::get('uid'));
    //         $validatedData = $req->validate([
    //             "file" => "nullable|file|mimes:png,jpg,jpeg|max:2048",
    //         ]);

    //         if($req->hasFile('file')) {
    //             $profilePic = $req->file('file');

    //             // Ensure the file is valid (this will implicitly check for the file type)
    //             if($profilePic->isValid()){
    //                 $profilePicName = $profilePic->store('profile_pic','public');
    //                 $userData->profile_pic_path = $profilePicName;
    //                 $userData->save();
    //                 return redirect('/my-profile')->with('profilePicUpdatedSuccessfully','Profile Picture has been updated successfully');
    //             } else {
    //                 return redirect('/user-dashboard')->with('fileTypeError','Invalid File Type');
    //             }
    //         } else {
    //             return redirect('/my-profile')->with('noFileError','No File Selected');
    //         }
    //     } else {
    //         return "You are not allowed to update this profile picture";
    //     }
    // }

    public function uploadProfilePic(Request $req)
    {
        $userData = User::find(Session::get('uid'));
        $validatedData = $req->validate([
            'file' => 'nullable|file|max:2048',
        ]);

        if ($req->hasFile('file')) {
            $profilePic = $req->file('file');
            $allowedExtensions = ['png', 'jpg', 'jpeg'];

            // Check if the file extension is in the allowed list
            if (in_array(strtolower($profilePic->getClientOriginalExtension()), $allowedExtensions)) {
                $profilePicName = $profilePic->store('profile_pic', 'public');
                $userData->profile_pic_path = $profilePicName;
                $userData->save();
                return redirect('/my-profile')->with('profilePicUpdatedSuccessfully', 'Profile Picture has been updated successfully');
            } else {
                return redirect('/my-profile')->with('fileTypeError', 'Invalid File Type');
            }
        } else {
            return redirect('/my-profile')->with('noFileError', 'No File Selected');
        }
    }

    public function editProfile(Request $req)
    {
        $userData = User::find(Session::get('uid'));
        $req->validate([
            'email' => 'nullable|email',
            'name' => 'nullable',
            'phone' => 'nullable|numeric',
            'address' => 'nullable',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        UserInfo::create([
            'user_id' => Session::get('uid'),
            'phone' => $req->phone,
            'address' => $req->address,
            'facebook' => $req->facebook,
            'twitter' => $req->twitter,
            'instagram' => $req->instagram,
            'youtube' => $req->youtube,
        ]);

        // Updating User Full Name
        $userData->name = $req->name;
        $userData->save();

        return redirect('/my-profile')->with('profileUpdatedSuccessfully', 'Profile has been updated successfully');
    }

    public function updateProfile(Request $req)
    {
        $userData = User::find(Session::get('uid'));
        $userDetails = $userData->attachedInfo;
        $userInfoId = $userDetails->id;

        $infoToUpdate = UserInfo::find($userInfoId);
        $req->validate([
            'phone' => 'nullable|numeric',
            'address' => 'nullable',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
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
        return redirect('/my-profile')->with('profileUpdatedSuccessfully', 'Profile has been updated successfully');
    }

    public function getAgentReport()
    {
        $pdf = PDF::loadView('pdf.agentReport.pdf');
        return $pdf->download('agent-report.pdf');
    }

    public function getTicketReport()
    {
        $departments = Department::all();
        $statuses = Status::all();
        $agents = User::where('role', 'agent')->get();
        return view('adminPages.ticketReport', compact('departments', 'statuses', 'agents'));
    }

    public function ticketReport(Request $request)
    {

        $ticketQuery = Ticket::query();

        if ($request->filled('department')) {
            $ticketQuery->where('department_id', $request->input('department'));
        }

        if ($request->filled('agent')) {
            $ticketQuery->where('agent_id', $request->input('agent'));
        }

        if ($request->filled('status')) {
            $ticketQuery->where('status_id', $request->input('status'));
        }

        $tickets = $ticketQuery->get();
        
        if($request->has('pdf')){
        // return view('pdf.ticketReport', compact('tickets'));
        $pdf = PDF::loadView('pdf.ticketReport', compact('tickets'));
        return $pdf->download('ticket-report.pdf');
        }
        if($request->has('excel')){
            return Excel::download(new TicketExport($tickets), 'ticket_report.xlsx');
        }
    }

}
