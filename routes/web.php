<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/calender', [App\Http\Controllers\EventController::class, 'index'])->name('calender');
Route::post('/calenderAjax', [App\Http\Controllers\EventController::class, 'ajax'])->name('calender.ajax');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/setting/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies');
Route::get('/setting/companies/edit/{company}', [App\Http\Controllers\CompanyController::class, 'show'])->name('companies.show');
Route::get('/setting/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
Route::post('/setting/companies/new', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.insert');
Route::put('/setting/companies/{company}', [App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
Route::post('/setting/companies/multi/actions', [App\Http\Controllers\CompanyController::class, 'multi_action'])->name('companies.multi-action');
Route::post('/setting/companies', [App\Http\Controllers\CompanyController::class, 'search'])->name('companies.search');
Route::delete('/setting/companies/', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
Route::get('/setting/holidays', [App\Http\Controllers\HolidayController::class, 'index'])->name('holidays');
Route::get('/setting/holidays/edit/{holiday}', [App\Http\Controllers\HolidayController::class, 'show'])->name('holidays.show');
Route::get('/setting/holidays/create/', [App\Http\Controllers\HolidayController::class, 'create'])->name('holidays.create');
Route::post('/setting/holidays/new', [App\Http\Controllers\HolidayController::class, 'store'])->name('holidays.insert');
Route::put('/setting/holidays/{holiday}', [App\Http\Controllers\HolidayController::class, 'update'])->name('holidays.update');
Route::post('/setting/holidays', [App\Http\Controllers\HolidayController::class, 'search'])->name('holidays.search');
Route::post('/setting/holidays/multi/actions', [App\Http\Controllers\HolidayController::class, 'multi_action'])->name('holidays.multi-action');
Route::delete('/setting/holidays', [App\Http\Controllers\HolidayController::class, 'destroy'])->name('holidays.destroy');
Route::get('/setting/working-days', [App\Http\Controllers\workingdayController::class, 'index'])->name('workingdays');
Route::get('/setting/working-days/edit/{workingday}', [App\Http\Controllers\workingdayController::class, 'show'])->name('workingdays.show');
Route::get('/setting/working-days/create', [App\Http\Controllers\workingdayController::class, 'create'])->name('workingdays.create');
Route::post('/setting/working-days/new', [App\Http\Controllers\workingdayController::class, 'store'])->name('workingdays.insert');
Route::put('/setting/working-days/{workingday}', [App\Http\Controllers\workingdayController::class, 'update'])->name('workingdays.update');
Route::post('/setting/working-days', [App\Http\Controllers\workingdayController::class, 'search'])->name('workingdays.search');
Route::post('/setting/working-days/multi/actions', [App\Http\Controllers\workingdayController::class, 'multi_action'])->name('workingdays.multi-action');
Route::delete('/setting/working-days', [App\Http\Controllers\workingdayController::class, 'destroy'])->name('workingdays.destroy');
Route::get('/setting/user-accounts', [App\Http\Controllers\Auth\UserController::class, 'index'])->name('useraccounts');
Route::get('/setting/user-accounts/edit/{userid}', [App\Http\Controllers\Auth\UserController::class, 'show'])->name('useraccounts.show');
Route::get('/setting/user-accounts/create', [App\Http\Controllers\Auth\UserController::class, 'create'])->name('useraccounts.create');
Route::post('/setting/user-accounts/new', [App\Http\Controllers\Auth\UserController::class, 'store'])->name('useraccounts.insert');
Route::put('/setting/user-accounts/{userid}', [App\Http\Controllers\Auth\UserController::class, 'update'])->name('useraccounts.update');
Route::post('/setting/user-accounts', [App\Http\Controllers\Auth\UserController::class, 'search'])->name('useraccounts.search');
Route::post('/setting/user-accounts/multi/actions', [App\Http\Controllers\Auth\UserController::class, 'multi_action'])->name('useraccounts.multi-action');
Route::delete('/setting/user-accounts', [App\Http\Controllers\Auth\UserController::class, 'destroy'])->name('useraccounts.destroy');
Route::get('/setting/user-accounts/user-password/{userId}', [App\Http\Controllers\Auth\UserPasswordController::class, 'show'])->name('user-password.show');
Route::put('/setting/user-accounts/user-password/{userid}', [App\Http\Controllers\Auth\UserPasswordController::class, 'update'])->name('user-password.update');
Route::get('/setting/user-accounts/user-permission/{userId}', [App\Http\Controllers\Auth\UserPermissionController::class, 'show'])->name('user-permission.show');
Route::put('/setting/user-accounts/user-permission/{userId}', [App\Http\Controllers\Auth\UserPermissionController::class, 'update'])->name('user-permission.update');
Route::get('/setting/departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments');
Route::get('/setting/departments/edit/{departmentId}', [App\Http\Controllers\DepartmentController::class, 'show'])->name('departments.show');
Route::get('/setting/departments/create', [App\Http\Controllers\DepartmentController::class, 'create'])->name('departments.create');
Route::post('/setting/departments/new', [App\Http\Controllers\DepartmentController::class, 'store'])->name('departments.insert');
Route::put('/setting/departments/{departmentId}', [App\Http\Controllers\DepartmentController::class, 'update'])->name('departments.update');
Route::post('/setting/departments', [App\Http\Controllers\DepartmentController::class, 'search'])->name('departments.search');
Route::post('/setting/departments/multi/actions', [App\Http\Controllers\DepartmentController::class, 'multi_action'])->name('departments.multi-action');
Route::delete('/setting/departments', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('departments.destroy');
Route::get('/setting/leave-type', [App\Http\Controllers\LeaveTypeController::class, 'index'])->name('leaveTypes');
Route::get('/setting/leave-type/edit/{leaveTypeId}', [App\Http\Controllers\LeaveTypeController::class, 'show'])->name('leaveTypes.show');
Route::get('/setting/leave-type/create', [App\Http\Controllers\LeaveTypeController::class, 'create'])->name('leaveTypes.create');
Route::post('/setting/leave-type/new', [App\Http\Controllers\LeaveTypeController::class, 'store'])->name('leaveTypes.insert');
Route::put('/setting/leave-type/{leaveTypeId}', [App\Http\Controllers\LeaveTypeController::class, 'update'])->name('leaveTypes.update');
Route::post('/setting/leave-type', [App\Http\Controllers\LeaveTypeController::class, 'search'])->name('leaveTypes.search');
Route::post('/setting/leave-type/multi/actions', [App\Http\Controllers\LeaveTypeController::class, 'multi_action'])->name('leaveTypes.multi-action');
Route::delete('/setting/leave-type', [App\Http\Controllers\LeaveTypeController::class, 'destroy'])->name('leaveTypes.destroy');
Route::get('/setting/leave-entitlement', [App\Http\Controllers\LeaveEntitlementController::class, 'index'])->name('leave_entitlements');
Route::get('/setting/leave-entitlement/edit/{entitlementid}', [App\Http\Controllers\LeaveEntitlementController::class, 'show'])->name('leave_entitlements.show');
Route::get('/setting/leave-entitlement/create', [App\Http\Controllers\LeaveEntitlementController::class, 'create'])->name('leave_entitlements.create');
Route::put('/setting/leave-entitlement/{entitlementid}', [App\Http\Controllers\LeaveEntitlementController::class, 'store'])->name('leave_entitlements.update');
Route::post('/setting/leave-entitlement', [App\Http\Controllers\LeaveEntitlementController::class, 'search'])->name('leave_entitlements.search');
Route::delete('/setting/leave-entitlement/{entitlementid}', [App\Http\Controllers\LeaveEntitlementController::class, 'destroy'])->name('leave_entitlements.delete');
Route::get('/setting/leave-type/leave-type-approver-officer/{leaveTypeId}', [App\Http\Controllers\LeaveTypeApprovingOfficerController::class, 'show'])->name('leave_approving_officer.show');
Route::put('/setting/leave-type/leave-type-approver-officer/{leaveTypeId}', [App\Http\Controllers\LeaveTypeApprovingOfficerController::class, 'update'])->name('leave_approving_officer.update');
Route::delete('/setting/leave-type/leave-type-approver-officer/{leave_type_approverId}', [App\Http\Controllers\LeaveTypeApprovingOfficerController::class, 'destroy'])->name('leave_approving_officer.delete');
Route::get('/setting/user-accounts/leave-user-approver-officer/{userId}', [App\Http\Controllers\Auth\UserApprovingOfficerController::class, 'show'])->name('leave_user_approving_officer.show');
Route::put('/setting/user-accounts/leave-user-approver-officer/{userId}', [App\Http\Controllers\Auth\UserApprovingOfficerController::class, 'update'])->name('leave_user_approving_officer.update');
Route::delete('/setting/user-accounts/leave-user-approver-officer/{leave_user_approverId}', [App\Http\Controllers\Auth\UserApprovingOfficerController::class, 'destroy'])->name('leave_user_approving_officer.delete');
Route::get('/leave-application', [App\Http\Controllers\LeaveApplicationController::class, 'show'])->name('leave_application.show');
Route::post('/leave-application', [App\Http\Controllers\LeaveApplicationController::class, 'store'])->name('leave_application.store');
Route::get('/leave-application/confirmation/{applicationId}', [App\Http\Controllers\LeaveApplicationConfirmationController::class, 'show'])->name('leave_application_confirmation');
Route::post('/leave-application/confirmation/{applicationId}', [App\Http\Controllers\LeaveApplicationConfirmationController::class, 'update'])->name('leave_application_confirmation.update');
Route::get('/leave-application/confirmation/document/{applicationId}', [App\Http\Controllers\LeaveApplicationConfirmationController::class, 'download'])->name('leave_application_confirmation.download');
Route::get('/leave-application/confirmation/document/delete/{applicationId}', [App\Http\Controllers\LeaveApplicationConfirmationController::class, 'destroy'])->name('leave_application_confirmation.destroy');
Route::get('/leave-application/manage', [App\Http\Controllers\ManageLeaveApplicationController::class, 'index'])->name('leave_application_manage');
Route::get('/leave-application/approve/{applicationId}', [App\Http\Controllers\ManageLeaveApplicationController::class, 'approve'])->name('leave_application_manage.approve');
Route::get('/leave-application/reject/{applicationId}', [App\Http\Controllers\ManageLeaveApplicationController::class, 'reject'])->name('leave_application_manage.reject');
Route::get('/leave-application/destory/{applicationId}', [App\Http\Controllers\ManageLeaveApplicationController::class, 'destory'])->name('leave_application_manage.destory');
Route::get('/leave-application/history', [App\Http\Controllers\LeaveApplicationHistoryController::class, 'index'])->name('leave_application_history');
Route::get('/leave-application/manage/document/{applicationId}', [App\Http\Controllers\ManageLeaveApplicationDocumentContoller::class, 'index'])->name('leave_application_manage_document');