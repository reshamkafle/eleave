<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_company_records_create',
        'setting_company_records_read',
        'setting_company_records_update',
        'setting_company_records_delete',
        'setting_company_records_restore',
        'setting_holiday_records_create',
        'setting_holiday_records_read',
        'setting_holiday_records_update',
        'setting_holiday_records_delete',
        'setting_holiday_records_restore',
        'setting_workingday_records_create',
        'setting_workingday_records_read',
        'setting_workingday_records_update',
        'setting_workingday_records_delete',
        'setting_workingday_records_restore',
        'setting_department_records_create',
        'setting_department_records_read',
        'setting_department_records_update',
        'setting_department_records_delete',
        'setting_department_records_restore', 
        'setting_leavetype_records_create',
        'setting_leavetype_records_read',
        'setting_leavetype_records_update',
        'setting_leavetype_records_delete',
        'setting_leavetype_records_restore',
        'setting_calendar_records_read',
        'setting_calendar_records_create',
        'setting_userAccount_records_create',
        'setting_userAccount_records_read',
        'setting_userAccount_records_update',
        'setting_userAccount_records_delete',
        'setting_userAccount_records_restore',
		'setting_userAccount_records_change_password',
		'setting_userAccount_records_apply_permission',
        'setting_leave_entitlements_records_read',
        'setting_leave_entitlements_records_update',
        'setting_leave_entitlements_records_delete',
        'setting_leave_type_approving_records_read',
        'setting_leave_type_approving_records_update',
        'setting_leave_type_approving_records_delete',
        'setting_user_account_approving_records_read',
        'setting_user_account_approving_records_update',
        'setting_user_account_approving_records_delete',
        'leave_application_apply',
        'leave_application_manage',
        'leave_application_history',
        'application_menu',
        'setting_menu',
    ];
}