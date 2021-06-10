<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveApplication;


class ManageLeaveApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $this->authorize('manage', LeaveApplication::class);

        //this is leave applications based on leave type approving officer
        $leaveTypeLeaveOfficerApplication = DB::table('leave_applications')
                                            ->join('leave_type_approving_officers','leave_type_approving_officers.leave_type_id', '=', 'leave_applications.leave_type_id')
                                            ->join('users', 'users.id', '=', 'leave_applications.user_id')
                                            ->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
                                            ->where('leaveStatus', '=', Config::get('constants.application_status.under_process'))
                                            ->where('leave_type_approving_officers.user_id', '=', Auth::id())
                                            ->select(['users.name as personName', 'leave_applications.id', 'leave_types.name as leaveType', 'leave_applications.created_at as createDate', 'startDate', 'endDate', 'fullDay', 'noOfDayDeduct'])
                                            ->get();

         //this is leave application based on user approving officer.                                                                         
        $userLeaveOfficerApplication = DB::table('leave_applications')
                                        ->join('users', 'users.id', '=', 'leave_applications.user_id')
                                        ->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
                                        ->join('user_approving_officers', 'user_approving_officers.user_id', '=', 'leave_applications.user_id')
                                        ->where('user_approving_officers.approving_id', '=', Auth::id())
                                        ->where('leaveStatus', '=', Config::get('constants.application_status.under_process'))
                                        ->select(['users.name as personName', 'leave_applications.id', 'leave_types.name as leaveType', 'leave_applications.created_at as createDate', 'startDate', 'endDate', 'fullDay', 'noOfDayDeduct'])
                                        ->get();
        

        $merged = $leaveTypeLeaveOfficerApplication->merge($userLeaveOfficerApplication);

        $merged = $merged->sortByDesc('personName')->unique();

        session(['pageTitle' => 'Leave Application']);
        session(['pageTitleIcon' => 'fa fa-th-list']);
        
        return view('manage-leave-application.index', [
            'LeaveApplications' => $merged,
    
        ]);

    }

    public function approve($id)
    {
        $this->authorize('manage', LeaveApplication::class);

        $application = LeaveApplication::find($id);
        $application->leaveStatus = Config::get('constants.application_status.approve');
        $application->save();

        return redirect()->route('leave_application_manage')->with('success', trans('message.update_success'));

    }

    public function reject($id)
    {
        $this->authorize('manage', LeaveApplication::class);

        $application = LeaveApplication::find($id);
        $application->leaveStatus = Config::get('constants.application_status.reject');
        $application->save();

        return redirect()->route('leave_application_manage')->with('success', trans('message.update_success'));
    }

    public function destroy($id)
    {
        $this->authorize('manage', LeaveApplication::class);

        $application = LeaveApplication::find($id);
        $application->delete();

        return redirect()->route('leave_application_manage')->with('success', trans('message.delete_success'));
    }
}
