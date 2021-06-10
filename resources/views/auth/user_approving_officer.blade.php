
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$aUser->name}}</h2>
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
        <form action="{{ route('leave_user_approving_officer.update', $aUser) }}" method="post">
        @method('PUT')
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="user_id">Approving Officer</label>
                            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                <option value="0" selected >-- Select an approving officer --</option>
                                @foreach ($users as $user)
                                    <option  value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>                     
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
            @if ($approving_officers->count())   
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>User</td>
                        <th>Approving Officer</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($approving_officers as $approving_officer)
                    <tr>
                        <td>{{$approving_officer->username}}</td>
                        <td>{{$approving_officer->approvername}}</td>
                        <td>
                            
                            <form onsubmit="return confirm('Do you really want to delete it?');" action="{{ route('leave_user_approving_officer.delete', $aUser->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-times" aria-hidden="true"></i> Delete </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $approving_officers->links() }}
            @else
            <div class="row justify-content-center">
                <h3>There are no approving officer for {{$aUser->name}}</h3>
            </div>
            @endif
            </div>
        </div>
    </div>
</div>
<script>
@endsection