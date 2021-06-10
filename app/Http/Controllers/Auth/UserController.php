<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $this->authorize('read', User::class);

        $useraccounts =DB::table('users')
                        ->join('companies','companies.id', '=', 'users.company_id')
                        ->whereNull('users.deleted_at')
                        ->select(['companies.name as companyName', 'users.deleted_at','users.id', 'users.name', 'users.email', 'users.staffId'])
                        ->paginate(20);

        session(['pageTitle' => 'User Accounts']);
        session(['pageTitleIcon' => 'fa fa-th-list']);

        $companies = Company::all();

        return view('auth.index', [
            'useraccounts' => $useraccounts,
            'companies' => $companies,
        ]);
    }

    public function create(){

        $this->authorize('read', User::class);

        session(['pageTitle' => 'User Accounts: New']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $companies = Company::all();


        return view('auth.create',[
            'companies' => $companies,
        ]);
    }

    public function store(Request $request){

        $this->authorize('create', User::class);

        $action = $request->input('btn-submit');

        $this->validate($request, [
            'company_id'=> 'required|not_in:0',
            'name' => 'required||max:255',
            'email'=> 'required|unique:users,email|max:255',
            'password' => 'required|confirmed|min:8',  
        
            ]);

        $id = User::create([
            'company_id'=> $request->company_id,
            'name' => $request->name,
            'staffId' => $request->staffId,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'joinDate'=> $request->joinDate,
        ])->id;

        switch($action){
            case 1:
                $companies = Company::all();
                $user = User::find($id);

                return view('auth.show',[
                    'companies' => $companies,
                    'user'=>$user,
                ])->with('success', trans('message.add_success'));
                break;

            case 2:
                return redirect()->route('useraccounts')->with('success', trans('message.add_success'));
                break;

            case 3:
                return redirect()->route('useraccounts.create')->with('success', trans('message.add_success'));

                break;
        }

    }

    public function show($id)
    {
        $this->authorize('update', User::class);

        session(['pageTitle' => 'User Account: Edit']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $companies = Company::all();
        $user = User::find($id);
        return view('auth.show', [
        'user'=> $user,
        'companies' => $companies,
        ]);
    }

    public function update(Request $request,$id)
    {                
        $this->authorize('update', User::class);

        $user = User::find($id);
        $user->company_id = $request->company_id;
        $user->name = $request->name;
        $user->staffId = $request->staffId; 
        $user->joinDate = $request->joinDate;      
        $user->save();

        $action = $request->input('btn-submit');

        switch($action){
            case 1:
                
                $companies = Company::all();

                return view('auth.show', [
                'user'=> $user,
                'companies' => $companies,
                ])->with('success', trans('message.update_success'));

                break;

            case 2:
                return redirect()->route('useraccounts')->with('success', trans('message.update_success'));
                break;

            case 3:
                return redirect()->route('useraccounts.create')->with('success', trans('message.update_success'));

                break;
        }
    }


    public function destroy(Request $request)
    {  
        $this->authorize('delete', User::class);
        $this->authorize('amItheLoginUser', $request->id);


        $useraccount = User::find($request->id);      
        $useraccount->delete();

        return response()->json($useraccount);
    }



    public function multi_action(Request $request)
    {      
        $ids = $request->id;
        $action = $request->input('btn-submit');

        if($ids != null)
        {
            switch($action){

                case 1:

                    $this->authorize('delete', User::class);
                    $loginId = Auth::id();

                    if(in_array($loginId, $ids))
                    {
                        abort(403, 'Unauthorized action.');
                    }
                    else{
                        User::destroy($ids);
                        return redirect()->route('useraccounts')->with('success', trans('message.delete_success'));
                    }
                    
                break;         

            case 2:

                $this->authorize('restore', User::class);
                
                User::onlyTrashed()
                    ->whereIn('id', $ids)
                    ->restore();
                    return redirect()->route('useraccounts')->with('success', trans('message.record_restore'));
                break;

            }
        }
        else{
            return redirect()->route('useraccounts')->with('success', trans('message.no_item_selected'));
        }       
    }

    public function search(Request $request){
        $this->authorize('read', User::class);


        $company_id = $request->company_id;
        $status = $request->status;

        $useraccounts;
        
        if($status == 1) //active
        {

            if($company_id > 0)
            {
                $useraccounts =DB::table('users')
                        ->join('companies','companies.id', '=', 'users.company_id')
                        ->whereNull('users.deleted_at')
                        ->where('companies.id', '=', $company_id)
                        ->select(['companies.name as companyName', 'users.deleted_at','users.id', 'users.name', 'users.email', 'users.staffId'])
                        ->paginate(20);
            }
            else
            {
                $useraccounts =DB::table('users')
                        ->join('companies','companies.id', '=', 'users.company_id')
                        ->whereNull('users.deleted_at')
                        ->select(['companies.name as companyName', 'users.deleted_at','users.id', 'users.name', 'users.email', 'users.staffId'])
                        ->paginate(20);
            }
            
        }
        else
        {

            if($company_id > 0)
            {
                $useraccounts =DB::table('users')
                        ->join('companies','companies.id', '=', 'users.company_id')
                        ->whereNotNull('users.deleted_at')
                        ->where('companies.id', '=', $company_id)
                        ->select(['companies.name as companyName', 'users.deleted_at','users.id', 'users.name', 'users.email', 'users.staffId'])
                        ->paginate(20);
            }
            else
            {
                $useraccounts =DB::table('users')
                        ->join('companies','companies.id', '=', 'users.company_id')
                        ->whereNotNull('users.deleted_at')
                        ->select(['companies.name as companyName', 'users.deleted_at','users.id', 'users.name', 'users.email', 'users.staffId'])
                        ->paginate(20);
            }
        }

        $companies = Company::all();

        return view('auth.index', [
            'useraccounts' => $useraccounts,
            'companies' => $companies,
        ]);
    }
}
