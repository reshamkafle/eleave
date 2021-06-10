
@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ route('leaveTypes.search') }}">
        @csrf  
         <x-searchPanelComponent :companies="$companies" :link="route('leaveTypes')" />
    </form>
    <form method="post" action="{{ route('leaveTypes.multi-action') }}">
        @csrf    
        <div class="row">
            <div class="title">
                @can('create', App\Models\LeaveType::class)
                    <a href="{{ route('leaveTypes.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add </a>
                @endcan
                @if ($leaveTypes->count()) 
                    @can('delete', App\Models\LeaveType::class)
                        <button type="delete" name="btn-submit" value="1" onclick="return confirm('Are you sure you want to delete?.')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    @endcan
                    @can('restore', App\Models\LeaveType::class)
                        <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Restore</button>
                    @endcan
                @endif
            </div>
        </div>
        <div class="row">
            @if ($leaveTypes->count())
            <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" name="checkAll" class="checkAll"></th>
                    <td>Name</td>
                    <td>Company Name</td>
                    <td>Allow Negative Application</td>
                    <td>Need Certificate</td>
                    <td>Cut off Month</td>
                    @can('show', App\Models\LeaveTypeApprovingOfficer::class)
                    <td></td>
                    @endcan
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach ($leaveTypes as $leaveType)
                <tr>
                    <td class="text-center"><input class="checkboxes" type="checkbox" name="id[]" value="{{$leaveType-> id}}"> </td>
                    <td>
                        <a href="{{ route('leaveTypes.show', $leaveType->id) }}">{{$leaveType->name}}</a>
                    </td>
                    <td>{{$leaveType-> company_name}}</td>
                    @if ($leaveType-> allowNegativeApplication)
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif                    
                    @if ($leaveType-> needCertificate)
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif 
                    <td>{{$leaveType-> monthName}}</td>
                    @can('show', App\Models\LeaveTypeApprovingOfficer::class)
                    <td><a href="{{ route('leave_approving_officer.show', $leaveType->id) }}">Approving Officer(s)</a></td>
                    @endcan
                    <td>
                    @if ($leaveType-> deleted_at != null)
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        {{ \Carbon\Carbon::parse($leaveType->deleted_at)->diffForHumans() }}
                    @endif          
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $leaveTypes->links() }}
            @else
            <div class="row justify-content-center">
                <h3>There are no leaveType</h3>
            </div>
            @endif
        </div>
    </form>
</div>
<x-checkboxComponent />
@endsection