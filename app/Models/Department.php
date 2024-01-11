<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department',
    ];

    public function linkedTickets(){
        return $this->belongsToMany(Ticket::class,'id','department_id');
    }
}

