<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TicketExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $privateTicketValues;

    public function __construct($tickets)
    {
        $this->privateTicketValues = $tickets;
    }
    public function view() : View
    {
        return view('excel.ticketReport', ['tickets' => $this->privateTicketValues]);
    }
}
