
@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ route('leave_entitlements.search') }}">
        @csrf  
        <x-searchPanelComponent :companies="$companies" :link="route('leave_entitlements')" />
    </form>
        @csrf    
        <div class="row">
            @if ($leave_entitlements->count())
            <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" name="checkAll" class="checkAll"></th>
                    <th>Name</th>
                    <td>Staff Id</td>
                    <td>Email</td>
                    <td>Company Name</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($leave_entitlements as $useraccount)
                <tr>
                    <td class="text-center"><input class="checkboxes" type="checkbox" name="id[]" value="{{$useraccount-> id}}"> </td>
                    <td>
                        <a href="{{ route('leave_entitlements.show', $useraccount->id) }}">{{$useraccount->name}}</a>                
                    </td>
                    <td>{{$useraccount-> staffId}}</td> 
                    <td>{{$useraccount-> email}}</td> 
                    <td>{{$useraccount-> companyName}}</td> 
                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $leave_entitlements->links() }}
            @else
            <div class="row justify-content-center">
                <h3>There are no leave entitlement record</h3>
            </div>
            @endif
        </div>
</div>
<x-checkboxComponent />
@endsection