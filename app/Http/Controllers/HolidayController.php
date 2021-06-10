<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use App\Models\Company;
use Illuminate\Support\Facades\DB;


class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $this->authorize('read', Holiday::class);


        $holidays = DB::table('holidays')
                        ->join('companies','holidays.company_id', '=', 'companies.id')
                        ->whereNull('holidays.deleted_at')
                        ->select(['companies.name as company_name', 'holidays.deleted_at','holidays.id', 'holidays.name', 'holidays.startDate', 'holidays.endDate', 'holidays.fullDay'])
                        ->orderBy('startDate', 'DESC')
                        ->orderBy('endDate', 'DESC')
                        ->paginate(20);

        session(['pageTitle' => 'Holidays']);
        session(['pageTitleIcon' => 'fa fa-th-list']);

        $companies = Company::all();

        return view('holidays.index', [
            'holidays' => $holidays,
            'companies' => $companies,
        ]);
    }

    public function create(){

        $this->authorize('create', Holiday::class);

        session(['pageTitle' => 'Holidays: New']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $companies = Company::all();

        return view('holidays.create',[
            'companies' => $companies,
        ]);
    }

    public function store(Request $request){

        $this->authorize('create', Holiday::class);

        $action = $request->input('btn-submit');

        $this->validate($request, [
            'company_id'=> 'required|not_in:0',
            'name' => 'required|max:255',
            'startDate'=> 'required',
            'endDate'=> 'required|date|after_or_equal:startDate',
        ]);
        
        $id = Holiday::create([
            'name'=> $request->name,
            'startDate'=> $request->startDate,
            'endDate'=> $request->endDate,
            'fullDay'=> $request->has('fullDay'),
            'company_id'=> $request->company_id,
        ])->id;

        switch($action){
            case 1:
                $companies = Company::all();
                $holiday = Holiday::find($id);

                return view('holidays.show', [
                    'holiday'=> $holiday,
                    'companies' => $companies,
                ])->with('success', trans('message.add_success'));

                break;

            case 2:
                return redirect()->route('holidays')->with('success', trans('message.add_success'));
                break;

            case 3:
                return redirect()->route('holidays.create')->with('success', trans('message.add_success'));
                break;
        }
    }

    public function show($id)
    {
        $this->authorize('update', Holiday::class);

        session(['pageTitle' => 'Holidays: Edit']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $companies = Company::all();
        $holiday = Holiday::find($id);
        return view('holidays.show', [
        'holiday'=> $holiday,
        'companies' => $companies,
        ]);
    }

    public function update(Request $request,$id)
    {        
        $this->authorize('update', Holiday::class);

        $this->validate($request, [
            'company_id'=> 'required|not_in:0',
            'name' => 'required|max:255',
            'startDate'=> 'required',
            'endDate'=> 'required|date|after_or_equal:startDate',
        ]);
        
        $holiday = Holiday::find($id);
        $holiday->name = $request->name;
        $holiday->startDate = $request->startDate;
        $holiday->endDate = $request->endDate;
        $holiday->fullDay = $request->has('fullDay');
        $holiday->company_id = $request->company_id;

        $holiday->save();
        $action = $request->input('btn-submit');

        switch($action){
            case 1:
                $companies = Company::all();
                
                return view('holidays.show', [
                    'holiday'=> $holiday,
                    'companies' => $companies,
                ])->with('success', trans('message.update_success'));

                break;

            case 2:
                return redirect()->route('holidays')->with('success', trans('message.update_success'));
                break;

            case 3:
                return redirect()->route('holidays.create')->with('success', trans('message.update_success'));

                break;
        }
    }

    public function destroy(Request $request)
    {  
        $this->authorize('delete', Holiday::class);

        $holiday = Holiday::find($request->id);      
        $holiday->delete();

        return response()->json($holiday);
    } 

    public function multi_action(Request $request)
    {      
        $ids = $request->id;
        $action = $request->input('btn-submit');
        
        if($ids != null)
        {
            switch($action){

                case 1:
                    $this->authorize('delete', Holiday::class);

                    Holiday::destroy($ids);
                    return redirect()->route('holidays')->with('success', trans('message.delete_success'));
                break;         

            case 2:
                $this->authorize('restore', Holiday::class);

                Holiday::onlyTrashed()
                    ->whereIn('id', $ids)
                    ->restore();
                    return redirect()->route('holidays')->with('success', trans('message.record_restore'));
                break;

            }
        }
        else{
            return redirect()->route('holidays')->with('success', trans('message.no_item_selected'));
        }       
    }

    public function search(Request $request){
        $company_id = $request->company_id;
        $status = $request->status;

        $holidays;
        
        if($status == 1) //active
        {

            if($company_id > 0)
            {
                $holidays = DB::table('holidays')
                            ->join('companies','holidays.company_id', '=', 'companies.id')
                            ->whereNull('holidays.deleted_at')
                            ->where('companies.id', '=', $company_id)
                            ->select(['companies.name as company_name', 'holidays.deleted_at', 'holidays.id', 'holidays.name', 'holidays.startDate', 'holidays.endDate', 'holidays.fullDay'])
                            ->orderBy('startDate', 'DESC')
                            ->orderBy('startDate', 'DESC')
                            ->paginate(20);

            }
            else
            {
                $holidays = DB::table('holidays')
                ->join('companies','holidays.company_id', '=', 'companies.id')
                ->whereNull('holidays.deleted_at')
                ->select(['companies.name as company_name', 'holidays.deleted_at', 'holidays.id', 'holidays.name', 'holidays.startDate', 'holidays.endDate', 'holidays.fullDay'])
                ->orderBy('startDate', 'DESC')
                ->orderBy('startDate', 'DESC')
                ->paginate(20);
            }
            
        }
        else
        {

            if($company_id > 0)
            {
                $holidays = DB::table('holidays')
                            ->join('companies','holidays.company_id', '=', 'companies.id')
                            ->where('companies.id', '=', $company_id)
                            ->whereNotNull('holidays.deleted_at')
                            ->select(['companies.name as company_name', 'holidays.deleted_at','holidays.id', 'holidays.name', 'holidays.startDate', 'holidays.endDate', 'holidays.fullDay'])
                            ->orderBy('startDate', 'DESC')
                            ->orderBy('startDate', 'DESC')
                            ->paginate(20);

            }
            else
            {
                $holidays = DB::table('holidays')
                ->join('companies','holidays.company_id', '=', 'companies.id')
                ->whereNotNull('holidays.deleted_at')
                ->select(['companies.name as company_name', 'holidays.deleted_at','holidays.id', 'holidays.name', 'holidays.startDate', 'holidays.endDate', 'holidays.fullDay'])
                ->orderBy('startDate', 'DESC')
                ->orderBy('startDate', 'DESC')
                ->paginate(20);
            }
        }

        $companies = Company::all();

        return view('holidays.index', [
            'holidays' => $holidays,
            'companies' => $companies,
        ]);
    }
}