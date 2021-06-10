<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show($id)
    {        
        $this->authorize('read', User::class);

        session(['pageTitle' => 'User Account: Change Password']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $user = User::find($id);
        return view('auth.passwords.change', [
        'user'=> $user,
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->authorize('change_password', User::class);

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]); 
        
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();                   
        return back()->with('success', trans('message.update_password_success'));

    }
}
