<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">
    <meta name="generator" content="PHPStorm 2018.2.5">
    <meta name="author" content="Mohammed A. Moharram">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <!-- Place favicon.ico in the root directory -->

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body>

    <div id="app">

        <div class="wrapper">

            <div class="sidebar">

                <div class="sidebar-header">
                    <h3><a href="{{ route('admin.home') }}">Admin Panel</a></h3>
                </div><!-- .sidebar-header -->

                <div class="sidebar-nav">

                    <div class="nav-section">
                        <h5 class="nav-section-title mb-2">Main</h5>
                        <ul>
                            <li class="{{ (Route::is('admin.home')) ? 'active' : '' }}"><a href="{{ route('admin.home') }}"><i class="fas fa-tachometer-alt fa-fw"></i>Dashboard</a></li>
{{--                            <li class="{{ (Route::is('admin.users.index')) ? 'active' : '' }}">--}}
{{--                                <a href="#alumniSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-graduation-cap fa-fw"></i>Users</a>--}}
{{--                                <ul class="collapse" id="alumniSubmenu">--}}
{{--                                    <li><a href="#">All Users</a></li>--}}
{{--                                    <li><a href="#">Add User</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                        </ul>
                    </div><!-- .nav-section -->

                    <div class="nav-section">
                        <h5 class="nav-section-title mb-2">System</h5>
                        <ul>
                            <li class="{{ (Route::is('admin.users.index')) ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}"><i class="fas fa-users fa-fw"></i>Users</a></li>
                            <li class="{{ (Route::is('admin.roles.index')) ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}"><i class="fas fa-theater-masks fa-fw"></i>Roles</a></li>
                            <li class="{{ (Route::is('admin.permissions.index')) ? 'active' : '' }}"><a href="{{ route('admin.permissions.index') }}"><i class="fas fa-key fa-fw"></i>Permissions</a></li>
                        </ul>
                    </div><!-- .nav-section -->

                </div><!-- .sidebar-nav -->

            </div><!-- .sidebar -->

            <div class="contents">

                <nav class="navbar navbar-expand-lg navbar-light main-nav">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Home</a>--}}
{{--                            </li>--}}
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                @if (config('auth.allow_registrations'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img class="profile-pic" src="{{ asset('img/profiles/me.jpg') }}" alt="Picture">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('admin.home') }}">
                                            Dashboard
                                        </a>

                                        <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                            Users
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div><!-- .navbar-collapse -->

                </nav>

                <div class="content-wrapper">
                    @yield('content')
                </div><!-- .content-wrapper -->

            </div><!-- .contents -->

        </div><!-- .wrapper -->

        <div class="admin-footer">
            <p class="text-center">&copy; 2019. All rights reserved.</p>
        </div><!-- .footer -->

    </div><!-- #app -->

    <script src="{{ asset('js/admin.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('div.sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

    @yield('scripts')

</body>
</html>
