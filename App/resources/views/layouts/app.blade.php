<!doctype html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FAYM* Bank</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/general.js') }}"></script>

</head>
{{--style="background-color: #EEEFF0"--}}
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a href="/home" class="navbar-brand"><img src="{{asset('images/logo.png')}}" alt=""  height="48"></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-warning" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/accounts">Accounts Summary</a>
                                    <a class="dropdown-item" href="/contacts">Manage Contacts</a>
                                    <a class="dropdown-item" href="/users/{{ Auth::user()->id }}/edit">Profile Settings</a>
                                    <hr class="dropdown-divider">

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
        @if (auth()->check() && !Request::is('home'))
            <div class="container py-5">
                <ul class="nav nav-tabs nav-fill">

                    <li class="nav-item">
                        <a class="h5  nav-link
                            @if (Request::is('accounts*'))
                                active
                            @endif
                              " href="/accounts">Accounts Summary</a>
                    </li>

                    <li class="nav-item">
                        <a class="h5 nav-link
                            @if (Request::is('transfer') || Request::is('transfer/contact') || Request::is('transfer/confirmation'))
                                active
                            @endif
                              " href="/transfer">Send Payment</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle h5
                        @if (Request::is('transfers/*'))
                            active
                        @endif
                            " href="/transfers/pending/incoming" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (count(request()->user()->transactions->where('status','Pending')->where('type','Deposit')) > 0)
                            <span class="badge bg-success rounded-pill align-top">{{count(request()->user()->transactions->where('status','Pending')->where('type','Deposit'))}}</span>
                            @endif
                            Pending Transfers
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/transfers/pending/incoming">Incoming Transfers</a></li>
                            <li><a class="dropdown-item" href="/transfers/pending/outgoing">Outgoing Transfers</a></li>
                        </ul>
                    </li>
                </ul>
                <p style="class: pb-2">
                    @if(session()->has('success'))
                    <div x-data="{ show: true }"
                         x-init="setTimeout(()=> show = false, 4000)"
                         x-transition.duration.750ms
                         x-show="show"
                         class="justify-content-center row">
                        <p class=" overlay bg-success col-3 px-4 py-2 rounded-pill text-center text-white">{{ session('success') }}</p>
                    </p>
            </div>
        @endif
        @if(session()->has('fail'))
            <div x-data="{ show: true }"
                 x-init="setTimeout(()=> show = false, 4000)"
                 x-transition.duration.750ms
                 x-show="show"
                 class="justify-content-center row">
                <p class="overlay bg-warning col-3 px-4 py-2 rounded-pill text-center text-white">{{ session('fail') }}</p>
            </div>
        @endif
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
{{--        style="position: relative;">--}}
        <footer class="text-center text-warning pt-3">
            <div>FAYM Bank Website &copy; 2022</div>
            <div class="mt-1 mb-2">FAYM Bank, 21 275 Rue Lakeshore Road, Sainte-Anne-de-Bellevue, QC H9X 3L9</div>
            <ul class="list-inline">
                <li class="list-inline-item"><a class="text-muted" href="#">About Us</a></li>
                <li class="list-inline-item"><a class="text-muted" href="#">FAQs</a></li>
                <li class="list-inline-item"><a class="text-muted" href="#">Careers</a></li>
                <li class="list-inline-item"><a class="text-muted" href="#">Privacy</a></li>
                <li class="list-inline-item"><a class="text-muted" href="#">Legal</a></li>
                <li class="list-inline-item"><a class="text-muted" href="#">Security</a></li>
                <li class="list-inline-item"><a class="text-muted" href="#">Accessibility</a></li>
                <li class="list-inline-item"><a class="text-muted" href="#">ATM Locator</a></li>
                <li class="list-inline-item"><a class="text-muted" href="#">Contact Us</a></li>
            </ul>
        </footer>

        
    </div>
</body>
</html>
