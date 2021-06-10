<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Config;

class UserApprovingOfficerPolicy
{
    use HandlesAuthorization;
    public function __construct()
    {
        //
    }

    public function show(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_leave_type_approving_records_read'));
    }

    public function update(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_leave_type_approving_records_update'));
    }

    public function delete(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_leave_type_approving_records_delete'));
    }
}
