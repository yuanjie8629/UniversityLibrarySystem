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

    {{-- To import icon for Vue component --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="wrapper">
            <div class="sidebar">
                <h2>Utar Library Management System</h2>
                <ul>
                    <li><a href="/manage-books">Manage books</a></li>
                    <li><a href="/manage-users">Manage users</a></li>
                    <li><a href="/manage-borrows">Manage borrows</a></li>
                </ul>
            </div>
            <div class="right-view">
                <div class="row">
                    <div class="col">
                        <div>
                            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                                <div class="container">
                                    {{-- <a class="navbar-brand" href="{{ url('/') }}">
                                    {{ config('app.name', 'Laravel') }}
                                    </a> --}}
                                    <a class="navbar-brand">
                                        Welcome to Admin Dashboard
                                    </a>
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
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                            @endif

                                            @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                            @endif
                                            @else
                                            <li class="nav-item dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }}
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        text-decoration: none;
    }

    .wrapper {
        display: flex;
        position: relative;
    }

    .wrapper .sidebar {
        position: fixed;
        width: 250px;
        height: 100%;
        background: #fff;
        padding: 30px 0;
        -webkit-box-shadow: 6px 2px 5px 0px rgba(240, 240, 240, 1);
        -moz-box-shadow: 6px 2px 5px 0px rgba(240, 240, 240, 1);
        box-shadow: 6px 2px 5px 0px rgba(240, 240, 240, 1);
        z-index: 10;
    }

    .wrapper .sidebar h2 {
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    .wrapper .sidebar ul li {
        padding: 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-top: 1px solid rgba(225, 225, 225, 0.05);
    }

    .wrapper .sidebar ul li a {
        display: block;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        text-decoration: none;
        color: #000;
    }

    .wrapper .sidebar ul li:hover {
        background: #EAEAEA;
    }

    .wrapper .right-view {
        width: 100%;
        margin-left: 250px;
    }
</style>