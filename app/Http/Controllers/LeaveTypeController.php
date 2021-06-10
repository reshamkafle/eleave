<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\LeaveType;
use App\Models\Month;


class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $this->authorize('read', LeaveType::class);

        $leaveTypes = DB::table('leave_types')
                        ->join('companies','leave_types.company_id', '=', 'companies.id')
                        ->join('months','months.month', '=', 'leave_types.cycleMonth')
                        ->whereNull('leave_types.deleted_at')
                        ->select(['companies.name as company_name', 'leave_types.cycleMonth', 'leave_types.deleted_at','leave_types.id', 'leave_types.name', 'leave_types.allowNegativeApplication', 'leave_types.needCertificate', 'months.monthName'])
                        ->paginate(20);

        session(['pageTitle' => 'Leave Type']);
        session(['pageTitleIcon' => 'fa fa-th-list']);

        $companies = Company::all();

        return view('leaveTypes.index', [
            'leaveTypes' => $leaveTypes,
            'companies' => $companies,
        ]);
    }

    public function create(){

        $this->authorize('create', LeaveType::class);

        session(['pageTitle' => 'Leave Type: New']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $companies = Company::all();
        $months = Month::all();

        return view('leaveTypes.create',[
            'companies' => $companies,
            'months' => $months,
        ]);
    }
    public function store(Request $request){

        $this->authorize('create', LeaveType::class);

        $action = $request->input('btn-submit');
        
        $this->validate($request, [
            'company_id'=> 'required|not_in:0',
            'name' => 'required|max:255',
            'cycleMonth' => 'required|not_in:0',
        ]);
        
        $id = LeaveType::create([
            'name'=> $request->name,
            'company_id'=> $request->company_id,
            'allowNegativeApplication'=> $request->has('allowNegativeApplication'),
            'needCertificate' => $request->has('needCertificate'),
            'cycleMonth' => $request->cycleMonth,
        ])->id;

        switch($action){
            case 1:
                $companies = Company::all();

                return view('leaveTypes.create',[
                    'companies' => $companies,
                ])->with('success', trans('message.add_success'));

                break;

            case 2:
                return redirect()->route('leaveTypes')->with('success', trans('message.add_success'));
                break;

            case 3:
                return redirect()->route('leaveTypes.create')->with('success', trans('message.add_success'));
                break;
        }
    }

    public function show($id)
    {
        $this->authorize('update', LeaveType::class);

        session(['pageTitle' => 'Leave Types: Edit']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $companies = Company::all();
        $leaveType = LeaveType::find($id);
        $months = Month::all();

        return view('leaveTypes.show', [
            'leaveType' => $leaveType,
            'companies' => $companies,
            'months' => $months,
        ]);
    }

    public function update(Request $request,$id)
    {        
        $this->authorize('update', LeaveType::class);

        $this->validate($request, [
            'company_id'=> 'required|not_in:0',
            'name' => 'required|max:255',
            'cycleMonth' => 'required|not_in:0',
        ]);
        
        $leaveType = LeaveType::find($id);
        $leaveType->name = $request->name;
        $leaveType->company_id = $request->company_id;
        $leaveType->allowNegativeApplication =$request->has('allowNegativeApplication');
        $leaveType->needCertificate = $request->has('needCertificate');
        $leaveType->cycleMonth =$request->cycleMonth;
        $leaveType->save();
        $action = $request->input('btn-submit');

        switch($action){
            case 1:
                $companies = Company::all();
                
                return view('leaveTypes.show', [
                    'leaveType' => $leaveType,
                    'companies' => $companies,
                    ])->with('success', trans('message.update_success'));

                break;

            case 2:
                return redirect()->route('leaveTypes')->with('success', trans('message.update_success'));
                break;

            case 3:
                return redirect()->route('leaveTypes.create')->with('success', trans('message.update_success'));
                break;
        }
    }

    public function destroy(Request $request)
    {  
        $this->authorize('delete', LeaveType::class);

        $leaveTypes = LeaveType::find($request->id);
        $leaveTypes->delete();

        return response()->json($leaveTypes);
    } 

    public function multi_action(Request $request)
    {      
        $ids = $request->id;
        $action = $request->input('btn-submit');
        
        if($ids != null)
        {
            switch($action){

                case 1:
                    $this->authorize('delete', LeaveType::class);

                    LeaveType::destroy($ids);
                    return redirect()->route('leaveTypes')->with('success', trans('message.delete_success'));
                break;         

            case 2:
                $this->authorize('restore', LeaveType::class);

                LeaveType::onlyTrashed()
                    ->whereIn('id', $ids)
                    ->restore();
                    return redirect()->route('leaveTypes')->with('success', trans('message.record_restore'));
                break;

            }
        }
        else{
            return redirect()->route('leaveTypes')->with('success', trans('message.no_item_selected'));
        }       
    }

    public function search(Request $request){
        $this->authorize('read', LeaveType::class);

        $company_id = $request->company_id;
        $status = $request->status;

        $leaveTypes;
        
        if($status == 1) //active
        {

            if($company_id > 0)
            {
                $leaveTypes = DB::table('leave_types')
                        ->join('companies','leave_types.company_id', '=', 'companies.id')
                        ->join('months','months.month', '=', 'leave_types.cycleMonth')
                        ->whereNull('leave_types.deleted_at')
                        ->where('companies.id', '=', $company_id)
                        ->select(['companies.name as company_name', 'leave_types.cycleMonth','leave_types.deleted_at','leave_types.id', 'leave_types.name', 'leave_types.allowNegativeApplication', 'leave_types.needCertificate','months.monthName'])
                        ->paginate(20);
            }
            else
            {
                $leaveTypes = DB::table('leave_types')
                        ->join('companies','leave_types.company_id', '=', 'companies.id')
                        ->join('months','months.month', '=', 'leave_types.cycleMonth')
                        ->whereNull('leave_types.deleted_at')
                        ->select(['companies.name as company_name', 'leave_types.cycleMonth','leave_types.deleted_at','leave_types.id', 'leave_types.name', 'leave_types.allowNegativeApplication', 'leave_types.needCertificate','months.monthName'])
                        ->paginate(20);
            }
            
        }
        else
        {

            if($company_id > 0)
            {
                $leaveTypes = DB::table('leave_types')
                        ->join('companies','leave_types.company_id', '=', 'companies.id')
                        ->join('months','months.month', '=', 'leave_types.cycleMonth')
                        ->where('companies.id', '=', $company_id)
                        ->whereNotNull('leave_types.deleted_at')
                        ->select(['companies.name as company_name', 'leave_types.cycleMonth','leave_types.deleted_at','leave_types.id', 'leave_types.name', 'leave_types.allowNegativeApplication', 'leave_types.needCertificate','months.monthName'])
                        ->paginate(20);
            }
            else
            {
                $leaveTypes = DB::table('leave_types')
                        ->join('companies','leave_types.company_id', '=', 'companies.id')
                        ->join('months','months.month', '=', 'leave_types.cycleMonth')
                        ->whereNotNull('leave_types.deleted_at')
                        ->select(['companies.name as company_name', 'leave_types.cycleMonth','leave_types.deleted_at','leave_types.id', 'leave_types.name', 'leave_types.allowNegativeApplication', 'leave_types.needCertificate','months.monthName'])
                        ->paginate(20);
            }
        }

        $companies = Company::all();

        return view('leaveTypes.index', [
            'companies'=> $companies,
            'leaveTypes' => $leaveTypes,
        ]);
    }
}


