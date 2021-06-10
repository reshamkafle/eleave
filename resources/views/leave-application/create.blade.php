
@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  @endsection
@section('content')
<div class="container">
    <form action="{{ route('leave_application.store')}}" method="post">
    @csrf
        <div class="row">
            <div class="title">
                <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Submit</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">        
                <div class="card border-primary mb-3">
                    <div class="card-body text-primary">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="leave_type_id">Leave Type</label>
                            <select name="leave_type_id" id="leave_type_id" class="form-control @error('leave_type_id') is-invalid @enderror">
                                <option value="0">-- Select a leave type --</option>
                                @foreach ($leaveTypes as $leaveType)
                                    @if(old('leave_type_id') == $leaveType->id){
                                        <option selected value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                    @else
                                        <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                    @endif
                                @endforeach
                            </select>                     
                        </div>
                        <div class="form-group">
                            <label for="startDate">From Date</label>
                            <input type="date" value="{{ old('startDate') }}" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="endDate">To Date</label>
                            <input type="date" value="{{ old('endDate') }}" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate" aria-describedby="emailHelp">
                        </div>
                        <div class="form-check">
                            <input checked class="form-check-input @error('	fullDay') is-invalid @enderror" value="{{ old('fullDay') }}" type="checkbox" name="fullDay" id="fullDay">
                            <label class="form-check-label" for="fullDay">
                                Full Day
                            </label>
                        </div> 
                    </div> 
                </div>         
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        @if ($entitlements->count())   
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Leave Type</td>
                                    <th>No Of Entitlement</th>
                                    <th>Used</th>
                                    <th>Balance</th>
                                    <th>Allow negative application ?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entitlements as $entitlement)

                                @if($entitlement != null)
                                <tr>
                                    <td>{{$entitlement->leaveType}}</td>                                   
                                    <td>{{$entitlement->entitlement}}</td>
                                    <td>{{$entitlement->used}}</td>
                                    <td>{{$entitlement->balance}}</td>
                                    @if($entitlement->allowNegativeApplication)
                                        <td>Yes</td>
                                    @else
                                        <td>No</td>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        * if current year entitlement is not set, it uses previous year.
                        @else
                        <div class="row justify-content-center">
                            <h3>There are no entitlement</h3>
                        </div>
                        @endif
                        </div>
                    </div>
                </div>                             
            </div>
        </div>
        <div class="col-sm-12"> 
                <div class="row full-calendar">
                    <div class="col-sm-12">
                        <div id="calendar"></div>
                    </div>
                </div>
                <script src="{{ asset('js/calender.js') }}" defer></script>
            </div> 
        </div>
    </form>
</div>
@endsection