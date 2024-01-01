<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject',
        'select_department',
        'status',
        'description',
        'attachment'
    ];
public function attachedUser(){
    return $this->belongsTo(User::class,'user_id','id');
}
    public function attachedAttachments(){
    return $this->hasMany(Attachment::class);
}
}