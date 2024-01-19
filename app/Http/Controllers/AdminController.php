<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function adminDashboard(){
        return view("adminPages.adminDashboard");
    }

    public function manageAgents(Request $req){
        $departments = Department::all();
        $agents = User::where('role','=','agent')->get()->toArray();
        $req->session()->put('editAgent', false);
        return view("adminPages.manageAgents")->with("departments",$departments)->with('agents',$agents);
    }

    public function manageDepartments(Request $req){
        $departments = Department::all();
        $req->session()->put('editDepartment',false);
        return view("adminPages.manageDepartments")->with('departments',$departments);
    }

    public function manageTicketStatuses(Request $req){
        $statuses = Status::all();
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
        if($user){
            return view('adminPages.searchAgentsAndUsers',['user'=>$user]);
        } else {
            return redirect('/search-agents-and-users')->with('noUserFound','We could not find any users with the specified details.');
        }
    }
}
