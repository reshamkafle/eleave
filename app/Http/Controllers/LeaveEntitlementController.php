<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\LeaveType;
use App\Models\LeaveEntitlement;
use App\Models\User;


class LeaveEntitlementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('show', LeaveEntitlement::class);

        $entitlements =DB::table('users')
        ->join('companies','companies.id', '=', 'users.company_id')
        ->whereNull('users.deleted_at')
        ->select(['companies.name as companyName', 'users.deleted_at','users.id', 'users.name', 'users.email', 'users.staffId'])
        ->paginate(20);

        session(['pageTitle' => 'Leave Entitlement']);
        session(['pageTitleIcon' => 'fa fa-th-list']);

        $companies = Company::all();

        return view('entitlement.index', [
        'leave_entitlements' => $entitlements,
        'companies' => $companies,
        ]);
    }

    public function show($id)
    {
        $this->authorize('show', LeaveEntitlement::class);

        session(['pageTitle' => 'Leave Entitlement: Edit']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $entitlements = DB::table('leave_entitlements')
                        ->join('leave_types', 'leave_types.id', '=', 'leave_entitlements.leave_type_id')
                        ->where('user_id', '=', $id)
                        ->select(['leave_types.name as leaveType', 'leave_entitlements.id', 'year', 'entitlement', 'leave_types.allowNegativeApplication'])
                        ->orderBy('leaveType', 'ASC')
                        ->orderBy('year', 'ASC')
                        ->paginate(20);

        $leaveTypes = LeaveType::all();
        $user = User::find($id);

        return view('entitlement.show', [
            'entitlements' => $entitlements,
            'leaveTypes' => $leaveTypes,
            'user' => $user,
        ]);
    }

    public function store(Request $request, int $userId)
    {
        $this->authorize('update', LeaveEntitlement::class);

        $this->validate($request, [
            'leave_type_id'=> 'required|not_in:0',
            'entitlement' => 'required',
        ]);

        LeaveEntitlement::create([
            'entitlement'=> $request->entitlement,
            'leave_type_id'=> $request->leave_type_id,
            'user_id'=> $userId,
            'year' => $request->year
        ]);

        return redirect()->route('leave_entitlements.show', $userId)->with('success', trans('message.update_success'));
        
    }

    public function destroy($id)
    {
        $this->authorize('delete', LeaveEntitlement::class);
        $leave_entitlement = LeaveEntitlement::find($id);
        $leave_entitlement->delete();
        
        return back();

    }
}
