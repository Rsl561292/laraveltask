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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

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
    <link href="{{ asset('css/modules/main2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modules/dashboard1.css') }}" rel="stylesheet">


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
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

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
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ \Illuminate\Support\Facades\URL::current() == route('admin.site.index') ? 'active' : '' }}" href="{{ route('admin.site.index') }}">
                                <i class="fa fa-home fa-fw" aria-hidden="true"></i> Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ stripos(\Illuminate\Support\Facades\URL::current(), route('articles.index')) !== false ? 'active' : '' }}" href="{{ route('articles.index') }}">
                                <i class="fa fa-clipboard fa-fw" aria-hidden="true"></i> Articles
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="content col-md-10 ml-sm-auto col-lg-10 px-4">
                <div class="block-title-page">
                    <div class="title-page">
                        <h2>@yield('titlePage')</h2>
                    </div>
                    @if(!empty($listButton))
                        <div class="list-btn">
                            @foreach($listButton as $button)
                                <a class="btn {{ $button['classBtnType'] }}" href="{{ route($button['nameRoute']) }}">{{ $button['btnTitle'] }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>

                @php
                    $flashMessages = [];

                    if(Session::has('flash_message')) {
                        $flashMessages = Session::get('flash_message');
                    }
                @endphp

                @if(!empty($flashMessages) && isset($flashMessages['message']))
                    @if(isset($flashMessages['type']) && $flashMessages['type'] == 'success')
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

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</div>
</body>
</html>
