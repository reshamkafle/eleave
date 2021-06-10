
@if (session()->has('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('warn'))
    <div class="alert-danger">
        {{ session('warn') }}
    </div>
@endif