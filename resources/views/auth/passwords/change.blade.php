@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $user->name }}</h2>
    <form action="{{ route('user-password.update', $user) }}" method="post">
    @method('PUT')
    @csrf 
    <div class="row">
        <div class="title">
            <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
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
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" readonly value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter the username/email">
                        </div>
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