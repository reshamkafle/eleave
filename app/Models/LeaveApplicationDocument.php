<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LeaveApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file',
        'leave_application_id',
        'mime',
    ];
}
