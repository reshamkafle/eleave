
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$user->name}}</h2>
   
    <div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
    <div class="card">
        <form action="{{ route('leave_entitlements.update', $user) }}" method="post">
        @method('PUT')
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="company">Leave Type</label>
                            <select name="leave_type_id" id="leave_type_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="0" selected >-- Select a leave type --</option>
                                @foreach ($leaveTypes as $leaveType)
                                    <option  value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                @endforeach
                            </select>                     
                        </div>  
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="text" class="form-control" value="{{ old('year') }}" id="year" name="year" aria-describedby="emailHelp" placeholder="Enter year e.g. 1, 2, 3,4">
                        </div>
                        <div class="form-group">
                            <label for="entitlement">No Of Entitlement</label>
                            <input type="number" class="form-control @error('entitlement') is-invalid @enderror" value="{{ old('entitlement') }}" id="entitlement" name="entitlement" aria-describedby="emailHelp" placeholder="No Of Entitlement">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btn-submit" class="btn btn-outline-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
            @if ($entitlements->count())   
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Leave Type</td>
                        <th>Year or later *</th>
                        <th>No Of Entitlement</th>
                        <th>Allow negative application ?</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entitlements as $entitlement)
                    <tr>
                        <td>{{$entitlement->leaveType}}</td>
                        <td>
                            {{$entitlement->year}}
                            ({{\Carbon\Carbon::parse($user->joinDate)->addYears($entitlement->year)->addYears(-1)->format('Y')}})

                        </td>
                        <td>{{$entitlement->entitlement}}</td>

                        @if($entitlement->allowNegativeApplication)
                            <td>Yes</td>
                        @else
                            <td>No</td>
                        @endif
                        <td>
                            <form onsubmit="return confirm('Do you really want to delete it?');" action="{{ route('leave_entitlements.delete', $entitlement->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-times" aria-hidden="true"></i> Delete </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            * if current year entitlement is not set, it uses previous year.
            @else
            <div class="row justify-content-center">
                <h3>There are no entitlement for {{$user->name}}</h3>
            </div>
            @endif
            </div>
        </div>
    </div>   
</div>
<script>
@endsection