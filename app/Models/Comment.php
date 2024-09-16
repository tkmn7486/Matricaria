<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'event_id',
        'user_name',
        'comment',
        'created_at',
        'updated_at'
    ];
}