<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin: 0.25rem 0;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }
        .stats-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-2px);
        }
        .export-btn {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            border-radius: 25px;
        }
        .table-responsive {
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-light">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-3">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-user-shield text-white me-2 fs-4"></i>
                <h4 class="text-white mb-0">Admin Panel</h4>
            </div>

            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('admin.property-reports') ? 'active' : '' }}"
                   href="{{ route('admin.property-reports') }}">
                    <i class="fas fa-home me-2"></i>
                    Raporty Nieruchomości
                </a>
                <a class="nav-link {{ request()->routeIs('admin.offer-reports') ? 'active' : '' }}"
                   href="{{ route('admin.offer-reports') }}">
                    <i class="fas fa-tags me-2"></i>
                    Raporty Ofert
                </a>
                <a class="nav-link {{ request()->routeIs('admin.user-reports') ? 'active' : '' }}"
                   href="{{ route('admin.user-reports') }}">
                    <i class="fas fa-users me-2"></i>
                    Raporty Użytkowników
                </a>
                <a class="nav-link {{ request()->routeIs('admin.transaction-reports') ? 'active' : '' }}"
                   href="{{ route('admin.transaction-reports') }}">
                    <i class="fas fa-exchange-alt me-2"></i>
                    Raporty Transakcji
                </a>
                <a class="nav-link {{ request()->routeIs('admin.advanced-reports') ? 'active' : '' }}"
                   href="{{ route('admin.advanced-reports') }}">
                    <i class="fas fa-chart-line me-2"></i>
                    Zaawansowane Raporty
                </a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">@yield('page-title')</h1>
                <div>
                    <span class="text-muted">Witaj, {{ auth()->user()->first_name }}</span>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm ms-2"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Wyloguj
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</body>
</html>
