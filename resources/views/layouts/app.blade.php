<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Parking') }}</title>
    <link rel="shortcut icon" href="{{asset('images/fav.ico')}}" type="image/x-icon">
    <!-- Google Web Fonts -->
    <link href="{{ asset('css/roboto-font-family.css') }}" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('css/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tempusdominus/tempusdominus-bootstrap-4.css') }}" rel="stylesheet"/>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!--Date Time Range-->
    <link rel="stylesheet" href="{{ asset('css/vanilla-datetimerange-picker.css') }}">

</head>
<body>

<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner"
         class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Загружается...</span>
        </div>
    </div>
    @include('layouts.menu')
    <style>
        .navbar-main-submenu {
            display: flex;
            flex-direction: row;
            width: 100%;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
            justify-content: space-between;
            margin-top: -20px;
        }

        /* 🔴 Кастомная стилизация кнопки "Шлагбаумы" */
        .btn-barriers {
            background-color: #dc3545 !important; /* красный */
            color: #fff !important;
            border: none;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
            box-shadow: 0 0 4px rgba(255, 0, 0, 0.3);
        }

        .btn-barriers:hover,
        .btn-barriers:focus {
            background-color: #c82333 !important; /* тёмно-красный при hover */
            color: #fff !important;
            box-shadow: 0 0 8px rgba(255, 0, 0, 0.5);
            transform: translateY(-1px);
        }

        .btn-barriers i {
            margin-right: 6px;
        }
    </style>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{ asset('images/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{ asset('images/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{ asset('images/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div> --}}
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div> --}}
                     {{-- 🔴 Кнопка "Шлагбаумы" слева от аватарки --}}
                    @can('Просмотр шлагбаумов')
                        <a href="{{ route('barriers.index') }}"
                        class="btn btn-sm btn-barriers me-3 d-flex align-items-center">
                            <i class="fa fa-door-open"></i>
                            <span>Экстренно</span>
                        </a>
                    @endcan
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item">

                            @guest
                                @if (\Illuminate\Support\Facades\Route::has('login'))
                                    <span class="d-none d-lg-inline-flex">
                                        <a class="nav-link" href="{{ route('login') }}">
                                            {{ __('Вход') }}
                                        </a>
                                    </span>
                                @endif
                            @endguest
                        </div>
                        <div class="nav-item dropdown">
                            @guest
                            @else
                                <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">
                                    <img class="rounded-circle me-lg-2" src="{{ asset('images/user.jpg') }}"
                                         alt="photo" style="width: 40px; height: 40px;">
                                    <span class="d-none d-lg-inline-flex">{{ ucwords(\Illuminate\Support\Facades\Auth::user()->username) }}</span>
                                </a>
                            @endguest
                            <div
                                class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <span class="dropdown-item">{{ \Illuminate\Support\Facades\Auth::user()->username }}</span>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="dropdown-item">{{ __('Выход') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>
            @yield('subtitle')

            @yield('content')
        </div>
    </div>
</div>

<!-- JavaScript Libraries -->
<script src="{{ asset('/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/js/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('/js/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('/js/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('/js/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/js/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('/js/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('/js/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script>
@stack('scripts')
</body>
</html>
