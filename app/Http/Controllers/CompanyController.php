<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;



class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('read', Company::class);

        $companies =DB::table('countries')
                ->join('companies','countries.id', '=', 'companies.country_id')
                ->whereNull('deleted_at')
                ->select(['countries.name as country_name', 'companies.deleted_at','companies.id', 'companies.name', 'companies.telephone', 'companies.emailAddress'])
                ->paginate(20);

        session(['pageTitle' => 'Companies']);
        session(['pageTitleIcon' => 'fa fa-th-list']);

        $countries = Country::all();
        
        return view('companies.index', [
            'companies' => $companies,
            'countries' => $countries,
        ]);
    }

    public function create()
    { 
        $this->authorize('create', Company::class);

        session(['pageTitle' => 'Companies: New']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $countries = Country::all();
        return view('companies.create', [
            'countries' => $countries,
        ]);
    }

    public function store(Request $request){

        $this->authorize('create', Company::class);

        $action = $request->input('btn-submit');
        
        $this->validate($request, [
            'country_id'=> 'required|not_in:0',
            'name' => 'required|unique:companies,name|max:255',
            'addressLine1'=> 'required|max:255',
            'addressLine2'=> 'nullable|max:255',
            'city'=> 'nullable|max:255',
            'telephone'=> 'required|unique:companies,telephone|max:255',
            'fax'=> 'nullable|max:255',
            'emailAddress'=> 'required|unique:companies,emailAddress|email|max:255'
        ]);

        $id = Company::create($request->only(['name','addressLine1','addressLine2','city','country_id','telephone', 'fax','emailAddress']))->id;
        
        switch($action){
            case 1:
                    $countries = Country::all();
                    $company = Company::find($id);

                    return view('companies.show', [
                        'company' => $company,
                        'countries' => $countries,
                    ])->with('success', trans('message.add_success'));
                break;

            case 2:
                return redirect()->route('companies')->with('success', trans('message.add_success'));
                break;

            case 3:
                return redirect()->route('companies.create')->with('success', trans('message.add_success'));

                break;
        }


    }

    public function show($id)
    {   
        $this->authorize('update', Company::class);

        session(['pageTitle' => 'Companies: Edit']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $countries = Country::all();
        $company = Company::find($id);
        return view('companies.show', [
            'company' => $company,
            'countries' => $countries,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Company::class);
        
        $company = Company::find($id);
        $company->update($request->all());

        $action = $request->input('btn-submit');

        switch($action){
            case 1:
                    $countries = Country::all();
                    $company = Company::find($id);

                    return view('companies.show', [
                        'company' => $company,
                        'countries' => $countries,
                    ])->with('success', trans('message.update_success'));
                break;

            case 2:
                return redirect()->route('companies')->with('success', trans('message.update_success'));
                break;

            case 3:
                return redirect()->route('companies.create')->with('success', trans('message.update_success'));

                break;
        }


    }
    
    public function destroy(Request $request)
    {       
        $this->authorize('delete', Company::class);

        $company = Company::find($request->id);
        $company->delete();
        return response()->json($company);
    }


    public function multi_action(Request $request)
    {      
        $ids = $request->id;
        $action = $request->input('btn-submit');

        if($ids != null)
        {

            switch($action){

                case 1:
                        $this->authorize('delete', Company::class);
                        
                        Company::destroy($ids);
                        return redirect()->route('companies')->with('success', trans('message.delete_success'));
                    break;         

                case 2:
                    $this->authorize('restore', Company::class);

                    Company::onlyTrashed()
                        ->whereIn('id', $ids)
                        ->restore();
                        return redirect()->route('companies')->with('success', trans('message.record_restore'));
                    break;
            }
        }
        else{
            return redirect()->route('companies')->with('success', trans('message.no_item_selected'));
        }
        
    }

    public function search(Request $request){

        $this->authorize('read', Company::class);
        
        $country_id = $request->country_id;
        $status = $request->status;

        $companies;
        
        if($status == 1) //active
        {
            if($country_id > 0){
                $companies =DB::table('countries')
                            ->join('companies','countries.id', '=', 'companies.country_id')
                            ->whereNull('deleted_at')
                            ->where('companies.country_id', '=', $country_id)
                            ->select(['countries.name as country_name', 'companies.deleted_at','companies.id', 'companies.name', 'companies.telephone', 'companies.emailAddress'])
                            ->paginate(20);
            }
            else{
                $companies =DB::table('countries')
                    ->join('companies','countries.id', '=', 'companies.country_id')
                    ->whereNull('deleted_at')
                    ->select(['countries.name as country_name', 'companies.deleted_at','companies.id', 'companies.name', 'companies.telephone', 'companies.emailAddress'])
                    ->paginate(20);
            }
                
        }
        else{
            if($country_id > 0){

                $companies =DB::table('countries')
                            ->join('companies','countries.id', '=', 'companies.country_id')
                            ->whereNotNull('deleted_at')
                            ->where('companies.country_id', '=', $country_id)
                            ->select(['countries.name as country_name', 'companies.deleted_at','companies.id', 'companies.name', 'companies.telephone', 'companies.emailAddress'])
                            ->paginate(20);
            }
            else{
                $companies =DB::table('countries')
                    ->join('companies','countries.id', '=', 'companies.country_id')
                    ->whereNotNull('deleted_at')
                    ->select(['countries.name as country_name', 'companies.deleted_at','companies.id', 'companies.name', 'companies.telephone', 'companies.emailAddress'])
                    ->paginate(20);
            }
        }

        $countries = Country::all();
        
        return view('companies.index', [
            'companies' => $companies,
            'countries' => $countries,
        ]);

    }
}


