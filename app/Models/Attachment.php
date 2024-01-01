<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    public function attachedTicket(){
        return $this->belongsTo(Ticket::class,"ticket_id","id");
    }
}