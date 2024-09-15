<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'event_name',
        'is_official',
        'deadline',
        'event_start',
        'event_end',
        'event_place_name',
        'event_place_address',
        'owner',
        'event_description',
        'attendees',
        'memo',
        'created_at',
        'updated_at'
    ];
}
