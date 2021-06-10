
@extends('layouts.app')

@section('content')
<div class="container">  
    <form method="post" action="{{ route('companies.search') }}">
        @csrf
        <x-searchPanelComponentForCountry :countries="$countries" :link="route('companies')" />
    </form>
    <form method="post" action="{{ route('companies.multi-action') }}">
        @csrf
        <div class="row">
            <div class="title">
                @can('create', App\Models\Company::class)
                <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add </a>
                @endcan
                                   
                @if ($companies->count()) 
                    @can('delete', App\Models\Company::class) 
                        <button type="submit" name="btn-submit" value="1" onclick="return confirm('Are you sure you want to delete?.')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    @endcan
                    @can('restore', App\Models\Company::class) 
                        <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Restore</button>
                    @endcan
                @endif          
            </div>
        </div>
        @if ($companies->count())       
        <div class="row">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center"><input type="checkbox" name="checkAll" class="checkAll"></th>
                        <th>Company name</td>
                        <th>Country</td>
                        <th>Telephone</td>
                        <th>Email Address</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td class="text-center"><input class="checkboxes" type="checkbox" name="id[]" value="{{$company-> id}}"> </td>
                        <td>
                            <a href="{{ route('companies.show', $company->id) }}">{{$company-> name}}</a>
                        </td>
                        <td>{{$company-> country_name}}</td>
                        <td>{{$company-> telephone}}</td>
                        <td>{{$company-> emailAddress}}</td>                      
                        <td> 
                            @if ($company-> deleted_at != null)
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                {{ \Carbon\Carbon::parse($company->deleted_at)->diffForHumans() }}
                            @endif  
                        </td>  
                        
                    </tr>
                @endforeach
                </tbody>
            </table>          
            {{ $companies->links() }}
        @else
        </div>
        <div class="row justify-content-center">
            <h3>There are no company</h3>
        </div>
    @endif
    </form>
</div>

<x-checkboxComponent />

@endsection