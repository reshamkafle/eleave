<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserApprovingOfficer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approving_id',
    ];
}