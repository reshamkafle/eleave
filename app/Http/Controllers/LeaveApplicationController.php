<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\LeaveApplication;
use App\Models\LeaveEntitlement;
use App\Models\LeaveApplicationSummary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;




class LeaveApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $this->authorize('apply', LeaveApplication::class);

        session(['pageTitle' => 'Leave Application']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $user = Auth::user();

        $joinDate = $user->joinDate;
        $now = \Carbon\Carbon::now();
        $diffYears = \Carbon\Carbon::now()->diffInYears($joinDate) + 1;

        $leaveTypes = LeaveType::all();

        $allEntitlements = DB::table('leave_entitlements')
                        ->leftjoin('leave_types', 'leave_types.id', '=', 'leave_entitlements.leave_type_id')
                        ->where('user_id', '=', $user->id)
                        ->select(['leave_types.name as leaveType','year', 'leave_types.id as leaveTypeId', 'leave_entitlements.id', 'year', 'entitlement', 'leave_types.allowNegativeApplication'])
                        ->get();

        $all_leave_applications = DB::table('leave_applications')
                                ->where('user_id', '=', $user->id)
                                ->where('leaveStatus', '!=', Config::get('constants.application_status.reject'))
                                ->select(['leave_type_id', 'noOfDayDeduct','startDate', 'endDate'])
                                ->get();
                        
        $entitlements = collect();

        foreach ($leaveTypes as $leaveType) 
        {

            $startCycle = ($now->year-1).'-'.($leaveType->cycleMonth).'-1';
            $cycleStartDate = (new \Carbon\Carbon($startCycle))->addMonths(1);

            $endCycle = ($now->year).'-'.($leaveType->cycleMonth).'-1';
            $cycleEndDate = (new \Carbon\Carbon($endCycle))->endOfMonth();

            $thisYearEntitlement = $allEntitlements
                                    ->where('year', '=', $diffYears)
                                    ->where('leaveTypeId', '=', $leaveType->id)
                                    ->first();

            $thisYearApplicationSum = $all_leave_applications
                                    ->where('startDate' , '>=', $cycleStartDate)
                                    ->where('endDate', '<=', $cycleEndDate)
                                    ->where('leave_type_id', '=', $leaveType->id)
                                    ->sum('noOfDayDeduct');

            if ($thisYearEntitlement == null)
            {

                $previousYearEntitlement = $allEntitlements
                                        ->where('leaveTypeId', '=', $leaveType->id)
                                        ->sortByDesc('year')
                                        ->first();

                $item = new LeaveApplicationSummary;
                $item->leaveType = $previousYearEntitlement->leaveType;
                $item->entitlement = $previousYearEntitlement->entitlement;
                $item->allowNegativeApplication = $previousYearEntitlement->allowNegativeApplication;
                $item->used = $thisYearApplicationSum;
                $item->balance = $previousYearEntitlement->entitlement- $thisYearApplicationSum;
                $entitlements->add($item);

            }
            else
            {
                $item = new LeaveApplicationSummary;
                $item->leaveType = $thisYearEntitlement->leaveType;
                $item->entitlement = $thisYearEntitlement->entitlement;
                $item->allowNegativeApplication = $thisYearEntitlement->allowNegativeApplication;
                $item->balance = $thisYearEntitlement->entitlement- $thisYearApplicationSum;
                $item->used = $thisYearApplicationSum;

                $entitlements->add($item);
            }
        }   
             
        return view('leave-application.create', [
        'leaveTypes' => $leaveTypes,
        'entitlements' => $entitlements,
        'user' => $user,

        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('apply', LeaveApplication::class);

        $this->validate($request, [
            'leave_type_id'=> 'required|not_in:0',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $user = Auth::user();

        $startDate = \Carbon\Carbon::parse($request->startDate);
        $endDate = \Carbon\Carbon::parse($request->endDate);

        $noOfDayApplied =$endDate->diffInDays($startDate) + 1;

        $totalWorkingDayList = DB::table('working_days')
                            ->where('company_id', '=', $user->company_id)
                            ->select(['day', 'fullDay'])
                            ->get();

        if(count($totalWorkingDayList) == 0)
        {
            return back()->with('warn', trans('message.NoWorkingDayDefine'));
        }

        $totalWorkingDays = 0;
        
        for($date = $startDate; $date <= $endDate; $date->modify('+1 day'))
        {         
            $dayOfWeek = $date->dayOfWeek;

            $day = $totalWorkingDayList->where('day', $dayOfWeek)->first();
            if($day != null)
            {
                if($day->fullDay)
                {
                    $totalWorkingDays++;
                }
                else{
                    $totalWorkingDays = $totalWorkingDays +0.5;
                }
            }    
        }
        
        //reset
        $startDate = \Carbon\Carbon::parse($request->startDate);
        $endDate = \Carbon\Carbon::parse($request->endDate);

        $publicHolidays = DB::table('holidays')
                        ->where('company_id', '=', $user->company_id)
                        ->get();    

        $totalPublicHoliday = 0;

        foreach ($publicHolidays as $publicHoliday) {

            $start_holiday = \Carbon\Carbon::parse($publicHoliday->startDate);
            $end_holiday = \Carbon\Carbon::parse($publicHoliday->endDate);

            for($date = $start_holiday; $date <= $end_holiday; $date->modify('+1 day'))
            { 
                $dayOfWeek = $date->dayOfWeek;
                 
                if( $date->gte($startDate) AND $date->lte($endDate))
                {
                    $day = $totalWorkingDayList->where('day', $dayOfWeek)->first();

                    if($day != null)
                    {
                        if($day->fullDay)
                        {
                            if($publicHoliday->fullDay)
                            {
                                $totalPublicHoliday++;
                            }
                            else
                            {
                                $totalPublicHoliday = $totalPublicHoliday+ 0.5;
                            }
                        }
                        else
                        {
                            $totalPublicHoliday = $totalPublicHoliday+ 0.5;
                        }
                    }
                }
            }
        }

        $fullDay = 0.5; //half day

        if($request->has('fullDay'))
        {
            $fullDay = 1;
        }

        $totalDeduct = ($totalWorkingDays - $totalPublicHoliday)*$fullDay;

        if($totalDeduct < 0)
        {
            return back()->with('warn', trans('message.ApplicationTotalDeductLessThanZero'));       
        }

        $joinDate = $user->joinDate;
        $now = \Carbon\Carbon::now();
        $diffYears = \Carbon\Carbon::now()->diffInYears($joinDate) + 1;

        $leaveEntitlement = DB::table('leave_entitlements')
                                ->join('leave_types', 'leave_types.id', '=', 'leave_entitlements.leave_type_id')
                                ->join('users', 'users.id', '=', 'leave_entitlements.user_id')
                                ->where('leave_types.id', '=', $request->leave_type_id)
                                ->where('users.id', '=', $user->id)
                                ->select(['leave_types.allowNegativeApplication','leave_types.name', 'leave_types.needCertificate', 'leave_types.cycleMonth', 'leave_entitlements.entitlement','leave_entitlements.year'])
                                ->get();
    

        if(count($leaveEntitlement) > 0) 
        {
            $leaveType = $leaveEntitlement->first();

            $startCycle = ($now->year-1).'-'.($leaveType->cycleMonth).'-1';
            $cycleStartDate = (new \Carbon\Carbon($startCycle))->addMonths(1);
            
            $endCycle = ($now->year).'-'.($leaveType->cycleMonth).'-1';
            $cycleEndDate = (new \Carbon\Carbon($endCycle))->endOfMonth();

            if($request->endDate > $cycleEndDate ||  $request->startDate < $cycleStartDate )
            {
                return back()->with('warn', trans('message.ApplicationOfThisRunningYear').$leaveType->cycleMonth );
            }

            if($leaveType->allowNegativeApplication)
            {
                $id = $this->addLeave($request, $user, $noOfDayApplied, $totalWorkingDays,$totalPublicHoliday, $totalDeduct, $leaveType);
                return redirect()->route('leave_application_confirmation', $id);
            }
            else
            {                
                $myLeaveEntitlement = $leaveEntitlement
                                    ->where('year', '=', $diffYears)
                                    ->first();

                $totalLeaveApplied = DB::table('leave_applications')
                                    ->where('user_id', '=', $user->id)
                                    ->where('startDate', '>=', $cycleStartDate)
                                    ->where('endDate', '<=', $cycleEndDate)
                                    ->sum('noOfDayDeduct');
                
                if($myLeaveEntitlement == null)
                {
                    $lastLeaveEntitlement = $leaveEntitlement
                                            ->sortByDesc('year')
                                            ->first();               

                    if(($lastLeaveEntitlement->entitlement - $totalLeaveApplied)>= $totalDeduct) 
                    {
                        $id = $this->addLeave($request, $user, $noOfDayApplied, $totalWorkingDays,$totalPublicHoliday, $totalDeduct, $leaveType);
                        return redirect()->route('leave_application_confirmation', $id);                            
                    } 
                    else
                    {
                        return back()->with('warn', trans('message.NotEnoughEntitlement'));
                    }                
                }  
                else
                {
                    if(($myLeaveEntitlement->entitlement- $totalLeaveApplied) >= $totalDeduct) 
                    {
                        $id = $this->addLeave($request, $user, $noOfDayApplied, $totalWorkingDays,$totalPublicHoliday, $totalDeduct, $leaveType);
                        return redirect()->route('leave_application_confirmation', $id);
                    } 
                    else
                    {
                        return back()->with('warn', trans('message.NotEnoughEntitlement'));
                    }  
                }        
            }
        }
        else{
            return back()->with('warn', trans('message.EntitlementNotDefine'));
        }
    }

    private function addLeave(Request $request, $user, $noOfDayApplied,$noOfWorkingDay,$noOfPublicHoliday,$totalDeduct, $leaveType)
    {

        $certificate = $leaveType->needCertificate == 1? true: false;

       $id = LeaveApplication::Create([
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'name' => $user->name . ' - ' . $leaveType->name,
            'fullDay' =>$request->has('fullDay'),
            'user_id' => $user->id,
            'leave_type_id' => $request->leave_type_id,
            'noOfDayApplied' =>$noOfDayApplied,
            'noOfWorkingDay' => $noOfWorkingDay,
            'noOfPublicHoliday' =>$noOfPublicHoliday,
            'noOfDayDeduct' => $totalDeduct,
            'leaveStatus' => Config::get('constants.application_status.under_process'),
            'needCertificate' =>  $certificate,
        ])->id;

        return $id;
        
    }

}