<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function adminDashboard(){
        return view("adminPages.adminDashboard");
    }

    public function manageAgents(){
        return view("adminPages.manageAgents");
    }

    public function manageDepartments(){
        return view("adminPages.manageDepartments");
    }

    public function manageTicketStatuses(){
        return view("adminPages.manageTicketStatuses");
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
}
