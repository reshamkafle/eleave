<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Config;



class LeaveApplicationPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }
    public function apply(User $user){
        return  $user->hasCode($user, Config::get('user_permission.leave_application_apply'));
    }

    public function document(User $user){
        return  $user->hasCode($user, Config::get('user_permission.leave_application_manage'));
    }

    public function manage(User $user){
        return  $user->hasCode($user, Config::get('user_permission.leave_application_manage'));
    }

    public function history(User $user){
        return  $user->hasCode($user, Config::get('user_permission.leave_application_history'));
    }
}
