<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JT Manager')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <!-- MDBootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/5.1.0/css/mdb.min.css" rel="stylesheet">
    
    <style>
        body { background: #f5f5f5; }
        .primary-color { background: #1C2331 !important; }
        .primary-color-dark { background: #0f1624 !important; }
        .secondary-color { background: #4285F4 !important; }
        .white-text { color: #fff !important; }
        .mdb-color { background: #1C2331 !important; }
        .mdb-color.lighten-4 { background: #e0e0e0 !important; }
        .warning-color { background: #FF8800 !important; }
        .danger-color { background: #ff3547 !important; }
        .info-color { background: #33b5e5 !important; }
        .card { border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .badge { font-size: 0.8rem; padding: 5px 10px; }
        .table th { background: #f8f9fa; }
        .btn-sm { padding: 5px 10px; }
        .md-form { margin-bottom: 1.5rem; }
        .md-form label { font-weight: 500; color: #555; }
        .md-form .form-control:focus { border-color: #4285F4; box-shadow: 0 0 0 2px rgba(66,133,244,0.2); }
        .alert { border-radius: 8px; }
        .card-header { border-radius: 10px 10px 0 0 !important; padding: 15px 20px; }
        .pagination { margin-top: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark primary-color">
        <div class="container">
            <a class="navbar-brand" href="{{ route('vitrine') }}">
                <i class="fas fa-tv"></i> JT Manager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vitrine') }}">
                            <i class="fas fa-globe"></i> Vitrine
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-chart-pie"></i> Dashboard
                            </a>
                        </li>
                        @if(in_array(Auth::user()->role, ['journaliste', 'admin']))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reportages.index') }}">
                                    <i class="fas fa-newspaper"></i> Reportages
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reportages.create') }}">
                                    <i class="fas fa-plus-circle"></i> Nouveau
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users') }}">
                                    <i class="fas fa-users-cog"></i> Utilisateurs
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                <span class="badge bg-light text-dark ms-1">
                                    @if(Auth::user()->role === 'admin') Admin
                                    @elseif(Auth::user()->role === 'journaliste') Journaliste
                                    @else Visiteur @endif
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Inscription
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- MDBootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/5.1.0/js/mdb.min.js"></script>
    
    <!-- jQuery (si nécessaire) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>