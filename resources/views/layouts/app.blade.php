<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LABOON - Perpustakaan Digital</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #0077b6;
            --secondary: #00b4d8;
            --accent: #48cae4;
            --light: #caf0f8;
            --dark: #03045e;
            --text: #333;
            --light-text: #6c757d;
            --body-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text);
            background-color: var(--body-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Lora', serif;
        }
        
        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding-top: 18px !important;
            padding-bottom: 18px !important;
        }
        
        .navbar-brand {
            font-family: 'Lora', serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }
        
        .navbar-brand img {
            height: 70px !important;
            width: auto;
            margin-right: 18px;
            vertical-align: middle;
        }
        
        .navbar-brand span {
            vertical-align: middle;
            font-size: 2rem;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--text) !important;
            margin: 0 5px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .nav-link:focus {
            color: var(--primary) !important;
        }
        
        .nav-link.active {
            color: var(--primary) !important;
            font-weight: 600;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #006da8;
            border-color: #006da8;
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            color: var(--primary);
        }
        
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 8px 20px;
        }
        
        .table th {
            font-weight: 600;
            color: var(--dark);
        }
        
        .badge {
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 30px;
        }
        
        .badge-primary {
            background-color: var(--primary);
        }
        
        /* Footer */
        footer {
            background-color: white;
            color: var(--text);
            padding-top: 30px !important;
            padding-bottom: 30px !important;
            margin-top: auto;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .footer-logo {
            height: 90px !important;
            width: auto;
            margin-bottom: 18px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        
        footer h5, footer p {
            text-align: center;
        }
        
        /* Dashboard cards */
        .stat-card {
            border-radius: 12px;
            padding: 1.5rem;
            height: 100%;
        }
        
        .stat-card .icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        
        .stat-card.primary {
            background-color: var(--primary);
            color: white;
        }
        
        .stat-card.secondary {
            background-color: var(--secondary);
            color: white;
        }
        
        /* Tables */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table th {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        /* Layout */
        main {
            flex: 1;
        }
        
        .page-header {
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary);
        }
        
        .section-header {
            border-bottom: 2px solid var(--light);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }
    </style>
    @stack('scripts')
    @yield('scripts')
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('logo/Laboon.png') }}" alt="Logo Perpustakaan">
                    <span class="fw-bold">LABOON</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('books.index') }}">Kelola Buku</a>
                                </li>
                            @elseif(Auth::user()->role === 'user')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('peminjaman.index') }}">Peminjaman</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.books.index') }}">Daftar Buku</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item me-2">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>{{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->nama }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i>{{ __('Logout') }}
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
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
        
        <footer class="bg-white">
            <div class="container">
                <div class="row py-3">
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('logo/Laboon.png') }}" alt="Logo Perpustakaan" class="footer-logo">
                        <h5 class="fw-bold d-inline-block">LABOON</h5>
                        <p class="mb-0 mt-2">Sistem Manajemen Perpustakaan Digital</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
