<!doctype html>
@php
    use App\Settings\SystemSettings;
    $systemSettings = app(SystemSettings::class);
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-theme="{{ settings('system.theme') }}"
      style="font-family: {{ settings('system.font') }}"> {{-- 🔹 new --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Parking') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/fav.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

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

    {{-- 🔹 new: динамическая тема --}}
    <style id="dynamic-font">
        /* 🔹 динамическая подстановка шрифта из настроек */
        :root {
            --font-family: '{{ settings('system.font') }}', sans-serif;
            --font-size: {{ settings('system.font_size', '16px') }};
        }

        /* 🌞 Светлая тема (мягкая, не ярко-белая) */
        :root[data-theme="light"] {
            --bg-color: #f4f5f7;            /* мягкий серовато-белый фон */
            --text-color: #1c1e21;          /* мягкий тёмно-серый текст */
            --navbar-bg: #ffffff;           /* белая навигация */
            --secondary-bg: #e7e9ed;        /* светло-серый фон карточек */
            --primary-color: #0d6efd;       /* стандартный синий Bootstrap */
            --border-color: #d4d6da;        /* нежный серый для границ */
        }

        /* 🌙 Тёмная тема (твоя текущая, дефолтная) */
        :root[data-theme="dark"] {
            --bg-color: #191c24;
            --text-color: #dee2e6;
            --navbar-bg: #20232d;
            --secondary-bg: #2c303a;
            --primary-color: #009cff;
            --border-color: #3b3f48;
        }

        /* Общие стили */
        body, input, button, select, textarea {
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .bg-secondary {
            background-color: var(--secondary-bg) !important;
            border-color: var(--border-color) !important;
        }

        .navbar, .sidebar {
            background-color: var(--navbar-bg) !important;
            transition: background-color 0.3s ease;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .card, .modal-content, .dropdown-menu {
            background-color: var(--secondary-bg);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        h1, h2, h3, h4, h5, h6, p, span, label, a {
            color: var(--text-color) !important;
        }

        body, input, button, select, textarea, h1, h2, h3, h4, h5, h6, p, span, label, a {
            font-family: var(--font-family) !important;
            /*font-family: "Times New Roman" !important;*/
            font-size: var(--font-size) !important;
        }
    </style>

</head>

<body class="{{ app(SystemSettings::class)->theme }}">

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
        .navbar-main-submenu{
            display:flex;
            flex-direction:row;
            width:100%;
            padding-left:0;
            margin-bottom:0;
            list-style:none;
            justify-content: space-between;
            margin-top: -20px;
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
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item">
                            @guest
                                @if (Route::has('login'))
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
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <img class="rounded-circle me-lg-2" src="{{ asset('images/user.jpg') }}"
                                         alt="photo" style="width: 40px; height: 40px;">
                                    <span class="d-none d-lg-inline-flex">{{ ucwords(Auth::user()->username) }}</span>
                                </a>
                            @endguest
                            <div
                                class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <span class="dropdown-item">{{ Auth::user()->username }}</span>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="dropdown-item">{{ __('Выход') }}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- 🔹 здесь контент --}}
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

{{-- 🔹 JS для моментального переключения темы --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Тема из Laravel Settings
        const backendTheme = "{{ settings('system.theme') }}";
        const storedTheme = localStorage.getItem("theme");

        // Если тема из localStorage отличается от базы — обновляем localStorage
        if (!storedTheme || storedTheme !== backendTheme) {
            localStorage.setItem("theme", backendTheme);
        }

        // Применяем актуальную тему
        document.documentElement.setAttribute("data-theme", backendTheme);

        // Переключатель темы (если хочешь временно менять вручную)
        const toggle = document.getElementById("theme-toggle");
        if (toggle) {
            toggle.addEventListener("click", function () {
                const current = document.documentElement.getAttribute("data-theme");
                const next = current === "dark" ? "light" : "dark";

                document.documentElement.setAttribute("data-theme", next);
                localStorage.setItem("theme", next);
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>
