
@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('leaveTypes.insert')}}" method="post">
    @csrf
        <div class="row">
            <div class="title">
                <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
                <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & Close</button>
                <button type="submit" name="btn-submit" value="3" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & New</button>
                <a href="{{ route('leaveTypes') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>
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
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="0">-- Select a company --</option>
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
                            <label for="name">Name</label>
                            <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name">
                        </div>   
                        <div class="form-check">
                            <input class="form-check-input" value="{{ old('	allowNegativeApplication') }}" type="checkbox" name="allowNegativeApplication" id="allowNegativeApplication">
                            <label class="form-check-label @error('	allowNegativeApplication') is-invalid @enderror" for="allowNegativeApplication">
                                Allow Negative Application
                            </label>
                        </div> 
                        <div class="form-check">
                            <input class="form-check-input" value="{{ old('needCertificate') }}" type="checkbox" name="needCertificate" id="needCertificate">
                            <label class="form-check-label @error('needCertificate') is-invalid @enderror" for="fullDay">
                                Need Certificate
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="month_id">Cut off Month</label>
                            <select name="cycleMonth" id="cycleMonth" class="form-control @error('cycleMonth') is-invalid @enderror">
                                <option value="0">-- Select a month --</option>
                                @foreach ($months as $month)
                                    @if(old('cycleMonth') == $month->id){
                                        <option selected value="{{ $month->month }}">{{ $month->monthName }}</option>
                                    @else
                                        <option value="{{ $month->month }}">{{ $month->monthName }}</option>
                                    @endif
                                @endforeach
                            </select>                     
                        </div>
                    </div>
                </div>           
            </div>  
        </div>
    </form>
</div>
@endsection