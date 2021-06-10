<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;


class LeaveApplicationHistoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('history', LeaveApplication::class);

        $myApplications = DB::table('leave_applications')
                            ->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
                            ->where('leave_applications.user_id', '=', Auth::id())
                            ->orderBy('leave_applications.created_at', 'asc')
                            ->orderBy('leaveStatus', 'asc')
                            ->select(['leave_applications.id', 'leaveStatus', 'leave_types.name as leaveType', 'leave_applications.created_at as createDate', 'startDate', 'endDate', 'fullDay', 'noOfDayDeduct'])
                            ->paginate(20);

        session(['pageTitle' => 'Leave Application History']);
        session(['pageTitleIcon' => 'fa fa-th-list']);

        return view('leave-application-history.index', [
            'LeaveApplications' => $myApplications,
    
        ]);
    }
}
