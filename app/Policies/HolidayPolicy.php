<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Config;



class HolidayPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function create(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_holiday_records_create'));
    }

    public function read(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_holiday_records_read'));
    }

    public function update(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_holiday_records_update'));
    }

    public function delete(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_holiday_records_delete'));
    }

    public function restore(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_holiday_records_restore'));
    }
}
