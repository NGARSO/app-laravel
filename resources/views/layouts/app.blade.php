<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"%3E%3Cpath fill="%23f3f4f6" fill-opacity="0.1" d="M0,64L48,80C96,96,192,128,288,128C384,128,480,96,576,85.3C672,75,768,85,864,74.7C960,64,1056,32,1152,32C1248,32,1344,64,1392,80L1440,96V320H0V96Z"%3E%3C/path%3E%3C/svg%3E') repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #1D3461; /* Theme color */
            color: #ffffff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            transition: width 0.3s;
        }
        .sidebar h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .sidebar .nav-link {
            color: #ffffff;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #224c7d; /* Darker shade for hover effect */
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .navbar {
            background-color: #1D3461; /* Theme color */
            color: #ffffff;
            padding: 10px 20px;
            border-bottom: 1px solid #224c7d; /* Darker shade for border */
        }
        .navbar .dropdown-menu {
            background-color: #1D3461; /* Theme color */
        }
        .navbar .dropdown-item {
            color: #ffffff;
        }
        .navbar .dropdown-item:hover {
            background-color: #224c7d; /* Darker shade for hover */
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        footer {
            background-color: #1D3461; /* Theme color */
            color: white;
            padding: 10px 0;
        }
        .btn-primary {
            background-color: #1D3461; /* Theme color */
            border-color: #1D3461;
            color: #ffffff;
        }
        .btn-primary:hover {
            background-color: #224c7d; /* Darker shade for hover */
            border-color: #224c7d;
        }
    </style>
</head>
<body class="d-flex min-vh-100">
    <div class="sidebar d-flex flex-column p-4">
        <h3 class="text-uppercase">Menu</h3>
        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home mr-2"></i> Home
            </a>

            @if (Auth::user()->isAdmin())
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-users mr-2"></i> Utilisateurs
                </a>
                <a href="{{ route('notifications.index') }}" class="nav-link {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                    <i class="fas fa-bell mr-2"></i> Notifications
                </a>
                <a href="{{ route('rooms.index') }}" class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                    <i class="fas fa-door-open mr-2"></i> Classes
                </a>
                <a href="{{ route('courses.index') }}" class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                    <i class="fas fa-book mr-2"></i> Cours
                </a>
                <a href="{{ route('attendances.index') }}" class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-check mr-2"></i> Présences
                </a>
            @elseif (Auth::user()->isManager())
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('rooms.index') }}" class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                    <i class="fas fa-door-open mr-2"></i> Classes
                </a>
                <a href="{{ route('courses.index') }}" class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                    <i class="fas fa-book mr-2"></i> Cours
                </a>
            @elseif (Auth::user()->isProfessor())
                <a href="{{ route('attendances.index') }}" class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-check mr-2"></i> Présences
                </a>
            @endif
        </nav>
    </div>

    <div class="content w-100">
        <nav class="navbar w-100">
            <div class="d-flex justify-content-between w-100">
                <div>
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
                <div class="d-flex align-items-center">
                    <!-- <div class="dropdown mr-3">
                        <button class="btn btn-link text-light dropdown-toggle" type="button" id="tabDropdown" data-toggle="dropdown">
                            Utilisateurs
                        </button>
                        <div class="dropdown-menu" aria-labelledby="tabDropdown">
                            <a class="dropdown-item" href="{{ route('users.index') }}">Utilisateurs</a>
                            <a class="dropdown-item" href="#">Demandes</a>
                        </div>
                    </div> -->
                    <div class="dropdown">
                        <button class="btn btn-link text-light dropdown-toggle" type="button" id="userMenu" data-toggle="dropdown">
                            <img src="https://via.placeholder.com/30" alt="User" class="rounded-circle mr-2"> {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
                            <a class="dropdown-item" href="#">Profil</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1">
            <div class="m-3">
               
                    {{ $slot }}
               
            </div>
        </main>

        <footer class="text-center">
            © {{ date('Y') }} - Mon Application Laravel
        </footer>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>