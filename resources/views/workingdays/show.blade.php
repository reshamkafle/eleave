
@extends('layouts.app')

@section('content')
<script src="{{ asset('js/main.js') }}" defer></script>
<div class="container">
    <form action="{{ route('workingdays.update', $workingday->id) }}" method="post">
        @method('PUT')
        @csrf 
        <div class="row">
            <div class="title">
                <button type="submit" name="btn-submit" value="1" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Save</button>
                <button type="submit" name="btn-submit" value="2" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & Close</button>
                <button type="submit" name="btn-submit" value="3" class="btn btn-outline-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Save & New</button>
                <button type="button" onclick="destory('{{$workingday->id}}')" class="btn btn-danger btn-sm" ><i class="fa fa-times" aria-hidden="true"></i> Delete </button>
                <a href="{{ route('workingdays') }}" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Cancel </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card border-primary mb-3">
                    <div class="card-body text-primary">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="0">-- Select a company --</option>
                                @foreach ($companies as $company)
                                    @if($company->id == $workingday->company_id)
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
                                <option value="0">-- Select a Day --</option>
                                @foreach ($weekdays as $weekday)
                                    @if($weekday->dayValue == $workingday->day)
                                        <option selected value="{{ $weekday->dayValue }}">{{ $weekday->dayName }}</option>
                                    @else
                                        <option value="{{ $weekday->dayValue }}">{{ $weekday->dayName }}</option>
                                    @endif
                                @endforeach
                            </select> 
                        </div>
                            
                        <div class="form-check">
                            @if($workingday-> fullDay)
                                <input class="form-check-input" type="checkbox" checked name="fullDay" id="fullDay">
                            @else
                                <input class="form-check-input" type="checkbox" name="fullDay" id="fullDay">
                            @endif                        
                            <label class="form-check-label @error('fullDay') is-invalid @enderror for="fullDay">
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
    var ajaxURL = '{{ route('workingdays.destroy') }}';
    var redirectURL =  '{{ route('workingdays') }}';
    delete_record(id, ajaxURL, redirectURL);
}
</script>
@endsection