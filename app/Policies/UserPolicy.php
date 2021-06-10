<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Config;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_userAccount_records_create'));
    }

    public function read(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_userAccount_records_read'));
    }

    public function update(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_userAccount_records_update'));
    }

    public function delete(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_userAccount_records_delete'));
    }

    public function restore(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_userAccount_records_restore'));
    }

    public function change_password(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_userAccount_records_change_password'));
    }

    public function apply_permission(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_userAccount_records_apply_permission'));
    }

    public function amItheLoginUser(User $user, int $id){
        if($user->id == $id){
            return false;
        }
        else{
            return true;
        }
    }

    public function leave_application_menu(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.application_menu'));
    }

    public function setting_menu(User $user){       
        return  $user->hasCode($user, Config::get('user_permission.setting_menu'));
    }

}
