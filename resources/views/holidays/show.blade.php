
@extends('layouts.app')

@section('content')
<script src="{{ asset('js/main.js') }}" defer></script>
<div class="container">
    <form action="{{ route('holidays.update', $holiday) }}" method="post">
    @method('PUT')
    @csrf
        <div class="row">
            <div class="title">
                <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
                <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & Close</button>
                <button type="submit" name="btn-submit" value="3" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & New</button>
                @can('delete', AppModelsHoliday::class) 
                    <button type="button" onclick="destory('{{$holiday->id}}')" class="btn btn-danger btn-sm" ><i class="fa fa-times" aria-hidden="true"></i> Delete </button>
                @endcan
                <a href="{{ route('holidays') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>
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
                                    @if($company->id == $holiday->company_id)
                                        <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                    @else
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endif
                                @endforeach
                            </select>                     
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ $holiday->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" value="{{ $holiday->startDate}}" class="form-control @error('startDate') is-invalid @enderror" name="startDate" id="startDate" placeholder="Enter date">
                        </div>
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" value="{{ $holiday->endDate }}" class="form-control @error('endDate') is-invalid @enderror" name="endDate" id="endDate" placeholder="Enter date">
                        </div>   
                        <div class="form-check">
                            @if($holiday->fullDay)
                            <input class="form-check-input" checked="checked" type="checkbox" name="fullDay" id="fullDay">
                            @else
                            <input class="form-check-input" type="checkbox" name="fullDay" id="fullDay">
                            @endif
                            
                            <label class="form-check-label @error('fullDay') is-invalid @enderror" for="fullDay">
                                Full Day
                            </label>
                        </div>  
                    </div>                                    
                </div>
            </div>
        </div>
    </form>
</div>
<script>
function destory(id){
    var ajaxURL = '{{ route('holidays.destroy') }}';
    var redirectURL =  '{{ route('holidays') }}';
    delete_record(id, ajaxURL, redirectURL);
}
</script>
@endsection