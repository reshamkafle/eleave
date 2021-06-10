
@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="row">
    <h2>Application Documents</h2></div>
    <div class="row">  
        @if ($applicationDocuments->count())
        <h3>Documents</h3>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>Name</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach ($applicationDocuments as $applicationDocument)
            <tr>
                <td>{{$applicationDocument->name}}</td>
                <td><a href="{{ route('leave_application_confirmation.download', $applicationDocument->id) }}">Download</a></td>
            </tr>
            </tbody>
            @endforeach
        </table>
        @endif
    </div>
</div>
@endsection