
@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ route('holidays.search') }}">
        @csrf  
         <x-searchPanelComponent :companies="$companies" :link="route('holidays')" />
    </form>
    <form method="post" action="{{ route('holidays.multi-action') }}">
        @csrf    
        <div class="row">
            <div class="title">
                @can('create', App\Models\Holiday::class)
                <a href="{{ route('holidays.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add </a>
                @endcan
                
                @if ($holidays->count()) 
                    @can('delete', App\Models\Holiday::class) 
                        <button type="submit" name="btn-submit" value="1" onclick="return confirm('Are you sure you want to delete?.')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    @endcan  
                    @can('restore', App\Models\Holiday::class)  
                        <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Restore</button>
                    @endcan
                @endif
                
            </div>
        </div>
        <div class="row">
            @if ($holidays->count())
            <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" name="checkAll" class="checkAll"></th>
                    <td>Name</td>
                    <td>Company Name</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                    <td>Full Day</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach ($holidays as $holiday)
                <tr>
                    <td class="text-center"><input class="checkboxes" type="checkbox" name="id[]" value="{{$holiday-> id}}"> </td>
                    <td>
                        <a href="{{ route('holidays.show', $holiday->id) }}">{{$holiday->name}}</a>
                    </td>
                    <td>{{$holiday-> company_name}}</td>
                    <td>{{$holiday-> startDate}}</td>
                    <td>{{$holiday-> endDate}}</td>
                    @if ($holiday-> fullDay == 1)
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif
                    <td>
                    @if ($holiday-> deleted_at != null)
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        {{ \Carbon\Carbon::parse($holiday->deleted_at)->diffForHumans() }}
                    @endif          
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $holidays->links() }}
            @else
            <div class="row justify-content-center">
                <h3>There are no holiday</h3>
            </div>
            @endif
        </div>
    </form>
</div>
<x-checkboxComponent />
@endsection