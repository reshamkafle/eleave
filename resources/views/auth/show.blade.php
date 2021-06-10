
@extends('layouts.app')

@section('content')
<script src="{{ asset('js/main.js') }}" defer></script>

<div class="container">
    <h2>{{ $user->name }}</h2> 
        <form action="{{ route('useraccounts.update', $user) }}" method="post">
        @method('PUT')
        @csrf 

        <div class="row">
            <div class="title">
                <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
                <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & Close</button>
                <button type="submit" name="btn-submit" value="3" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & New</button>
                <button type="button" onclick="destory('{{$user->id}}')" class="btn btn-danger btn-sm" ><i class="fa fa-times" aria-hidden="true"></i> Delete </button>
                <a href="{{ route('useraccounts') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">                        
                <div class="card border-primary mb-3" >
                    <div class="card-body text-primary">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" readonly value="{{ $user->email }}" class="form-control" name="email" placeholder="Enter the username/email">
                    </div>
                    <div class="form-group">
                            <label for="company">Company</label>
                            <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="0">-- Select a company --</option>
                                @foreach ($companies as $company)
                                    @if($company->id == $user->company_id)
                                        <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                    @else
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endif
                                @endforeach
                            </select>                     
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="staffId ">Staff Id</label>
                            <input type="text" value="{{ $user->staffId }}" class="form-control @error('staffId ') is-invalid @enderror" id="staffId" name="staffId" aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="joinDate ">Join Date</label>
                            <input type="date" value="{{ old('joinDate ') }}" class="form-control @error('joinDate ') is-invalid @enderror" id="joinDate" name="joinDate" aria-describedby="emailHelp">
                        </div>
                    </div>
                </div>           
            </div>
        </div>
    </form>
</div>

<script>
function destory(id){
    var ajaxURL = '{{ route('useraccounts.destroy') }}';
    var redirectURL =  '{{ route('useraccounts') }}';
    delete_record(id, ajaxURL, redirectURL);
}
</script>
@endsection