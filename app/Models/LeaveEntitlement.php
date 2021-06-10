<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LeaveEntitlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'entitlement',
        'user_id',
        'leave_type_id',
        'year',
    ];
}
