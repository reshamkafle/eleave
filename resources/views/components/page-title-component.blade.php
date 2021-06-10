
<div id="pageTitleContainer" class="container-fluid">
   <div class="container">
        <h1>
            @if (session()->has('pageTitleIcon'))
                <i class="{{ session('pageTitleIcon') }}"></i>             
            @endif

            @if (session()->has('pageTitle'))
                {{ session('pageTitle') }}
            @endif
        </h1>
    </div>

</div>