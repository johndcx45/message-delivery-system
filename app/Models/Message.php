<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'created_by', 'subject', 'content', 'start_date', 'expiration_date', 'viewed_by', 'read_by_all', 'user_id'
    ];

    protected $dates = ['deleted_at'];
}
