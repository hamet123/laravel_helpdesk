<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Status;
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

    public function searchTicket(){
        return view("adminPages.searchTicket");
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
            'department' =>'required',
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
}
