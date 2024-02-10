<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function adminDashboard(){
        return view("adminPages.adminDashboard");
    }

    public function manageAgents(Request $req){
        $departments = Department::all();
        $agents = User::where('role','=','agent')->paginate(5);
        $req->session()->put('editAgent', false);
        return view("adminPages.manageAgents")->with("departments",$departments)->with('agents',$agents);
    }

    public function manageDepartments(Request $req){
        $departments = Department::paginate(5);
        $req->session()->put('editDepartment',false);
        return view("adminPages.manageDepartments")->with('departments',$departments);
    }

    public function manageTicketStatuses(Request $req){
        $statuses = Status::paginate(5);
        $req->session()->put('editStatus',false);
        return view("adminPages.manageTicketStatuses")->with('statuses',$statuses);
    }

    public function adminProfile(){
        $userData = User::find(Session::get('uid'));
        $userDetails = $userData->attachedInfo;
        return view("adminPages.adminProfile")->with("user",$userData)->with("userDetails",$userDetails);
    }

    public function searchAgentsAndUsers(){
        return view("adminPages.searchAgentsAndUsers");
    }

    public function getSearchTicket(){
        return view("adminPages.searchTicket")->with('searchTicketData', false);
    }

    public function createDepartment(Request $req){
        $validatedDepartment = $req->validate([
            'department' => 'required|unique:departments,department',
        ]);

        if(Department::create($validatedDepartment)){
            return redirect('/manage-departments')->with('departmentCreatedSuccessfully','Department created successfully');
        } 
        else {
            return redirect('/manage-departments')->with('departmentCreationFailed','Department creation failed');
        }
    }

    public function getEditDepartment($id, Request $req){
        $changeDepartment = Department::find($id);
        $departments = Department::all();
        $req->session()->put('editDepartment', true);
        return view('adminPages.manageDepartments', ['changeDepartment' => $changeDepartment])->with('departments', $departments);
    }

    public function editDepartment(Request $req){
        $validatedDepartment = $req->validate([
            'department' => 'required|unique:departments,department',
        ]);

        $department = Department::find($req->id);
        $department->update($validatedDepartment);
        return redirect('/manage-departments')->with('departmentUpdatedSuccessfully','Departments updated successfully');
    }

    public function deleteDepartment($id){
        $department = Department::find($id);
        $department->delete();
        return redirect('/manage-departments')->with('departmentDeletedSuccessfully','Department deleted successfully');
    }

    public function getEditAgent($id, Request $req){
        $agentDetails = User::find($id);
        $departments = Department::all();
        $agents = User::where('role','=','agent')->get()->toArray();
        $req->session()->put('editAgent', true);
        return view('adminPages.manageAgents', ['agentDetails' => $agentDetails])->with('agents', $agents)->with('departments', $departments);
    }

    public function editAgent(Request $req){
        $validatedAgent = $req->validate([
            'name' =>'required',
            'department_id' =>'required',
        ]);
        $agent = User::find($req->id);
        if($agent->update($validatedAgent)){
            return redirect('/manage-agents')->with('agentUpdatedSuccessfully','Agent updated successfully');
        } else{
            return redirect('/manage-agents')->with('agentUpdateFailed','Agent update failed');
        }
        

    }
    public function deleteAgent($id){
        $agent = User::find($id);
        $agent->delete();
        return redirect('/manage-agents')->with('agentDeletedSuccessfully','Agent deleted successfully');
    }
    public function createTicketStatus(Request $req){
        $validatedStatus = $req->validate([
            'status_name' => 'required|unique:statuses,status_name',
        ]);

        if(Status::create($validatedStatus)){
            return redirect('/manage-ticket-statuses')->with('statusCreatedSuccessfully','Status created successfully');
    } 
    else{
        return redirect('/manage-ticket-statuses')->with('statusCreationFailed','Status creation failed');
    }
    }

    public function editTicketStatus(Request $req){
        $validatedStatus = $req->validate([
            'status_name'=> 'required|unique:statuses,status_name',
        ]);
        $status = Status::find($req->id);
        if($status->update($validatedStatus)){
            return redirect('/manage-ticket-statuses')->with('statusUpdatedSuccessfully','Ticket status updated successfully');
        } else {
            return redirect('/manage-ticket-statuses')->with('statusUpdationFailed','Unable to update status');
        }
    }


    public function getEditTicketStatus($id,Request $req){
        $statusDetails = Status::find($id);
        $statuses = Status::all();
        $req->session()->put('editStatus', true);
        return view('adminPages.manageTicketStatuses', ['statusDetails' => $statusDetails])->with('statuses',$statuses);
    }

    public function deleteTicketStatus($id,Request $req){
        $status = Status::find($id);
        if($status->delete()){
            return redirect('/manage-ticket-statuses')->with('statusDeletedSuccessfully','Status deleted successfully');
        } else {
            return redirect('/manage-ticket-statuses')->with('statusDeletionFailed','Status deletion failed');
        }
    }

    public function searchTicket(Request $req){
        $validatedTicketNumber = $req->validate([
            'ticket_no'=> 'required|integer',
        ]);

        $ticket = Ticket::find($req->ticket_no);

        if($ticket){
           $user = $ticket->attachedUser;
           return view('adminPages.searchTicket', ['ticket' => $ticket, 'user'=>$user, 'searchTicketData'=> true]);
        }
        else {
            return redirect('/search-ticket')->with('noTicketFound','No Record Found for this ticket number');
        }
    }


   public function searchUser(Request $req){
        $validatedUserIdentifier = $req->validate([
            'user_identifier'=>'required',
        ]);

        $user = User::where('email','=',$req->user_identifier)->orWhere('username','=',$req->user_identifier)->orWhere('name','=',$req->user_identifier)->first();
        $userDetails = $user->attachedInfo;
        if($user){
            return view('adminPages.searchAgentsAndUsers',['user'=>$user, 'userDetails'=>$userDetails]);
        } else {
            return redirect('/search-agents-and-users')->with('noUserFound','We could not find any users with the specified details.');
        }
    }


    public function uploadAdminProfilePic(Request $req){
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
                return redirect('/admin-profile')->with('profilePicUpdatedSuccessfully', 'Profile Picture has been updated successfully');
            } else {
                return redirect('/admin-profile')->with('fileTypeError', 'Invalid File Type');
            }
        } else {
            return redirect('/admin-profile')->with('noFileError', 'No File Selected');
        }
    
}


public function editAdminProfile(Request $req){
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

    return redirect('/admin-profile')->with('profileUpdatedSuccessfully', 'Profile has been updated successfully');

}

public function updateAdminProfile(Request $req){
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
    return redirect('/admin-profile')->with('profileUpdatedSuccessfully', 'Profile has been updated successfully');

}
}
