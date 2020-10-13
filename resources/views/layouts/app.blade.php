<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">
    <meta name="generator" content="PHPStorm 2018.2.5">
    <meta name="author" content="Mohammed A. Moharram">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google+ tags -->
    <meta itemscope itemtype="@yield('gp_type')">
    <meta itemprop="headline" content="@yield('title')">
    <meta itemprop="description" content="@yield('description')">
    <meta itemprop="image" content="@yield('gp_image_url', '')">

    <!-- Twitter tags -->
    <meta name="twitter:card" content="@yield('tw_card_type')">
    <meta name="twitter:site" content="">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('tw_image_url', '')">

    <!-- Facebook tags -->
    <meta property="og:title" content="@yield('title')">
    <meta property="og:site_name" content="">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:description" content="@yield('description')">
    <meta property="fb:app_id" content="">
    <meta property="fb:admins" content="">
    <meta property="og:type" content="@yield('og_type')">
    <meta property="og:locale" content="ar_AR">
    <meta property="og:image" content="@yield('og_image_url', '')">
    <meta property="og:image:type" content="@yield('og_image_type', 'image/jpg')">
    <meta property="og:image:width" content="@yield('og_image_width', 1200)">
    <meta property="og:image:height" content="@yield('og_image_height', 630)">

    @yield('tags')

    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <!-- Place favicon.ico in the root directory -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (config('auth.allow_registrations'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="float-left mr-2">
                                        @if(auth()->user()->profile_picture)
                                            <img class="profile-pic" src="{{ asset('storage/profiles') }}/{{ Auth::user()->profile_picture }}" alt="Profile Picture">
                                        @else
                                            <img class="profile-pic" src="{{ asset('storage/profiles/default.jpg') }}" alt="Profile Picture">
                                        @endif
                                    </div>
                                    <div class="float-left mr-2">
                                        <span>{{ Auth::user()->name }}</span>
                                        @if(auth()->user()->roles->count() >= 1)
                                            <span class="small text-muted d-block">{{ Auth::user()->roles[0]->name }}</span>
                                        @else
                                            <span class="small text-muted d-block">No role</span>
                                        @endif
                                    </div>
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->roles->count() >= 1 && auth()->user()->hasRole('Admin'))
                                    <a class="dropdown-item" href="{{ route('admin.home') }}">
                                        Dashboard
                                    </a>

                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                        Users
                                    </a>

                                    <div class="dropdown-divider"></div>
                                    @endif

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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');

    </script>

</body>
</html>
