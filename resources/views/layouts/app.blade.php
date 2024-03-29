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
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="extensions/sticky-header/bootstrap-table-sticky-header.css">

    

    <!-- Scripts -->
    @vite([ 'resources/sass/app.scss',
            'resources/js/app.js',
            'resources/js/views/vendor.js',
            'resources/js/views/apsipirkimas.js',
            ])

</head>
<body>
{{-- dd(Route::getCurrentRoute()) --}}    
@if ($errors->any())
    <div class="col-sm-12">
        <div class="alert  alert-warning alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <span><p>{{ $error }}</p></span>
            @endforeach
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
        </div>
    </div>
@endif

@if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
        </div>
    </div>
@endif

@if (session('error'))
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
        </div>
    </div>
@endif
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- config('app.name', 'Laravel') --}}
                    Shared Budget
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto" style="display:inline-block;">
                        <li class="nav-item" style="display:inline-block;">
                            @if(auth()->user() !== null)
                            @if(auth()->user()->friendshipRequestsTo->count() >0 )
                            <a class="nav-link" href="{{ route('friendshiprequest.show',[auth()->user()]) }}"><i class="fas fa-user-friends fa-spin"></i></a>
                            @else
                            <a class="nav-link" href="{{ route('friendshiprequest.show',[auth()->user()]) }}"><i class="fas fa-user-friends "></i></a>
                            @endif
                            @endif
                        </li>
                        <li class="nav-item" style="display:inline-block;">
                            @if(auth()->user() !== null)
                            @if(App\Models\Pakvietimas::all()->count() >0 )
                            <a class="nav-link" href="{{ route('pakvietimas.index',[auth()->user()])}}">
                            <i class="fa fa-link fa-spin" aria-hidden="true"></i></a>
                            @else
                            <a class="nav-link" href="{{ route('friendshiprequest.show',[auth()->user()]) }}">
                                <i class="fa fa-link" aria-hidden="true" ></i></a>
                            @endif
                            @endif
                        </li>
                        @can('role-view')
                          <li style="display:inline-block;">
                            <a href="{{route('role.index')}}" >' Roles '</a>
                          </li>
                        @endcan
                        @can(('budget-view-owner'))
                        <li style="display:inline-block;">
                            <a href="{{route('budget.index',['budgets' => auth()->user()->budgets])}}" >' Budgets '</a>
                          </li>
                        @endcan
                        @can(('category-view'))
                        <li style="display:inline-block;">
                            <a href="{{route('category.index',['budgets' => auth()->user()->budgets])}}" >' Categories '</a>
                          </li>
                        @endcan
                        @can(('vendor-view'))
                        <li style="display:inline-block;">
                            <a href="{{route('vendor.index',['budgets' => auth()->user()->budgets])}}" >' Vendors '</a>
                          </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-bell"></i></a>
                        </li>
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
                                <a 
                                    id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div >
                    <?php
                    try{ 
                     ?>{{Breadcrumbs::render()}}<?php
                    }catch(Exception $e){
                        echo 'Error';
                    } 
                    ?>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="extensions/sticky-header/bootstrap-table-sticky-header.js"></script>
  </body>
</html>