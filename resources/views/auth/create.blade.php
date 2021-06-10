
@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('useraccounts.insert')}}" method="post">
    @csrf
        <div class="row">
            <div class="title">
                <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
                <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & Close</button>
                <button type="submit" name="btn-submit" value="3" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & New</button>
                <a href="{{ route('useraccounts') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>
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
                            <label for="company_id">Country</label>
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
                        <div class="form-group">
                            <label for="staffId ">Staff Id</label>
                            <input type="text" value="{{ old('staffId ') }}" class="form-control @error('staffId ') is-invalid @enderror" id="staffId" name="staffId" aria-describedby="emailHelp" placeholder="Enter staff Id">
                        </div>
                        <div class="form-group">
                            <label for="joinDate ">Join Date</label>
                            <input type="date" value="{{ old('joinDate ') }}" class="form-control @error('joinDate ') is-invalid @enderror" id="joinDate" name="joinDate" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="email">Email/Username</label>
                            <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email/username">
                        </div>   
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter the password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Re-enter the password">
                        </div>
                    </div>
                </div>           
            </div>  
        </div>
    </form>
</div>
@endsection