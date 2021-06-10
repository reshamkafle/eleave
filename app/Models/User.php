<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'staffId',
        'company_id',
        'joinDate',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function roles()
    {
        return $this->hasMany(FunctionRoleUser::class);
    }

    public function hasCode($user, $code)
    {        
        if ($user->roles()->where('code', $code)->first()) {
            return true;
          }
          return false;
    }
}