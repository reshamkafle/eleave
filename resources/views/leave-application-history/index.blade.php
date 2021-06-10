
@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post">
        @csrf    
        <div class="row">
            <h2>Applications History</h2>
            @if ($LeaveApplications->count())
            <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>leaveType</td>
                    <td>Applied Date</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                    <td>Full Day</td>
                    <td>No Of Day Deduct</td>
                    <td>Decision</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($LeaveApplications as $LeaveApplication)
                <tr>
                    <td>{{ $LeaveApplication->leaveType}}</td>
                    <td>{{ $LeaveApplication->createDate}}</td>
                    <td>{{ $LeaveApplication->startDate}}</td>
                    <td>{{ $LeaveApplication->endDate}}</td>

                    @if ($LeaveApplication->fullDay == 1)
                    <td>Full Day</td>
                    @else
                    <td>Half Day</td>
                    @endif

                    <td>{{ $LeaveApplication->noOfDayDeduct}}</td>
                    @if($LeaveApplication->leaveStatus == 0)
                    <td>Pending</td>            
                    @elseif($LeaveApplication->leaveStatus == 1)
                    <td>Approve</td>
                    @else
                    <td>Reject</td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <div class="row justify-content-center">
                <h3> <br /> <br /> <br />There are no pending leave applications</h3>
            </div>
            @endif
        </div>
    </form>
</div>
<x-checkboxComponent />
@endsection