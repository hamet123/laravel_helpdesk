<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view("adminPages.adminProfile");
    }

    public function searchAgentsAndUsers(){
        return view("adminPages.searchAgentsAndUsers");
    }
    
}
