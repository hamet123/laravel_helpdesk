<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function getAgentDashboard(){
        return view('agentPages.agentDashboard');
    }
}
