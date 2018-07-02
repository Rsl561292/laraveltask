<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ruslan Shyiovych">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('bootstrap/favicon.ico') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap Styles -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- My Styles -->
    <link href="{{ asset('css/global-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/site-style.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-top affix">
                <div class="container">
                    <a class="navbar-brand" href="{{ route("site.home") }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ \Illuminate\Support\Facades\URL::current() == route('site.home') ? 'active' : '' }}" href="{{route('site.home')}}">Home</a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link {{ \Illuminate\Support\Facades\URL::current() == route('site.articles') ? 'active' : '' }}" href="{{route('site.articles')}}">Articles</a>
                                </li>
                            @endauth
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Forms for login <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('auth.login_of_admin') }}">
                                        Login for Admin
                                    </a>
                                    <a class="dropdown-item" href="{{ route('auth.login_of_manager') }}">
                                        Login for Manager
                                    </a>
                                    <a class="dropdown-item" href="{{ route('auth.login_of_user') }}">
                                        Login for User
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('admin.site.index') }}">
                                            Adminka
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4">
            <div class="container">
                @php
                    $flashMessages = [];

                    if(Session::has('flash_message')) {
                        $flashMessages = Session::get('flash_message');
                    }
                @endphp

                @if(!empty($flashMessages))
                    @if($flashMessages['type'] == 'success')
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <h4>Message about success!</h4>
                            <p>{{ $flashMessages['message'] }}</p>
                        </div>
                    @else
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <h4>Message about error!</h4>
                            <p>{{ $flashMessages['message'] }}</p>
                        </div>
                    @endif
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
