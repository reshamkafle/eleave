
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Summary</h2>
    <div class="row">
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <td>Leave Type</td>
                <td>{{$application->leaveType}}</td>
            </tr>
            <tr>
                <td>Apply Date</td>
                <td>{{$application->created_at}}</td>
            </tr>
            <tr>
                <td>Leave Start From</td>
                <td>{{$application->startDate}}</td>
            </tr>
            <tr>
                <td>Leave End To</td>
                <td>{{$application->endDate}}</td>
            </tr>
            <tr>
                <td>Full Day</td>
                @if($application->fullDay == 1)
                <td>Yes</td>
                @else
                <td>No</td>
                @endif                
            </tr>
            <tr>
                <td>Total Days Applied</td>
                <td>{{$application->noOfDayApplied}}</td>
            </tr>
            <tr>
                <td>Total Working Days</td>
                <td>{{$application->noOfWorkingDay}}</td>
            </tr>
            <tr>
                <td>Total Public Holidays</td>
                <td>{{$application->noOfPublicHoliday}}</td>
            </tr>
            <tr>
                <td><strong>Total Days Deduct</strong></td>
                <td>{{$application->noOfDayDeduct}}</td>
            </tr>
        </table>
    </div>

    <div class="row">  
        @if ($applicationDocuments->count())
        <h3>Documents</h3>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>Name</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach ($applicationDocuments as $applicationDocument)
            <tr>
                <td>{{$applicationDocument->name}}</td>
                <td><a href="{{ route('leave_application_confirmation.download', $applicationDocument->id) }}">Download</a></td>
                <td><a href="{{ route('leave_application_confirmation.destroy', $applicationDocument->id) }}">Delete</a></td>
            </tr>
            </tbody>
            @endforeach
        </table>
        @endif
    </div>

    @if($application->needCertificate)
    <div class="row">    
        <h3>Don't forget to upload document.</h3>
    </div>
    <form action="{{ route('leave_application_confirmation.update', $application->id) }}" method="post" enctype="multipart/form-data">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div>
                <br />
                    @csrf
                    <div class="form-group">
                        <label for="name">End Date</label>
                        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter document name">
                    </div>  
                    <div class="form-group">
                        <input type="file" class="form-control" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>            
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

@endsection