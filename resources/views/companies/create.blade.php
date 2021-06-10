
@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('companies.insert') }}" method="post">
        <div class="row">
            <div class="title">
                <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
                <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & Close</button>
                <button type="submit" name="btn-submit" value="3" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & New</button>
                <a href="{{ route('companies') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">         
                @csrf
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
                            <label for="name">Name</label>
                            <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter name of company">
                        </div>
                        <div class="form-group">
                            <label for="addressLine1">Address Line 1</label>
                            <input type="text" value="{{ old('addressLine1') }}" class="form-control @error('addressLine1') is-invalid @enderror" name="addressLine1" id="addressLine1" placeholder="Enter address line 1">
                        </div>
                        <div class="form-group">
                            <label for="addressLine2">Address Line 2</label>
                            <input type="text" value="{{ old('addressLine2') }}" class="form-control @error('addressLine2') is-invalid @enderror" name="addressLine2" id="addressLine2" placeholder="Enter address line 2">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" name="city" id="city" placeholder="Enter city">
                        </div>
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror">
                            <option value="0">-- Select a country --</option>

                                @foreach ($countries as $country)
                                    @if(old('country_id') == $country->id){

                                        <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                    }
                                    @else{
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    }
                                    @endif
                                @endforeach
                            </select>                     
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="number" value="{{ old('telephone') }}" class="form-control @error('telephone') is-invalid @enderror" name="telephone" id="telephone" placeholder="Enter your telephone number">
                        </div>
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" value="{{ old('fax') }}" class="form-control @error('fax') is-invalid @enderror" name="fax" id="fax" placeholder="Enter your fax number">
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Email Address</label>
                            <input type="email" value="{{ old('emailAddress') }}" class="form-control @error('emailAddress') is-invalid @enderror" name="emailAddress" id="emailAddress" placeholder="Enter your company default email address">
                        </div>
                    </div>
                </div>
                          
            </div>
        </div>
    </form>
</div>
@endsection