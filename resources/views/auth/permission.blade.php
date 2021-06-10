
@extends('layouts.app')

@section('content')
<script src="{{ asset('js/main.js') }}" defer></script>

<div class="container">
    <h2>{{ $user->name }}</h2>
    <form action="{{ route('user-permission.update', $user) }}" method="post">
    @method('PUT')
    @csrf 
    <div class="row">
        <div class="title">
            <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
            <a href="{{ route('useraccounts') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 row">  
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input menu_checkall" type="checkbox" id="menu_checkall" name="company_checkall">
                       <label class="form-check-label" for="menu_checkall">
                       Menu
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->application_menu)
                            <input class="form-check-input checkboxes_menu"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.application_menu') }}" id="{{ Config::get('user_permission.application_menu') }}">
                            @else
                                <input class="form-check-input checkboxes_menu"  type="checkbox" name="{{ Config::get('user_permission.application_menu') }}" id="{{ Config::get('user_permission.application_menu') }}">
                            @endif
                            <label class="form-check-label" for="application_menu">
                            Leave Application
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_menu)
                            <input class="form-check-input checkboxes_menu"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_menu') }}" id="{{ Config::get('user_permission.setting_menu') }}">
                            @else
                                <input class="form-check-input checkboxes_menu"  type="checkbox" name="{{ Config::get('user_permission.setting_menu') }}" id="{{ Config::get('user_permission.setting_menu') }}">
                            @endif
                            <label class="form-check-label" for="setting_menu">
                            Setting
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
             <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input company_checkall" type="checkbox" id="company_checkall" name="company_checkall">
                       <label class="form-check-label" for="company_checkall">
                       Company
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_company_records_create)
                            <input class="form-check-input checkboxes_company" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_company_records_create') }}" id="{{ Config::get('user_permission.setting_company_records_create') }}">
                            @else
                                <input class="form-check-input checkboxes_company"  type="checkbox" name="{{ Config::get('user_permission.setting_company_records_create') }}" id="{{ Config::get('user_permission.setting_company_records_create') }}">
                            @endif
                            <label class="form-check-label" for="setting_company_records_create">
                            Create
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_company_records_read)
                            <input class="form-check-input checkboxes_company"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_company_records_read') }}" id="{{ Config::get('user_permission.setting_company_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_company"  type="checkbox" name="{{ Config::get('user_permission.setting_company_records_read') }}" id="{{ Config::get('user_permission.setting_company_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_company_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_company_records_update)
                            <input class="form-check-input checkboxes_company"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_company_records_update') }}" id="{{ Config::get('user_permission.setting_company_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_company"  type="checkbox" name="{{ Config::get('user_permission.setting_company_records_update') }}" id="{{ Config::get('user_permission.setting_company_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_company_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_company_records_delete)
                            <input class="form-check-input checkboxes_company"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_company_records_delete') }}" id="{{ Config::get('user_permission.setting_company_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_company"  type="checkbox" name="{{ Config::get('user_permission.setting_company_records_delete') }}" id="{{ Config::get('user_permission.setting_company_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_company_records_delete">
                            Delete
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_company_records_restore)
                            <input class="form-check-input checkboxes_company"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_company_records_restore') }}" id="{{ Config::get('user_permission.setting_company_records_restore') }}">
                            @else
                                <input class="form-check-input checkboxes_company"  type="checkbox" name="{{ Config::get('user_permission.setting_company_records_restore') }}" id="{{ Config::get('user_permission.setting_company_records_restore') }}">
                            @endif
                            <label class="form-check-label" for="setting_company_records_restore">
                            Restore
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input holiday_checkall" type="checkbox" id="holiday_checkall" name="company_checkall">
                       <label class="form-check-label" for="holiday_checkall">
                       Holiday
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_holiday_records_create)
                            <input class="form-check-input checkboxes_holiday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_holiday_records_create') }}" id="{{ Config::get('user_permission.setting_holiday_records_create') }}">
                            @else
                                <input class="form-check-input checkboxes_holiday" type="checkbox" name="{{ Config::get('user_permission.setting_holiday_records_create') }}" id="{{ Config::get('user_permission.setting_holiday_records_create') }}">
                            @endif
                            <label class="form-check-label" for="setting_holiday_records_create">
                            Create
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_holiday_records_read)
                            <input class="form-check-input checkboxes_holiday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_holiday_records_read') }}" id="{{ Config::get('user_permission.setting_holiday_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_holiday" type="checkbox" name="{{ Config::get('user_permission.setting_holiday_records_read') }}" id="{{ Config::get('user_permission.setting_holiday_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_holiday_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_holiday_records_update)
                            <input class="form-check-input checkboxes_holiday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_holiday_records_update') }}" id="{{ Config::get('user_permission.setting_holiday_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_holiday" type="checkbox" name="{{ Config::get('user_permission.setting_holiday_records_update') }}" id="{{ Config::get('user_permission.setting_holiday_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_holiday_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_holiday_records_delete)
                            <input class="form-check-input checkboxes_holiday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_holiday_records_delete') }}" id="{{ Config::get('user_permission.setting_holiday_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_holiday" type="checkbox" name="{{ Config::get('user_permission.setting_holiday_records_delete') }}" id="{{ Config::get('user_permission.setting_holiday_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_holiday_records_delete">
                            Delete
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_holiday_records_restore)
                            <input class="form-check-input checkboxes_holiday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_holiday_records_restore') }}" id="{{ Config::get('user_permission.setting_holiday_records_restore') }}">
                            @else
                                <input class="form-check-input checkboxes_holiday" type="checkbox" name="{{ Config::get('user_permission.setting_holiday_records_restore') }}" id="{{ Config::get('user_permission.setting_holiday_records_restore') }}">
                            @endif
                            <label class="form-check-label" for="setting_holiday_records_restore">
                            Restore
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input workingday_checkall" type="checkbox" id="workingday_checkall" name="company_checkall">
                       <label class="form-check-label" for="workingday_checkall">
                       Working Days
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_workingday_records_create)
                            <input class="form-check-input checkboxes_workingday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_workingday_records_create') }}" id="{{ Config::get('user_permission.setting_workingday_records_create') }}">
                            @else
                                <input class="form-check-input checkboxes_workingday" type="checkbox" name="{{ Config::get('user_permission.setting_workingday_records_create') }}" id="{{ Config::get('user_permission.setting_workingday_records_create') }}">
                            @endif
                            <label class="form-check-label" for="setting_workingday_records_create">
                            Create
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_workingday_records_read)
                            <input class="form-check-input checkboxes_workingday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_workingday_records_read') }}" id="{{ Config::get('user_permission.setting_workingday_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_workingday" type="checkbox" name="{{ Config::get('user_permission.setting_workingday_records_read') }}" id="{{ Config::get('user_permission.setting_workingday_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_workingday_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_workingday_records_update)
                            <input class="form-check-input checkboxes_workingday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_workingday_records_update') }}" id="{{ Config::get('user_permission.setting_workingday_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_workingday" type="checkbox" name="{{ Config::get('user_permission.setting_workingday_records_update') }}" id="{{ Config::get('user_permission.setting_workingday_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_workingday_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_workingday_records_delete)
                            <input class="form-check-input checkboxes_workingday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_workingday_records_delete') }}" id="{{ Config::get('user_permission.setting_workingday_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_workingday" type="checkbox" name="{{ Config::get('user_permission.setting_workingday_records_delete') }}" id="{{ Config::get('user_permission.setting_workingday_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_workingday_records_delete">
                            Delete
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_workingday_records_restore)
                            <input class="form-check-input checkboxes_workingday" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_workingday_records_restore') }}" id="{{ Config::get('user_permission.setting_workingday_records_restore') }}">
                            @else
                                <input class="form-check-input checkboxes_workingday" type="checkbox" name="{{ Config::get('user_permission.setting_workingday_records_restore') }}" id="{{ Config::get('user_permission.setting_workingday_records_restore') }}">
                            @endif
                            <label class="form-check-label" for="setting_workingday_records_restore">
                            Restore
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section> 
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input department_checkall" type="checkbox" id="department_checkall" name="company_checkall">
                       <label class="form-check-label" for="department_checkall">
                       Department
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_department_records_create)
                            <input class="form-check-input checkboxes_department" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_department_records_create') }}" id="{{ Config::get('user_permission.setting_department_records_create') }}">
                            @else
                                <input class="form-check-input checkboxes_department" type="checkbox" name="{{ Config::get('user_permission.setting_department_records_create') }}" id="{{ Config::get('user_permission.setting_department_records_create') }}">
                            @endif
                            <label class="form-check-label" for="setting_department_records_create">
                            Create
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_department_records_read)
                            <input class="form-check-input checkboxes_department" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_department_records_read') }}" id="{{ Config::get('user_permission.setting_department_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_department" type="checkbox" name="{{ Config::get('user_permission.setting_department_records_read') }}" id="{{ Config::get('user_permission.setting_department_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_department_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_department_records_update)
                            <input class="form-check-input checkboxes_department" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_department_records_update') }}" id="{{ Config::get('user_permission.setting_department_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_department" type="checkbox" name="{{ Config::get('user_permission.setting_department_records_update') }}" id="{{ Config::get('user_permission.setting_department_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_department_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_department_records_delete)
                            <input class="form-check-input checkboxes_department" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_department_records_delete') }}" id="{{ Config::get('user_permission.setting_department_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_department" type="checkbox" name="{{ Config::get('user_permission.setting_department_records_delete') }}" id="{{ Config::get('user_permission.setting_department_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_department_records_delete">
                            Delete
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_department_records_restore)
                            <input class="form-check-input checkboxes_department" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_department_records_restore') }}" id="{{ Config::get('user_permission.setting_department_records_restore') }}">
                            @else
                                <input class="form-check-input checkboxes_department" type="checkbox" name="{{ Config::get('user_permission.setting_department_records_restore') }}" id="{{ Config::get('user_permission.setting_department_records_restore') }}">
                            @endif
                            <label class="form-check-label" for="setting_department_records_restore">
                            Restore
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section> 
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input leaveType_checkall" type="checkbox" id="leaveType_checkall" name="company_checkall">
                       <label class="form-check-label" for="leaveType_checkall">
                       Leave Type
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_leavetype_records_create)
                            <input class="form-check-input checkboxes_leaveType" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leavetype_records_create') }}" id="{{ Config::get('user_permission.setting_leavetype_records_create') }}">
                            @else
                                <input class="form-check-input checkboxes_leaveType" type="checkbox" name="{{ Config::get('user_permission.setting_leavetype_records_create') }}" id="{{ Config::get('user_permission.setting_leavetype_records_create') }}">
                            @endif
                            <label class="form-check-label" for="setting_leavetype_records_create">
                            Create
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_leavetype_records_read)
                            <input class="form-check-input checkboxes_leaveType" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leavetype_records_read') }}" id="{{ Config::get('user_permission.setting_leavetype_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_leaveType" type="checkbox" name="{{ Config::get('user_permission.setting_leavetype_records_read') }}" id="{{ Config::get('user_permission.setting_leavetype_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_leavetype_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_leavetype_records_update)
                            <input class="form-check-input checkboxes_leaveType" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leavetype_records_update') }}" id="{{ Config::get('user_permission.setting_leavetype_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_leaveType" type="checkbox" name="{{ Config::get('user_permission.setting_leavetype_records_update') }}" id="{{ Config::get('user_permission.setting_leavetype_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_leavetype_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_leavetype_records_delete)
                            <input class="form-check-input checkboxes_leaveType" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leavetype_records_delete') }}" id="{{ Config::get('user_permission.setting_leavetype_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_leaveType" type="checkbox" name="{{ Config::get('user_permission.setting_leavetype_records_delete') }}" id="{{ Config::get('user_permission.setting_leavetype_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_leavetype_records_delete">
                            Delete
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_leavetype_records_restore)
                            <input class="form-check-input checkboxes_leaveType" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leavetype_records_restore') }}" id="{{ Config::get('user_permission.setting_leavetype_records_restore') }}">
                            @else
                                <input class="form-check-input checkboxes_leaveType" type="checkbox" name="{{ Config::get('user_permission.setting_leavetype_records_restore') }}" id="{{ Config::get('user_permission.setting_leavetype_records_restore') }}">
                            @endif
                            <label class="form-check-label" for="setting_leavetype_records_restore">
                            Restore
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
            <section class="col-sm-12 col-md-3">
                <div class="card">
                <div class="card-header checkall_permission">
                       <input class="form-check-input calendar_checkall" type="checkbox" id="calendar_checkall" name="company_checkall">
                       <label class="form-check-label" for="calendar_checkall">
                        Calendar
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_calendar_records_create)
                            <input class="form-check-input checkboxes_calendar" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_calendar_records_create') }}" id="{{ Config::get('user_permission.setting_calendar_records_create') }}">
                            @else
                                <input class="form-check-input checkboxes_calendar" type="checkbox" name="{{ Config::get('user_permission.setting_calendar_records_create') }}" id="{{ Config::get('user_permission.setting_calendar_records_create') }}">
                            @endif
                            <label class="form-check-label" for="setting_calendar_records_create">
                            Create
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_calendar_records_read)
                            <input class="form-check-input checkboxes_calendar" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_calendar_records_read') }}" id="{{ Config::get('user_permission.setting_calendar_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_calendar" type="checkbox" name="{{ Config::get('user_permission.setting_calendar_records_read') }}" id="{{ Config::get('user_permission.setting_calendar_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_calendar_records_read">
                            Read
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
            
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input leave_entitlements_checkall" type="checkbox" id="leave_entitlements_checkall" name="leave_entitlements_checkall">
                       <label class="form-check-label" for="leave_entitlements_checkall">
                       Leave Entitlement
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_leave_entitlements_records_read)
                            <input class="form-check-input checkboxes_leave_entitlements"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leave_entitlements_records_read') }}" id="{{ Config::get('user_permission.setting_leave_entitlements_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_entitlements"  type="checkbox" name="{{ Config::get('user_permission.setting_leave_entitlements_records_read') }}" id="{{ Config::get('user_permission.setting_leave_entitlements_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_leave_entitlements_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_leave_entitlements_records_update)
                            <input class="form-check-input checkboxes_leave_entitlements"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leave_entitlements_records_update') }}" id="{{ Config::get('user_permission.setting_leave_entitlements_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_entitlements"  type="checkbox" name="{{ Config::get('user_permission.setting_leave_entitlements_records_update') }}" id="{{ Config::get('user_permission.setting_leave_entitlements_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_leave_entitlements_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_leave_entitlements_records_delete)
                            <input class="form-check-input checkboxes_leave_entitlements"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leave_entitlements_records_delete') }}" id="{{ Config::get('user_permission.setting_leave_entitlements_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_entitlements"  type="checkbox" name="{{ Config::get('user_permission.setting_leave_entitlements_records_delete') }}" id="{{ Config::get('user_permission.setting_leave_entitlements_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_leave_entitlements_records_delete">
                            Delete
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input leave_type_approving_checkall" type="checkbox" id="leave_type_approving_checkall" name="leave_type_approving_checkall">
                       <label class="form-check-label" for="leave_type_approving_checkall">
                       Leave Type Approving Officer
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_leave_type_approving_records_read)
                            <input class="form-check-input checkboxes_leave_type_approving"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leave_type_approving_records_read') }}" id="{{ Config::get('user_permission.setting_leave_type_approving_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_type_approving"  type="checkbox" name="{{ Config::get('user_permission.setting_leave_type_approving_records_read') }}" id="{{ Config::get('user_permission.setting_leave_type_approving_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_leave_type_approving_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_leave_type_approving_records_update)
                            <input class="form-check-input checkboxes_leave_type_approving"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leave_type_approving_records_update') }}" id="{{ Config::get('user_permission.setting_leave_type_approving_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_type_approving"  type="checkbox" name="{{ Config::get('user_permission.setting_leave_type_approving_records_update') }}" id="{{ Config::get('user_permission.setting_leave_type_approving_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_leave_type_approving_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_leave_type_approving_records_delete)
                            <input class="form-check-input checkboxes_leave_type_approving"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_leave_type_approving_records_delete') }}" id="{{ Config::get('user_permission.setting_leave_type_approving_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_type_approving"  type="checkbox" name="{{ Config::get('user_permission.setting_leave_type_approving_records_delete') }}" id="{{ Config::get('user_permission.setting_leave_type_approving_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_leave_type_approving_records_delete">
                            Delete
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input userAccount_checkall" type="checkbox" id="userAccount_checkall" name="userAccount_checkall">
                       <label class="form-check-label" for="userAccount_checkall">
                       User Account
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_userAccount_records_create)
                            <input class="form-check-input checkboxes_userAccount" type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_userAccount_records_create') }}" id="{{ Config::get('user_permission.setting_userAccount_records_create') }}">
                            @else
                                <input class="form-check-input checkboxes_userAccount"  type="checkbox" name="{{ Config::get('user_permission.setting_userAccount_records_create') }}" id="{{ Config::get('user_permission.setting_userAccount_records_create') }}">
                            @endif
                            <label class="form-check-label" for="setting_userAccount_records_create">
                            Create
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_userAccount_records_read)
                            <input class="form-check-input checkboxes_userAccount"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_userAccount_records_read') }}" id="{{ Config::get('user_permission.setting_userAccount_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_userAccount"  type="checkbox" name="{{ Config::get('user_permission.setting_userAccount_records_read') }}" id="{{ Config::get('user_permission.setting_userAccount_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_userAccount_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_userAccount_records_update)
                            <input class="form-check-input checkboxes_userAccount"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_userAccount_records_update') }}" id="{{ Config::get('user_permission.setting_userAccount_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_userAccount"  type="checkbox" name="{{ Config::get('user_permission.setting_userAccount_records_update') }}" id="{{ Config::get('user_permission.setting_userAccount_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_userAccount_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_userAccount_records_delete)
                            <input class="form-check-input checkboxes_userAccount"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_userAccount_records_delete') }}" id="{{ Config::get('user_permission.setting_userAccount_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_userAccount"  type="checkbox" name="{{ Config::get('user_permission.setting_userAccount_records_delete') }}" id="{{ Config::get('user_permission.setting_userAccount_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_userAccount_records_delete">
                            Delete
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_userAccount_records_restore)
                            <input class="form-check-input checkboxes_userAccount"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_userAccount_records_restore') }}" id="{{ Config::get('user_permission.setting_userAccount_records_restore') }}">
                            @else
                                <input class="form-check-input checkboxes_userAccount"  type="checkbox" name="{{ Config::get('user_permission.setting_userAccount_records_restore') }}" id="{{ Config::get('user_permission.setting_userAccount_records_restore') }}">
                            @endif
                            <label class="form-check-label" for="setting_userAccount_records_restore">
                            Restore
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_userAccount_records_change_password)
                            <input class="form-check-input checkboxes_userAccount"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_userAccount_records_change_password') }}" id="{{ Config::get('user_permission.setting_userAccount_records_change_password') }}">
                            @else
                                <input class="form-check-input checkboxes_userAccount"  type="checkbox" name="{{ Config::get('user_permission.setting_userAccount_records_change_password') }}" id="{{ Config::get('user_permission.setting_userAccount_records_change_password') }}">
                            @endif
                            <label class="form-check-label" for="setting_userAccount_records_change_password">
                            Reset Password
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_userAccount_records_apply_permission)
                            <input class="form-check-input checkboxes_userAccount"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_userAccount_records_apply_permission') }}" id="{{ Config::get('user_permission.setting_userAccount_records_apply_permission') }}">
                            @else
                                <input class="form-check-input checkboxes_userAccount"  type="checkbox" name="{{ Config::get('user_permission.setting_userAccount_records_apply_permission') }}" id="{{ Config::get('user_permission.setting_userAccount_records_apply_permission') }}">
                            @endif
                            <label class="form-check-label" for="setting_userAccount_records_apply_permission">
                            Apply Permission
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                       <input class="form-check-input user_account_approving_checkall" type="checkbox" id="user_account_approving_checkall" name="user_account_approving_checkall">
                       <label class="form-check-label" for="user_account_approving_checkall">
                       User Account Approving Officer
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->setting_user_account_approving_records_read)
                            <input class="form-check-input checkboxes_user_account_approving"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_user_account_approving_records_read') }}" id="{{ Config::get('user_permission.setting_user_account_approving_records_read') }}">
                            @else
                                <input class="form-check-input checkboxes_user_account_approving"  type="checkbox" name="{{ Config::get('user_permission.setting_user_account_approving_records_read') }}" id="{{ Config::get('user_permission.setting_user_account_approving_records_read') }}">
                            @endif
                            <label class="form-check-label" for="setting_user_account_approving_records_read">
                            Read
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_user_account_approving_records_update)
                            <input class="form-check-input checkboxes_user_account_approving"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_user_account_approving_records_update') }}" id="{{ Config::get('user_permission.setting_user_account_approving_records_update') }}">
                            @else
                                <input class="form-check-input checkboxes_user_account_approving"  type="checkbox" name="{{ Config::get('user_permission.setting_user_account_approving_records_update') }}" id="{{ Config::get('user_permission.setting_user_account_approving_records_update') }}">
                            @endif
                            <label class="form-check-label" for="setting_user_account_approving_records_update">
                            Update
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->setting_user_account_approving_records_delete)
                            <input class="form-check-input checkboxes_user_account_approving"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.setting_user_account_approving_records_delete') }}" id="{{ Config::get('user_permission.setting_user_account_approving_records_delete') }}">
                            @else
                                <input class="form-check-input checkboxes_user_account_approving"  type="checkbox" name="{{ Config::get('user_permission.setting_user_account_approving_records_delete') }}" id="{{ Config::get('user_permission.setting_user_account_approving_records_delete') }}">
                            @endif
                            <label class="form-check-label" for="setting_user_account_approving_records_delete">
                            Delete
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
            <section class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-header checkall_permission">
                    <input class="form-check-input leave_application_checkall" type="checkbox" id="leave_application_checkall" name="leave_application_checkall">
                    <label class="form-check-label" for="leave_application_checkall">
                        Leave Application
                        </label>               
                    </div>
                    <ul class="list-group list-group-flush permission">
                        <li class="list-group-item">
                            @if($user_permission->leave_application_apply)
                            <input class="form-check-input checkboxes_leave_application"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.leave_application_apply') }}" id="{{ Config::get('user_permission.leave_application_apply') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_application"  type="checkbox" name="{{ Config::get('user_permission.leave_application_apply') }}" id="{{ Config::get('user_permission.leave_application_apply') }}">
                            @endif
                            <label class="form-check-label" for="leave_application_apply">
                            Apply
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->leave_application_manage)
                            <input class="form-check-input checkboxes_leave_application"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.leave_application_manage') }}" id="{{ Config::get('user_permission.leave_application_manage') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_application"  type="checkbox" name="{{ Config::get('user_permission.leave_application_manage') }}" id="{{ Config::get('user_permission.leave_application_manage') }}">
                            @endif
                            <label class="form-check-label" for="leave_application_manage">
                            Manage
                            </label>                         
                        </li>
                        <li class="list-group-item">
                            @if($user_permission->leave_application_history)
                            <input class="form-check-input checkboxes_leave_application"  type="checkbox" checked="checked" name="{{ Config::get('user_permission.leave_application_history') }}" id="{{ Config::get('user_permission.leave_application_history') }}">
                            @else
                                <input class="form-check-input checkboxes_leave_application"  type="checkbox" name="{{ Config::get('user_permission.leave_application_history') }}" id="{{ Config::get('user_permission.leave_application_history') }}">
                            @endif
                            <label class="form-check-label" for="leave_application_history">
                            History
                            </label>                         
                        </li>
                    </ul>
                </div>                         
            </section>
        </div>
    </div>
</form>
</div>
@endsection