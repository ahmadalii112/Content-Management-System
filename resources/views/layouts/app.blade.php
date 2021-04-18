<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('user.edit-profile') }}">
                                    {{ __('My Profile') }}
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

    <main class="py-4">


        {{--Only Authenticated user see this --}}
        @auth()
            <div class="container">
                @if(session()->has('Success'))
                    {{--                    <div class="alert alert-success">--}}
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('Success')}}
                    </div>
                @endif
                @if(session()->has('error'))
                    {{--                    <div class="alert alert-danger">--}}
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session()->get('error')}}
                    </div>
                @endif
                <div class="row">
                    <div class="col md-4">
                        <ul class="list-group w-75 ">

                            @if(auth()->user()->isAdmin())
                                <li class="list-group-item">
                                    <a href="{{route('user.index')}}">Users</a>
                                </li>
                            @endif

                            <li class="list-group-item">
                                <a href="{{route('posts.index')}}">Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('categories.index')}}">Category</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('subcategories.index')}}">Sub-Category</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('tags.index')}}">Tags</a>
                            </li>
                        </ul>
                        <ul class="list-group mt-5 w-75">
                            <li class="list-group-item">
                                <a href="{{route('trashed-post.index')}}">Trashed Posts</a>
                            </li>

                        </ul>

                    </div>
                    <div class="col md-8">
                        @yield('content')
                    </div>

                </div>
            </div>
        @else
            @yield('content')

        @endauth
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')


</body>
</html>
