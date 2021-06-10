<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingDay;
use App\Models\Company;
use App\Models\WeekDay;
use Illuminate\Support\Facades\DB;

class WorkingDayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('read', WorkingDay::class);

        $workingdays = DB::table('working_days')
                        ->join('companies','working_days.company_id', '=', 'companies.id')
                        ->join('week_days', 'week_days.dayValue', '=', 'working_days.day')
                        ->whereNull('working_days.deleted_at')
                        ->select(['working_days.day', 'working_days.fullDay', 'working_days.id', 'companies.name as company_name', 'dayName'])
                        ->paginate(20);

        session(['pageTitle' => 'Working Days']);
        session(['pageTitleIcon' => 'fa fa-th-list']);

        $companies = Company::all();

        return view('workingdays.index', [
            'workingdays' => $workingdays,
            'companies' => $companies,
        ]);
    }

    public function create()
    {
        $this->authorize('create', WorkingDay::class);

        $weekdays = WeekDay::all();
        $companies = Company::all();

        session(['pageTitle' => 'Working Day: New']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        return view('workingdays.create',[
            'weekdays' => $weekdays,
            'companies' => $companies,
        ]);
    }

    public function store(Request $request)
    {    
        $this->authorize('create', WorkingDay::class);

        $action = $request->input('btn-submit');

        $this->validate($request, [
            'company_id'=> 'required|not_in:0',
            'day'=> 'required|not_in:-1',

        ]); 
        
        $exist = DB::table('working_days')
        ->where('day', "=", $request->day)
        ->where('company_id', "=", $request->company_id)
        ->get();

        if(count($exist) <=0 ){

            $id = WorkingDay::create([
                'day'=> $request->day,
                'fullDay'=> $request->has('fullDay'),
                'company_id'=> $request->company_id,
            ])->id;

            switch($action){
                case 1:
                    $companies = Company::all();
    
                    return view('workingdays.create',[
                        'companies' => $companies,
                    ])->with('success', trans('message.add_success'));
    
                    break;
    
                case 2:
                    return redirect()->route('workingdays')->with('success', trans('message.add_success'));
                    break;
    
                case 3:
                    return redirect()->route('workingdays.create')->with('success', trans('message.add_success'));
                    break;
            }
        }
        else{
            return back()->with('warn', trans('message.record_exist'));
        }

        
    }

    public function show($id)
    {
        $this->authorize('update', WorkingDay::class);

        $workingday = WorkingDay::find($id);
        $weekdays = WeekDay::all();
        $companies = Company::all();
        
        session(['pageTitle' => 'Working Day: Edit']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        return view('workingdays.show', [
            'workingday'=> $workingday,
            'weekdays' => $weekdays,
            'companies' => $companies,

        ]);
    }

    public function update(Request $request, $id)
    {  
        $this->authorize('update', WorkingDay::class);
     
        $this->validate($request, [
            'company_id'=> 'required|not_in:0',
            'day'=> 'required|not_in:-1',

        ]); 

        $workingdays = WorkingDay::find($id);
        $workingdays->day = $request->day;
        $workingdays->company_id = $request->company_id;
        $workingdays->fullDay = $request->has('fullDay');
        $workingdays->save();

        return redirect()->route('workingdays')->with('success', trans('message.update_success'));
    }

    public function destroy(Request $request)
    {    
        $this->authorize('delete', WorkingDay::class);
    
        $workingdays = WorkingDay::find($request->id);
        $workingdays->delete();

        return response()->json($workingdays);

    } 

    public function search(Request $request){

        $this->authorize('read', WorkingDay::class);


        $company_id = $request->company_id;
        $status = $request->status;

        $workingdays;
        
        if($status == 1) //active
        {
            if($company_id > 0)
            {
                $workingdays = DB::table('working_days')
                                    ->join('companies','working_days.company_id', '=', 'companies.id')
                                    ->join('week_days', 'week_days.dayValue', '=', 'working_days.day')
                                    ->whereNull('working_days.deleted_at')
                                    ->where('companies.id', '=', $company_id)
                                    ->select(['working_days.day', 'working_days.fullDay', 'working_days.id', 'companies.name as company_name', 'dayName'])
                                    ->paginate(20);
            }
            else
            {
                $workingdays = DB::table('working_days')
                                    ->join('companies','working_days.company_id', '=', 'companies.id')
                                    ->join('week_days', 'week_days.dayValue', '=', 'working_days.day')
                                    ->whereNull('working_days.deleted_at')
                                    ->select(['working_days.day', 'working_days.fullDay', 'working_days.id', 'companies.name as company_name', 'dayName'])
                                    ->paginate(20);
            }
        }
        else
        {
            if($company_id > 0)
            {
                $workingdays = DB::table('working_days')
                                    ->join('companies','working_days.company_id', '=', 'companies.id')
                                    ->join('week_days', 'week_days.dayValue', '=', 'working_days.day')
                                    ->whereNotNull('working_days.deleted_at')
                                    ->where('companies.id', '=', $company_id)
                                    ->select(['working_days.day', 'working_days.fullDay', 'working_days.id', 'companies.name as company_name', 'dayName'])
                                    ->paginate(20);
            }
            else
            {
                $workingdays = DB::table('working_days')
                                    ->join('companies','working_days.company_id', '=', 'companies.id')
                                    ->join('week_days', 'week_days.dayValue', '=', 'working_days.day')
                                    ->whereNotNull('working_days.deleted_at')
                                    ->select(['working_days.day', 'working_days.fullDay', 'working_days.id', 'companies.name as company_name', 'dayName'])
                                    ->paginate(20);
            }
        }

        $companies = Company::all();

        return view('workingdays.index', [
            'workingdays' => $workingdays,
            'companies' => $companies,
        ]);
    }

    public function multi_action(Request $request)
    {      
        $ids = $request->id;
        $action = $request->input('btn-submit');
        
        if($ids != null)
        {
            switch($action){

                case 1:
                    $this->authorize('delete', WorkingDay::class);

                    WorkingDay::destroy($ids);
                    return redirect()->route('workingdays')->with('success', trans('message.delete_success'));
                break;         

            case 2:
                $this->authorize('restore', WorkingDay::class);

                WorkingDay::onlyTrashed()
                    ->whereIn('id', $ids)
                    ->restore();
                    return redirect()->route('workingdays')->with('success', trans('message.record_restore'));
                break;

            }
        }
        else{
            return redirect()->route('workingdays')->with('success', trans('message.no_item_selected'));
        }       
    }
}