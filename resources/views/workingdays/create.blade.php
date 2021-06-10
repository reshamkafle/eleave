

@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ route('workingdays.insert') }}" method="post">
    @csrf
    <div class="row">
        <div class="title">
            <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
            <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & Close</button>
            <button type="submit" name="btn-submit" value="3" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & New</button>
            <a href="{{ route('workingdays') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
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
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option selected value="0">-- Select a company --</option>
                                @foreach ($companies as $company)
                                    @if(old('company_id') == $company->id){
                                        <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                    @else
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endif
                                @endforeach
                            </select>                     
                        </div>
                        <div class="form-group">
                            <label for="day">Day</label>
                            <select name="day" id="day" class="form-control @error('day') is-invalid @enderror">
                                <option selected value="-1">-- Select a Day --</option>
                                @foreach ($weekdays as $weekday)
                                    @if(old('day') == $weekday->dayValue){
                                        <option selected value="{{ $weekday->dayValue}}">{{ $weekday->dayName  }}</option>
                                    @else
                                        <option value="{{ $weekday->dayValue}}">{{ $weekday->dayName  }}</option>
                                    @endif
                                @endforeach
                            </select> 
                        </div>                  
                        <div class="form-check">
                            <input class="form-check-input" checked value="{{ old('fullDay') }}" type="checkbox" name="fullDay" id="fullDay">
                            <label class="form-check-label @error('fullDay') is-invalid @enderror" for=" fullDay">
                                Full Day
                            </label>
                        </div>  
                    </div>
                </div>       
            </div>
        </div>
    </form>
</div>
@endsection