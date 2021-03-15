<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{    
    protected $fillable = [
        'created_by', 'subject', 'content', 'start_date', 'expiration_date', 'viewed_by', 'read_by_all', 'user_id'
    ];
}
