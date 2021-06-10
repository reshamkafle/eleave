<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->delete();
        DB::table('users')->delete();
        DB::table('function_role_users')->delete();

        $company = [
            ['name' => 'ABC', 'addressLine1' => 'address line1', 'country_id'=>1, 'telephone'=>12345678, 'emailAddress'=> 'abc@demo.com']
        ];

        DB::table('companies')->insert($company);

        $user = [
            ['password' => Hash::make('admin'), 'joinDate'=>date('Y-m-d'), 'email' => 'admin@admin.com', 'name'=> 'admin', 'staffId'=> '123', 'company_id'=> 1]
        ];

        DB::table('users')->insert($user);

        $permission = [
            ['user_id'=> 1, 'code'=> 'setting_company_records_create'],
            ['user_id'=> 1, 'code'=> 'setting_company_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_company_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_company_records_delete'],
            ['user_id'=> 1, 'code'=> 'setting_company_records_restore'],
            ['user_id'=> 1, 'code'=> 'setting_holiday_records_create'],
            ['user_id'=> 1, 'code'=> 'setting_holiday_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_holiday_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_holiday_records_delete'],
            ['user_id'=> 1, 'code'=> 'setting_holiday_records_restore'],
            ['user_id'=> 1, 'code'=> 'setting_workingday_records_create'],
            ['user_id'=> 1, 'code'=> 'setting_workingday_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_workingday_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_workingday_records_delete'],
            ['user_id'=> 1, 'code'=> 'setting_workingday_records_restore'],
            ['user_id'=> 1, 'code'=> 'setting_department_records_create'],
            ['user_id'=> 1, 'code'=> 'setting_department_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_department_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_department_records_delete'],
            ['user_id'=> 1, 'code'=> 'setting_department_records_restore'],
            ['user_id'=> 1, 'code'=> 'setting_leavetype_records_create'],
            ['user_id'=> 1, 'code'=> 'setting_leavetype_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_leavetype_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_leavetype_records_delete'],
            ['user_id'=> 1, 'code'=> 'setting_leavetype_records_restore'],
            ['user_id'=> 1, 'code'=> 'setting_calendar_records_create'],
            ['user_id'=> 1, 'code'=> 'setting_calendar_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_userAccount_records_create'],
            ['user_id'=> 1, 'code'=> 'setting_userAccount_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_userAccount_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_userAccount_records_delete'],
            ['user_id'=> 1, 'code'=> 'setting_userAccount_records_restore'],
            ['user_id'=> 1, 'code'=> 'setting_userAccount_records_change_password'],
            ['user_id'=> 1, 'code'=> 'setting_userAccount_records_apply_permission'],
            ['user_id'=> 1, 'code'=> 'setting_leave_entitlements_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_leave_entitlements_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_leave_entitlements_records_delete'],
            ['user_id'=> 1, 'code'=> 'setting_leave_type_approving_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_leave_type_approving_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_leave_type_approving_records_delete'],
            ['user_id'=> 1, 'code'=> 'setting_user_account_approving_records_read'],
            ['user_id'=> 1, 'code'=> 'setting_user_account_approving_records_update'],
            ['user_id'=> 1, 'code'=> 'setting_user_account_approving_records_delete'],
            ['user_id'=> 1, 'code'=> 'leave_application_apply'],
            ['user_id'=> 1, 'code'=> 'leave_application_manage'],
            ['user_id'=> 1, 'code'=> 'leave_application_history'],
            ['user_id'=> 1, 'code'=> 'application_menu'],
            ['user_id'=> 1, 'code'=> 'setting_menu'],
        ];

        DB::table('function_role_users')->insert($permission);
    }
}
