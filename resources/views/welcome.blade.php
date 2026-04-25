<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Auto 2000 Juanda</title>
    
    <link rel="icon" type="image/png" href="{{ asset('toyotaaa.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --toyota-red: #EB0A1E;
            --dark-text: #1a1a1a;
            --gray-text: #6c757d;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: var(--dark-text);
            overflow-x: hidden;
        }

        /* Navbar Styling */
        .navbar {
            padding: 1rem 0;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--dark-text) !important;
            letter-spacing: -0.5px;
            font-size: 1.2rem;
        }

        .brand-red {
            color: var(--toyota-red);
        }

        /* Hero Section */
        .hero-section {
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.15rem;
            color: var(--gray-text);
            font-weight: 400;
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Buttons */
        .btn-toyota {
            background-color: var(--toyota-red);
            color: white;
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 2px solid var(--toyota-red);
        }

        .btn-toyota:hover {
            background-color: #c90819;
            border-color: #c90819;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(235, 10, 30, 0.2);
        }

        .btn-outline-toyota {
            background-color: transparent;
            color: var(--dark-text);
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            border: 2px solid #e5e5e5;
            transition: all 0.3s ease;
        }

        .btn-outline-toyota:hover {
            border-color: var(--dark-text);
            background-color: var(--dark-text);
            color: white;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            
            <a class="navbar-brand d-flex align-items-center gap-3" href="/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Toyota.svg" alt="Logo Toyota" height="45">
                <div class="d-flex flex-column justify-content-center">
                    <span style="line-height: 1.1;">AUTO <span class="brand-red">2000</span></span>
                    <span class="text-muted" style="font-size: 0.65rem; font-weight: 600; letter-spacing: 1.5px; margin-top: 2px;">CABANG JUANDA</span>
                </div>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1 text-dark"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3 mt-3 mt-lg-0">
                    
                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-medium text-dark" href="{{ route('register') }}">
                                Register
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-toyota w-100 px-4" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <span class="nav-link fw-medium text-secondary">
                                Halo, <strong class="text-dark">{{ Auth::user()->name }}</strong>
                            </span>
                        </li>
                        <li class="nav-item">
                            @if(Auth::user()->role == 'admin')
                                <a class="btn btn-outline-toyota w-100 px-4" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            @elseif(Auth::user()->role == 'sales')
                                <a class="btn btn-outline-toyota w-100 px-4" href="/sales/dashboard">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            @else
                                <a class="btn btn-outline-toyota w-100 px-4" href="{{ route('user.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="m-0 w-100">
                                @csrf
                                <button type="submit" class="btn btn-light border w-100 text-danger fw-semibold" style="border-radius: 50px;">
                                    <i class="bi bi-power"></i> Keluar
                                </button>
                            </form>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container hero-content">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 bg-white border rounded-pill shadow-sm mb-4" style="font-size: 0.85rem; font-weight: 600;">
                        <span class="badge rounded-pill" style="background-color: var(--toyota-red);">NEW</span>
                        <span class="text-secondary">Portal Sistem Informasi Terpadu</span>
                    </div>

                    <h1 class="hero-title">
                        Mobilitas Terbaik Bersama <br>
                        <span style="color: var(--toyota-red);">Auto 2000 Juanda.</span>
                    </h1>
                    
                    <p class="hero-subtitle">
                        Urusan Toyota lebih mudah. Kelola inventaris armada, data penjualan, hingga pelayanan pelanggan dalam satu pintu digital yang cepat dan terintegrasi.
                    </p>

                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-toyota btn-lg px-5">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-toyota btn-lg px-5">
                                Register
                            </a>
                        @else
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-hero').submit();" class="btn btn-outline-toyota btn-lg">
                                <i class="bi bi-power me-2"></i> Keluar dari Sistem
                            </a>
                            <form id="logout-form-hero" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white py-4 border-top text-center text-muted small">
        <div class="container">
            &copy; {{ date('Y') }} PT. Toyota Astra Motor. Keseluruhan hak cipta Auto 2000 Juanda.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>