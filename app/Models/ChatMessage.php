<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class ChatMessage extends Model
{
    protected $fillable = ['presentation_id', 'userName', 'content', 'isValidated', 'isRejected', 'isTeacher'];
 
    protected $casts = [
        'isValidated' => 'boolean',
        'isRejected' => 'boolean',
        'isTeacher' => 'boolean',
    ];
}