<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Connect - Auto 2000 Juanda</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root { --toyota-red: #EB0A1E; }
        body { 
            background-color: #f8fafc; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
        }
        /* NAVBAR MERAH FULL */
        .navbar { 
            background-color: var(--toyota-red) !important; 
            padding: 18px 0;
            box-shadow: 0 4px 12px rgba(235, 10, 30, 0.15);
        }
        .navbar-brand span { color: white !important; letter-spacing: -1px; }
        .nav-link { 
            color: rgba(255, 255, 255, 0.8) !important; 
            font-weight: 600; 
            font-size: 15px;
            transition: 0.3s;
            padding: 8px 20px !important;
        }
        .nav-link:hover, .nav-link.active { 
            color: white !important; 
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
        }
        .btn-logout {
            background: white;
            color: var(--toyota-red) !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 8px 20px !important;
            border: none;
        }
        footer { background: #fff; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('user.dashboard') }}">
                <span class="fw-extrabold fs-4">TOYOTA <span class="fw-light">CONNECT</span></span>
            </a>
            
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#katalog">Katalog Unit</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-sm-block text-white me-2">
                        <small class="opacity-75 d-block" style="font-size: 10px;">USER CLIENT</small>
                        <span class="fw-bold small">{{ auth()->user()->name }}</span>
                    </div>
                    <a href="#" class="btn btn-logout shadow-sm" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        KELUAR <i class="bi bi-power ms-1"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>
    </nav>

    <main style="min-height: 80vh">
        @yield('content')
    </main>

    <footer class="py-5 mt-5">
        <div class="container text-center">
            
            <p class="small text-secondary">&copy; 2026 Toyota Connect Juanda. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>