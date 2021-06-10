
@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ route('workingdays.search') }}">
        @csrf  
         <x-searchPanelComponent :companies="$companies" :link="route('workingdays')" />
    </form>
    <form method="post" action="{{ route('workingdays.multi-action') }}">
        @csrf  
        <div class="row">
            <div class="title">
                <a href="{{ route('workingdays.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add </a>
                @if ($workingdays->count()) 
                    @can('delete', App\Models\WorkingDay::class)
                    <button type="submit" name="btn-submit" value="1" onclick="return confirm('Are you sure you want to delete?.')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    @endcan
                    @can('restore', App\Models\WorkingDay::class)
                    <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Restore</button>
                    @endcan
                @endif
            </div>
        </div>
        <div class="row">
        @if ($workingdays->count())
            <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" name="checkAll" class="checkAll"></th>
                    <th>Day</th>
                    <th>Company</th>
                    <th>Full Day</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($workingdays as $workingdays)
                <tr>
                    <td class="text-center"><input class="checkboxes" type="checkbox" name="id[]" value="{{$workingdays-> id}}"> </td>
                    <td><a href="{{ route('workingdays.show', $workingdays->id) }}">{{$workingdays->dayName}}</a></td>
                    <td>
                        {{$workingdays->company_name}}            
                    </td>
                    @if ($workingdays-> fullDay == 1)
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif                 
                </tr>
            @endforeach
            </tbody>
            </table>
        @else
        <div class="row justify-content-center">
            <h3>There are no working day</h3>
        </div>
        @endif
        </div> 
    </form>   
</div>
<x-checkboxComponent />
@endsection