<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserApprovingOfficer;


class UserApprovingOfficerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $this->authorize('show', UserApprovingOfficer::class);

        $aUser = User::find($id);
        $users = DB::table('users')
                ->where('id', '!=', $aUser->id)
                ->select(['id', 'name'])
                ->get();
        
        $approving_officers = DB::table('user_approving_officers')
                            ->join('users as approving', 'approving.id', '=', 'user_approving_officers.approving_id')
                            ->join('users as user', 'user.id', '=', 'user_approving_officers.user_id')
                            ->where('user.id', '=', $id)
                            ->select(['user.name as username', 'approving.name as approvername', 'user_approving_officers.id'])
                            ->paginate(20);


        session(['pageTitle' => 'User - Approving Officer']);
        session(['pageTitleIcon' => 'fa fa-th-list']);
        
        return view('auth.user_approving_officer', [
            'users' => $users,
            'aUser'=> $aUser,
            'approving_officers' => $approving_officers,
        ]);
    }

    public function update(Request $request,$id)
    {

        $this->authorize('update', UserApprovingOfficer::class);

        $this->validate($request, [
            'user_id'=> 'required|not_in:0',
        ]);

        UserApprovingOfficer::create([
            'approving_id' => $request->user_id,
            'user_id'=>$id
        ]);

        return redirect()->route('leave_user_approving_officer.show',$id )->with('success', trans('message.update_success'));
    }

    public function destroy ($id)
    {
        $this->authorize('delete', UserApprovingOfficer::class);

        $leave_type_approving_officer = UserApprovingOfficer::find($id);
        $leave_type_approving_officer->delete();
        
        return back();
    }
}
