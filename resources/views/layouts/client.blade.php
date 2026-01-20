<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Client Panel - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    
    <!-- Bootstrap Table CSS -->
    <link href="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.css" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4fff7;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(145deg, #a8f0c6, #72d89c);
            background: linear-gradient(145deg, #003e1a, #003315);
            color: #fff;
            position: fixed;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar .nav-link {
            color: #ffffffcc;
            padding: 12px 20px;
            transition: background 0.3s, color 0.3s;
            font-weight: 500;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #ffffff;
            color: #fff;
        }

        .sidebar-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar-logo img {
            max-width: 140px;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e0f5e9;
        }

        .navbar-text {
            font-weight: 600;
            color: #28a745;
        }

        .dropdown-menu {
            border-color: #d4edda;
        }

        .btn-primary {
            /* background-color: #-28a745; */
            border-color: #28a745;
        }

        /* .btn-primary:hover {
            background-color: #218838;
        } */

        .card {
            border: 1px solid #cdeed8;
            border-radius: 10px;
        }

        .card-header {
            background-color: #a6eecb;
            border-bottom: 1px solid #cdeed8;
        }

        .fixed-table-toolbar .btn-secondary{
            background-color: rgb(0, 125, 234) !important;
            border: 1px solid white;
        }
    </style>

    @yield('styles')
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('images/client-logo.svg') }}" alt="Client Logo">
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}"
                       href="{{ route('client.dashboard') }}">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.projects') ? 'active' : '' }}"
                       href="{{ route('client.projects') }}">
                        <i class="fas fa-briefcase me-2"></i> Projects
                    </a>
                </li>
                <li class="nav-item mt-auto">
                    <!-- Logout form for sidebar -->
                    <form id="logout-form-sidebar" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link text-danger" href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content w-100">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg shadow-sm mb-4">
                <div class="container-fluid">
                    <span class="navbar-text">Client Panel</span>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ auth('client')->user()->company_name ?? 'Client' }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><hr class="dropdown-divider"></li>
                                <!-- Logout form for navbar dropdown -->
                                <form id="logout-form-dropdown" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form-dropdown').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>


    @yield('scripts')
</body>

</html>
