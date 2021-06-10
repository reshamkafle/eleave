<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Config;



class LeaveTypePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function create(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_leavetype_records_create'));
    }

    public function read(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_leavetype_records_read'));
    }

    public function update(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_leavetype_records_update'));
    }

    public function delete(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_leavetype_records_delete'));
    }

    public function restore(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_leavetype_records_restore'));
    }
}
