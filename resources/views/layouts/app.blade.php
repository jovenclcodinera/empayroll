<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tooltipster@4.2.8/dist/css/tooltipster.bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tooltipster@4.2.8/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css">
    <link rel="stylesheet" href="{{asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/adminlte.min.css')}}">
    <style>
        :root {
            --primary: #e2f3f5;
            --secondary: #22d1ee;
            --tertiary: #3d5af1;
            --quaternary: #0e153a;
        }

        .content-wrapper {
            background-color: var(--quaternary);
        }

        .nav-link.active {
            background-color: var(--secondary) !important;
        }

        .form-control:focus {
            border-color: var(--tertiary);
        }

        .modal-header {
            background-color: var(--tertiary);
        }

        .modal-title {
            color: var(--primary);
        }

        .card-header {
        background-color: var(--tertiary);
        color: var(--primary);
        }

        .button {
            background-color: var(--secondary);
            color: var(--primary);
        }
    </style>
    @yield('styles')
</head>
<body class="@guest sidebar-collapse @endguest">
    <div class="sidebar-mini" id="app">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </li>
                    @endauth
                </ul>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
            </nav>

            @auth
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <div class="sidebar">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                @if(in_array(auth()->user()->role, ['Tester', 'Admin']))
                                    <li class="nav-item">
                                        <a href="{{route('dashboard')}}"
                                            class="nav-link @if(Route::is('dashboard')) active @endif">
                                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                            <p>Dashboard</p>
                                        </a>
                                    </li>
                                @endif
                                @if(in_array(auth()->user()->role, ['Tester', 'Admin', 'Unassigned']))
                                    <li class="nav-item">
                                        <a href="{{route('departments.index')}}"
                                            class="nav-link @if(Route::is('departments.index')) active @endif">
                                            <i class="nav-icon far fa-building"></i>
                                            <p>Departments</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('roles.index')}}"
                                            class="nav-link @if(Route::is('roles.index')) active @endif">
                                            <i class="nav-icon fas fa-user-tag"></i>
                                            <p>Roles</p>
                                        </a>
                                    </li>
                                @endif
                                @if(in_array(auth()->user()->role, ['Tester', 'Admin']))
                                    <li class="nav-item">
                                        <a href="{{route('employees.index')}}"
                                            class="nav-link @if(Route::is('employees.index')) active @endif">
                                            <i class="nav-icon fas fa-user-tie"></i>
                                            <p>Employees</p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{route('profile.index')}}"
                                        class="nav-link @if(Route::is('profile.index')) active @endif">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
            @endauth

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-12 text-center">
                                @yield('header_title')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('vendor/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tooltipster@4.2.8/dist/js/tooltipster.bundle.min.js"></script>
    <script src="{{asset('vendor/adminlte/dist/js/adminlte.min.js')}}"></script>
    <script type="text/javascript">
        $('.select2').select2();
        $('[data-toggle="tooltip"]').tooltipster({
            theme: 'tooltipster-borderless'
        });
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if(session()->has('alert'))
            Toast.fire({
                icon: "{{session()->get('alert')['type']}}",
                title: "{{session()->get('alert')['message']}}"
            });
        @endif
    </script>
    @yield('scripts')
</body>
</html>
