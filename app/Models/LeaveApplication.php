<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class LeaveApplication extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'startDate',
        'endDate',
        'name',
        'fullDay',
        'user_id',
        'leave_type_id',
        'noOfDayApplied',
        'noOfWorkingDay',
        'noOfPublicHoliday',
        'noOfDayDeduct',
        'leaveStatus',
        'needCertificate',    
    ];
}


