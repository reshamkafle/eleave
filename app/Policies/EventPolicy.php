<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Config;


class EventPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        
    }

    public function create(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_calendar_records_create'));
    }

    public function read(User $user){
        return  $user->hasCode($user, Config::get('user_permission.setting_calendar_records_read'));
    }

    public function update(User $user, Event $event)
    {
        return ($user->id === $event->user_id 
                        && $user->hasCode($user, Config::get('user_permission.setting_calendar_records_create'))
                    );
    }

    public function delete(User $user, Event $event)
    {
        return $user->id === $event->user_id;
    }
}
