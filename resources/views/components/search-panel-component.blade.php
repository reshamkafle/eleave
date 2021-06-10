

<div class="card border-primary mb-3">
  <div class="card-header">Search</div>
    <div class="card-body text-primary">
        <div id="search" class="row">
            <div class="col-sm-12 col-md-3">
                <select name="company_id" id="company_id" class="form-control">
                    <option value="0">--Select a company --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>  
            </div>
            <div class="col-sm-12 col-md-3">
                <select name="status" id="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Trash</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-3">
                <button type="submit" class="btn btn-outline-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            </div>
            <div class="col-sm-12 col-md-3">
                <button type="button" onclick='location.replace("{{$link}}")' class="btn btn-outline-primary btn-block"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
            </div>
        </div>
    </div>
</div>