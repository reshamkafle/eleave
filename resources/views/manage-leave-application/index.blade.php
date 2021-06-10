
@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="row">
    <h2>Pending Applications</h2></div>
    <div class="row">

        @if ($LeaveApplications->count())
        <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <td>personName</td>
                <td>leaveType</td>
                <td>Applied Date</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Full Day</td>
                <td>No Of Day Deduct</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        @foreach ($LeaveApplications as $LeaveApplication)
            <tr>
                <td>{{ $LeaveApplication->personName}}</td>
                <td>{{ $LeaveApplication->leaveType}}</td>
                <td>{{ $LeaveApplication->createDate}}</td>
                <td>{{ $LeaveApplication->startDate}}</td>
                <td>{{ $LeaveApplication->endDate}}</td>
                @if($LeaveApplication->fullDay == 1)
                <td>Full Day</td>
                @else
                <td>Half Day</td>
                @endif
                <td>{{ $LeaveApplication->noOfDayDeduct}}</td>
                <td>
                    <a href="{{ route('leave_application_manage.approve', $LeaveApplication->id) }}">Approve</a>
                </td>
                <td>
                    <a href="{{ route('leave_application_manage.reject', $LeaveApplication->id) }}">Reject</a>
                </td>
                <td>
                <a href="{{ route('leave_application_manage_document', $LeaveApplication->id) }}">Documents</a>
                
                </td>
                <td>
                    <a href="{{ route('leave_application_manage.destory', $LeaveApplication->id) }}">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @else
        <div class="row justify-content-center">
            <h3>There are no pending leave applications</h3>
        </div>
        @endif
    </div>
</div>
<x-checkboxComponent />
@endsection