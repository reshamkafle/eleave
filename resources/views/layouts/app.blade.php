
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body>
    <div id="app">
        <nav id="topMenu" class="navbar navbar-expand-md ">
            <div class="container">
                <a class="navbar-brand nav-link-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav mr-auto">
                        @can('read', App\Models\Event::class)
                        <li class="nav-item">
                            <a class="nav-link nav-link-white" href="{{ route('calender') }}">Calender</a>
                        </li>
                       @endcan
                       @can('leave_application_menu', App\Models\User::class)

                       <li class="nav-item dropdown">
                            <a class="nav-link nav-link-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Leave
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @can('apply', App\Models\LeaveApplication::class)
                                <a class="dropdown-item" href="{{ route('leave_application.show') }}">Apply Applications</a>
                                @endcan
                                @can('manage', App\Models\LeaveApplication::class)
                                <a class="dropdown-item" href="{{ route('leave_application_manage') }}">Manage Applications</a>
                                @endcan
                                @can('history', App\Models\LeaveApplication::class)
                                <a class="dropdown-item" href="{{ route('leave_application_history') }}">Applications History</a>
                                @endcan
                            </div>
                        </li>
                        @endcan
                        @can('setting_menu', App\Models\User::class)

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-link-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Settings
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('read', App\Models\Company::class)
                                <a class="dropdown-item" href="{{ route('companies') }}">Companies</a>
                            @endcan
                            @can('read', App\Models\Holiday::class)
                                <a class="dropdown-item" href="{{ route('holidays') }}">Holidays</a>
                            @endcan
                            @can('read', App\Models\WorkingDay::class)
                            <a class="dropdown-item" href="{{ route('workingdays') }}">Working Days</a>
                            @endcan
                            @can('read', App\Models\LeaveType::class)          
                                <a class="dropdown-item" href="{{ route('leaveTypes') }}">Leave Types</a>
                            @endcan
                            @can('show', App\Models\LeaveEntitlement::class)
                                <a class="dropdown-item" href="{{ route('leave_entitlements') }}">Entitlements</a>
                            @endcan
                            @can('read', App\Models\User::class)
                                <a class="dropdown-item" href="{{ route('useraccounts') }}">User Accounts</a>
                            @endcan
                            </div>
                        </li>
                        @endcan

                    </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                           
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link nav-link-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @auth
            <x-pageTitleComponent />
            <div id="page" class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <x-alertComponent />
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-12">
                        <x-breadcrumbsComponent />
                    </div>
                </div>
            </div>
            @endauth
            @yield('content')
        </main>
    </div>
</body>
</html>