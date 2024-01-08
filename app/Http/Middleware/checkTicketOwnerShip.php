<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\Ticket;

class TicketOwnershipMiddleware
{
    public function handle($request, Closure $next)
    {
        $ticketId = $request->route('id'); // Assuming the ticket ID is passed in the route parameters

        if ($this->isTicketOwner($ticketId)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You are not authorized to access this ticket.');
    }

    private function isTicketOwner($ticketId)
    {
        $userId = Session::get('uid');
        $ticket = Ticket::find($ticketId);

        return $ticket && $ticket->user_id == $userId;
    }
}
