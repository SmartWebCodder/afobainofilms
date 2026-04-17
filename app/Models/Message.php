<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'email',
    'phone',
    'event_date',
    'event_type',
    'vision',
    'status',
])]
class Message extends Model
{
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }
}
