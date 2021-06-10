
@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ route('useraccounts.search') }}">
        @csrf  
        <x-searchPanelComponent :companies="$companies" :link="route('useraccounts')" />
    </form>
    <form method="post" action="{{ route('useraccounts.multi-action') }}">
        @csrf    
        <div class="row">
            <div class="title">

                @can('create', App\Models\User::class)
                    <a href="{{ route('useraccounts.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add </a>
                @endcan
                
                @if ($useraccounts->count()) 
                    @can('delete', App\Models\User::class)
                        <button type="submit" name="btn-submit" value="1" onclick="return confirm('Are you sure you want to delete?.')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    @endcan
                    @can('restore', App\Models\User::class)
                        <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Restore</button>
                    @endcan
                @endif
            </div>
        </div>
        <div class="row">
            @if ($useraccounts->count())
            <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" name="checkAll" class="checkAll"></th>
                    <th>Name</th>
                    <td>Staff Id</td>
                    <td>Email</td>
                    <td>Company Name</td>
                    @can('change_password', App\Models\User::class)
                    <td></td>
                    @endcan
                    @can('apply_permission', App\Models\User::class)
                    <td></td>
                    @endcan
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach ($useraccounts as $useraccount)
                <tr>
                    <td class="text-center"><input class="checkboxes" type="checkbox" name="id[]" value="{{$useraccount-> id}}"> </td>
                    <td>
                        <a href="{{ route('useraccounts.show', $useraccount->id) }}">{{$useraccount->name}}</a>                
                    </td>
                    <td>{{$useraccount-> staffId}}</td> 
                    <td>{{$useraccount-> email}}</td> 
                    <td>{{$useraccount-> companyName}}</td> 
                    @can('change_password', App\Models\User::class)
                        <td><a href="{{ route('user-password.show', $useraccount->id) }}">Reset Password</a></td>             
                    @endcan
                    @can('apply_permission', App\Models\User::class)
                    <td><a href="{{ route('user-permission.show', $useraccount->id) }}">Permissions</a></td>             
                    @endcan
                    <td><a href="{{ route('leave_user_approving_officer.show', $useraccount->id) }}">Approving Officer(s)</a></td>
                    <td>
                    @if ($useraccount-> deleted_at != null)
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        {{ \Carbon\Carbon::parse($useraccount->deleted_at)->diffForHumans() }}
                    @endif          
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>

            {{ $useraccounts->links() }}
            @else
            <div class="row justify-content-center">
                <h3>There are no useraccount</h3>
            </div>
            @endif
        </div>
    </form>
</div>
<x-checkboxComponent />
@endsection