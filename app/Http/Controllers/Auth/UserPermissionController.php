<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\FunctionRoleUser;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class UserPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {        
        $this->authorize('read', User::class);
        session(['pageTitle' => 'User Accounts: Premissions']);
        session(['pageTitleIcon' => 'fa fa-pencil']);

        $user = User::find($id);
        $permission = DB::table('function_role_users')
                        ->where('user_id', '=', $id)
                        ->get();
        
        $user_permission = new UserPermission;

        $user_permission->setting_company_records_create = $permission
                            ->where('code', '=', Config::get('user_permission.setting_company_records_create'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_company_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_company_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_company_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_company_records_update'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_company_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_company_records_delete'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_company_records_restore = $permission
                            ->where('code', '=', Config::get('user_permission.setting_company_records_restore'))
                            ->first()?->code
                            ? true: false;      
                            
                            $user_permission->setting_holiday_records_create = $permission
                            ->where('code', '=', Config::get('user_permission.setting_holiday_records_create'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_holiday_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_holiday_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_holiday_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_holiday_records_update'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_holiday_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_holiday_records_delete'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_holiday_records_restore = $permission
                            ->where('code', '=', Config::get('user_permission.setting_holiday_records_restore'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_workingday_records_create = $permission
                            ->where('code', '=', Config::get('user_permission.setting_workingday_records_create'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_workingday_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_workingday_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_workingday_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_workingday_records_update'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_workingday_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_workingday_records_delete'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_workingday_records_restore = $permission
                            ->where('code', '=', Config::get('user_permission.setting_workingday_records_restore'))
                            ->first()?->code
                            ? true: false;   

                            $user_permission->setting_department_records_create = $permission
                            ->where('code', '=', Config::get('user_permission.setting_department_records_create'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_department_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_department_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_department_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_department_records_update'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_department_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_department_records_delete'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_department_records_restore = $permission
                            ->where('code', '=', Config::get('user_permission.setting_department_records_restore'))
                            ->first()?->code
                            ? true: false;      
                            
                            $user_permission->setting_leavetype_records_create = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leavetype_records_create'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_leavetype_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leavetype_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_leavetype_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leavetype_records_update'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_leavetype_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leavetype_records_delete'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_leavetype_records_restore = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leavetype_records_restore'))
                            ->first()?->code
                            ? true: false;

                            $user_permission->setting_calendar_records_create = $permission
                            ->where('code', '=', Config::get('user_permission.setting_calendar_records_create'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_calendar_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_calendar_records_read'))
                            ->first()?->code
                            ? true: false;

                            $user_permission->setting_userAccount_records_create = $permission
                            ->where('code', '=', Config::get('user_permission.setting_userAccount_records_create'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_userAccount_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_userAccount_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_userAccount_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_userAccount_records_update'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_userAccount_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_userAccount_records_delete'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_userAccount_records_restore = $permission
                            ->where('code', '=', Config::get('user_permission.setting_userAccount_records_restore'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_userAccount_records_change_password = $permission
                            ->where('code', '=', Config::get('user_permission.setting_userAccount_records_change_password'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_userAccount_records_apply_permission = $permission
                            ->where('code', '=', Config::get('user_permission.setting_userAccount_records_apply_permission'))
                            ->first()?->code
                            ? true: false;		
                            
        $user_permission->setting_leave_entitlements_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leave_entitlements_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_leave_entitlements_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leave_entitlements_records_update'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_leave_entitlements_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leave_entitlements_records_delete'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_leave_type_approving_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leave_type_approving_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_leave_type_approving_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leave_type_approving_records_update'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_leave_type_approving_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_leave_type_approving_records_delete'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_user_account_approving_records_read = $permission
                            ->where('code', '=', Config::get('user_permission.setting_user_account_approving_records_read'))
                            ->first()?->code
                            ? true: false;

        $user_permission->setting_user_account_approving_records_update = $permission
                            ->where('code', '=', Config::get('user_permission.setting_user_account_approving_records_update'))
                            ->first()?->code
                            ? true: false;

         $user_permission->setting_user_account_approving_records_delete = $permission
                            ->where('code', '=', Config::get('user_permission.setting_user_account_approving_records_delete'))
                            ->first()?->code
                            ? true: false;
                            $user_permission->leave_application_apply = $permission
                            ->where('code', '=', Config::get('user_permission.leave_application_apply'))
                            ->first()?->code
                            ? true: false;
							
							
        $user_permission->leave_application_manage = $permission
                            ->where('code', '=', Config::get('user_permission.leave_application_manage'))
                            ->first()?->code
                            ? true: false;
							
							
        $user_permission->leave_application_history = $permission
                            ->where('code', '=', Config::get('user_permission.leave_application_history'))
                            ->first()?->code
                            ? true: false;
							
		$user_permission->application_menu = $permission
                            ->where('code', '=', Config::get('user_permission.application_menu'))
                            ->first()?->code
                            ? true: false;
							
		$user_permission->setting_menu = $permission
                            ->where('code', '=', Config::get('user_permission.setting_menu'))
                            ->first()?->code
                            ? true: false;
   
        return view('auth.permission', [
            'user' => $user,
            'user_permission' =>$user_permission
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('apply_permission', User::class);

        FunctionRoleUser::where('user_id', '=', $id)->delete();

        try {
            
            if($request->has(Config::get('user_permission.setting_company_records_create'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_company_records_create'));
            }
    
            if($request->has(Config::get('user_permission.setting_company_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_company_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_company_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_company_records_update'));
            }
    
            if($request->has(Config::get('user_permission.setting_company_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_company_records_delete'));
            }
    
            if($request->has(Config::get('user_permission.setting_company_records_restore'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_company_records_restore'));
            }

            if($request->has(Config::get('user_permission.setting_holiday_records_create'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_holiday_records_create'));
            }
    
            if($request->has(Config::get('user_permission.setting_holiday_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_holiday_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_holiday_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_holiday_records_update'));
            }
    
            if($request->has(Config::get('user_permission.setting_holiday_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_holiday_records_delete'));
            }
    
            if($request->has(Config::get('user_permission.setting_holiday_records_restore'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_holiday_records_restore'));
            }

            if($request->has(Config::get('user_permission.setting_workingday_records_create'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_workingday_records_create'));
            }
    
            if($request->has(Config::get('user_permission.setting_workingday_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_workingday_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_workingday_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_workingday_records_update'));
            }
    
            if($request->has(Config::get('user_permission.setting_workingday_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_workingday_records_delete'));
            }
    
            if($request->has(Config::get('user_permission.setting_workingday_records_restore'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_workingday_records_restore'));
            }
            if($request->has(Config::get('user_permission.setting_department_records_create'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_department_records_create'));
            }
    
            if($request->has(Config::get('user_permission.setting_department_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_department_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_department_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_department_records_update'));
            }
    
            if($request->has(Config::get('user_permission.setting_department_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_department_records_delete'));
            }
    
            if($request->has(Config::get('user_permission.setting_department_records_restore'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_department_records_restore'));
            }

            if($request->has(Config::get('user_permission.setting_leavetype_records_create'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leavetype_records_create'));
            }
    
            if($request->has(Config::get('user_permission.setting_leavetype_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leavetype_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_leavetype_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leavetype_records_update'));
            }
    
            if($request->has(Config::get('user_permission.setting_leavetype_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leavetype_records_delete'));
            }
    
            if($request->has(Config::get('user_permission.setting_leavetype_records_restore'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leavetype_records_restore'));
            }

            if($request->has(Config::get('user_permission.setting_calendar_records_create'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_calendar_records_create'));
            }
    
            if($request->has(Config::get('user_permission.setting_calendar_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_calendar_records_read'));
            }

            if($request->has(Config::get('user_permission.setting_userAccount_records_create'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_userAccount_records_create'));
            }
    
            if($request->has(Config::get('user_permission.setting_userAccount_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_userAccount_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_userAccount_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_userAccount_records_update'));
            }
    
            if($request->has(Config::get('user_permission.setting_userAccount_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_userAccount_records_delete'));
            }
    
            if($request->has(Config::get('user_permission.setting_userAccount_records_restore'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_userAccount_records_restore'));
            }
			
			if($request->has(Config::get('user_permission.setting_userAccount_records_change_password'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_userAccount_records_change_password'));
            }
			
			if($request->has(Config::get('user_permission.setting_userAccount_records_apply_permission'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_userAccount_records_apply_permission'));
            }

            if($request->has(Config::get('user_permission.setting_leave_entitlements_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leave_entitlements_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_leave_entitlements_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leave_entitlements_records_update'));
            }
            if($request->has(Config::get('user_permission.setting_leave_entitlements_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leave_entitlements_records_delete'));
            }

            if($request->has(Config::get('user_permission.setting_leave_type_approving_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leave_type_approving_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_leave_type_approving_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leave_type_approving_records_update'));
            }
            if($request->has(Config::get('user_permission.setting_leave_type_approving_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_leave_type_approving_records_delete'));
            }

            if($request->has(Config::get('user_permission.setting_user_account_approving_records_read'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_user_account_approving_records_read'));
            }
    
            if($request->has(Config::get('user_permission.setting_user_account_approving_records_update'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_user_account_approving_records_update'));
            }
            if($request->has(Config::get('user_permission.setting_user_account_approving_records_delete'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_user_account_approving_records_delete'));
            }

            if($request->has(Config::get('user_permission.leave_application_apply'))){
                $this->add_user_permission($id, Config::get('user_permission.leave_application_apply'));
            }
			if($request->has(Config::get('user_permission.leave_application_manage'))){
                $this->add_user_permission($id, Config::get('user_permission.leave_application_manage'));
            }
			if($request->has(Config::get('user_permission.leave_application_history'))){
                $this->add_user_permission($id, Config::get('user_permission.leave_application_history'));
            }

            if($request->has(Config::get('user_permission.application_menu'))){
                $this->add_user_permission($id, Config::get('user_permission.application_menu'));
            }
            
            if($request->has(Config::get('user_permission.setting_menu'))){
                $this->add_user_permission($id, Config::get('user_permission.setting_menu'));
            }
    
            return back()->with('success', trans('message.update_success'));

        } catch (Throwable $e) {
            return back()->with('success', trans('message.system_error')); 
            return false;
        }

        

    }

    private function add_user_permission($id, $role){
        FunctionRoleUser::create([
            'code'=> $role,
            'user_id'=> $id
            ]);
    }
}
