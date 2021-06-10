<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeaveType;
use App\Models\LeaveTypeApprovingOfficer;
use Illuminate\Support\Facades\DB;


class LeaveTypeApprovingOfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $this->authorize('show', LeaveTypeApprovingOfficer::class);

        $users = User::all();
        $leaveType = LeaveType::find($id);
        $approving_officers = DB::table('leave_type_approving_officers')
                            ->join('leave_types', 'leave_types.id','=', 'leave_type_approving_officers.leave_type_id')
                            ->join('users', 'users.id', '=', 'leave_type_approving_officers.user_id')
                            ->where('leave_types.id', '=', $id)
                            ->select(['leave_type_approving_officers.id','leave_types.name as typeType', 'users.name as userName'])
                            ->paginate(20);
              
        session(['pageTitle' => 'Leave Type - Approving Officer']);
        session(['pageTitleIcon' => 'fa fa-th-list']);

        return view('leave-type-approving-officer.show', [
            'users' => $users,
            'leaveType'=> $leaveType,
            'approving_officers' => $approving_officers,
        ]);

    }

    public function update(Request $request,$id)
    {
        $this->authorize('update', LeaveTypeApprovingOfficer::class);

        $this->validate($request, [
            'user_id'=> 'required|not_in:0',
        ]);

        LeaveTypeApprovingOfficer::create([
            'user_id' => $request->user_id,
            'leave_type_id'=>$id
        ]);

        return redirect()->route('leave_approving_officer.show',$id )->with('success', trans('message.update_success'));


    }

    public function destroy ($id)
    {
        $this->authorize('delete', LeaveEntitlement::class);

        $leave_type_approving_officer = LeaveTypeApprovingOfficer::find($id);
        $leave_type_approving_officer->delete();
        
        return back();
    }

}