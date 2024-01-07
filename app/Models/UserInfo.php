<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    public function linkedUser(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        
    ];
}
