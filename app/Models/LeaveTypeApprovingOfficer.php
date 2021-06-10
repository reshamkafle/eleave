<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LeaveTypeApprovingOfficer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type_id',
    ];
}
