
@extends('layouts.app')

@section('content')
<script src="{{ asset('js/main.js') }}" defer></script>

<div class="container">
    <form action="{{ route('leaveTypes.update', $leaveType) }}" method="post">
    @method('PUT')
    @csrf
        <div class="row">
            <div class="title">
                <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
                <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & Close</button>
                <button type="submit" name="btn-submit" value="3" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & New</button>
                <button type="button" onclick="destory('{{$leaveType->id}}')" class="btn btn-danger btn-sm" ><i class="fa fa-times" aria-hidden="true"></i> Delete </button>
                <a href="{{ route('leaveTypes') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>
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
                            <label for="company">Company</label>
                            <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="0">-- Select a company --</option>
                                @foreach ($companies as $company)
                                    @if($company->id == $leaveType->company_id)
                                        <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                    @else
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endif
                                @endforeach
                            </select>                     
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ $leaveType->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name">
                        </div>   
                        <div class="form-check">
                            @if ($leaveType-> allowNegativeApplication == 1)
                            <input class="form-check-input" checked="checked" type="checkbox" name="allowNegativeApplication" id="allowNegativeApplication">
                            @else
                            <input class="form-check-input" type="checkbox" name="allowNegativeApplication" id="allowNegativeApplication">
                            @endif
                            <label class="form-check-label @error('allowNegativeApplication') is-invalid @enderror" for="allowNegativeApplication">
                            Allow Negative Application
                            </label>
                        </div>  
                        <div class="form-check">
                            @if($leaveType-> needCertificate)
                            <input class="form-check-input" checked="checked" type="checkbox" name="needCertificate" id="needCertificate">
                            @else
                            <input class="form-check-input" type="checkbox" name="needCertificate" id="needCertificate">
                            @endif
                            <label class="form-check-label @error('needCertificate') is-invalid @enderror" for="needCertificate">
                                Need Certificate
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="month_id">Cut off Month</label>
                            <select name="cycleMonth" id="cycleMonth" class="form-control @error('cycleMonth') is-invalid @enderror">
                                <option value="0">-- Select a month --</option>
                                @foreach ($months as $month)
                                    @if($month->month == $leaveType->cycleMonth)
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
<script>
function destory(id){
    var ajaxURL = '{{ route('leaveTypes.destroy') }}';
    var redirectURL =  '{{ route('leaveTypes') }}';
    delete_record(id, ajaxURL, redirectURL);
}
</script>
@endsection