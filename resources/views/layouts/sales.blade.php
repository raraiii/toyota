<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Connect - Sales Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --toyota-red: #EB0A1E;
            --sidebar-width: 280px;
        }

        body {
            background-color: #f8fafc;
            overflow-x: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- SIDEBAR STYLING --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--toyota-red);
            color: white;
            z-index: 1060;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border: none;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-brand {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 30px;
            letter-spacing: -1px;
        }

        /* Profile Section in Sidebar - Cleaner & Rounded */
        .sidebar-profile {
            padding: 20px 30px 30px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile-img-sidebar {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 50%; /* Bulat Sempurna */
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .profile-info h6 {
            font-size: 15px;
            margin: 0;
            font-weight: 700;
            color: white;
        }

        .profile-info span {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 15px;
            margin-top: 10px;
            flex-grow: 1;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.6); /* Teks sedikit redup agar tidak kaku */
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 14px;
            border-radius: 12px;
        }

        /* State Active & Hover: Warna Sidebar Tetap Sama, Hanya Teks/Icon Putih Terang */
        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* --- MAIN CONTENT & NAVBAR --- */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .header-admin {
            background-color: white;
            height: 70px;
            position: sticky;
            top: 0;
            z-index: 1040;
            border-bottom: 1px solid #edf2f7;
        }

        .brand-text-navbar {
            font-weight: 800;
            color: var(--toyota-red);
            letter-spacing: 0.5px;
            margin-left: 15px;
            text-transform: uppercase;
        }

        #sidebarOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            z-index: 1050;
            display: none;
            backdrop-filter: blur(2px);
        }

        .dropdown-menu {
            border-radius: 12px;
            padding: 8px;
            border: 1px solid #edf2f7;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .sidebar.mobile-show { transform: translateX(0); }
        }
    </style>
</head>
<body>

    <div id="sidebarOverlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <span class="fw-extrabold fs-4 text-white">TOYOTA <span class="fw-light">CONNECT</span></span>
        </div>

        <div class="sidebar-profile">
            <img src="{{ auth()->user()->foto ? asset('storage/'.auth()->user()->foto) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=fff&color=EB0A1E' }}" 
                 class="profile-img-sidebar" alt="Avatar">
            <div class="profile-info">
                <h6>{{ auth()->user()->name }}</h6>
                <span>Official Sales</span>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('sales.dashboard') }}" class="{{ request()->routeIs('sales.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('sales.mobil.index') }}" class="{{ request()->routeIs('sales.mobil.*') ? 'active' : '' }}">
                    <i class="bi bi-car-front-fill"></i> Kelola Unit
                </a>
            </li>
            <li>
                <a href="{{ route('sales.profil.index') }}" class="{{ request()->routeIs('sales.profil.*') ? 'active' : '' }}">
                    <i class="bi bi-person-fill"></i> Profil Saya
                </a>
            </li>
        </ul>

        <div class="px-4 pb-4" style="font-size: 10px; color: rgba(255,255,255,0.4); font-weight: 600;">
            V 1.0.4 • 2026
        </div>
    </aside>

    <div class="main-content" id="mainContent">
        
        <header class="header-admin d-flex align-items-center">
            <div class="container-fluid px-4 d-flex justify-content-between align-items-center h-100">
                
                <div class="d-flex align-items-center">
                    <button id="sidebarToggle" class="btn p-0 border-0 fs-4" style="color: #64748b;">
                        <i class="bi bi-text-indent-left"></i>
                    </button>
                    <span class="brand-text-navbar d-none d-sm-block fs-6">Auto 2000 Juanda</span>
                </div>

                <div class="dropdown">
                    <button class="btn border-0 d-flex align-items-center gap-2 fw-bold text-dark" type="button" data-bs-toggle="dropdown">
                        <span>{{ auth()->user()->name }}</span>
                        <i class="bi bi-chevron-down text-muted" style="font-size: 10px;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                        <li>
                            <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-power"></i> Keluar Aplikasi
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="container-fluid p-4">
            @yield('content')
        </main>
        
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");
            const overlay = document.getElementById("sidebarOverlay");

            function isMobile() { return window.innerWidth < 992; }

            sidebarToggle.addEventListener("click", function() {
                if (isMobile()) {
                    sidebar.classList.toggle("mobile-show");
                    overlay.style.display = sidebar.classList.contains("mobile-show") ? "block" : "none";
                } else {
                    sidebar.classList.toggle("collapsed");
                    mainContent.classList.toggle("expanded");
                    // Change icon based on state
                    const icon = sidebarToggle.querySelector('i');
                    if(sidebar.classList.contains('collapsed')) {
                        icon.classList.replace('bi-text-indent-left', 'bi-text-indent-right');
                    } else {
                        icon.classList.replace('bi-text-indent-right', 'bi-text-indent-left');
                    }
                }
            });

            overlay.addEventListener("click", function() {
                sidebar.classList.remove("mobile-show");
                overlay.style.display = "none";
            });
        });
    </script>
</body>
</html>