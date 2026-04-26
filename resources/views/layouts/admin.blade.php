<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Toyota Auto 2000</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --toyota-red: #EB0A1E; /* Warna merah khas Toyota */
            --sidebar-width: 260px;
        }

        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
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
            transition: transform 0.3s ease-in-out; /* Transisi smooth */
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        /* Class khusus jika sidebar ditutup (Desktop) */
        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin-top: 1rem;
            flex-grow: 1;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.2s;
            font-weight: 500;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        /* --- MAIN CONTENT & NAVBAR --- */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out; /* Transisi agar konten bergeser smooth */
            display: flex;
            flex-direction: column;
        }

        /* Class khusus jika konten meluas (Desktop) */
        .main-content.expanded {
            margin-left: 0;
        }

        .header-admin {
            background-color: white;
            height: 70px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1040;
        }

        .brand-text-navbar {
            font-weight: 700;
            color: var(--toyota-red);
            letter-spacing: 0.5px;
            margin-left: 15px;
        }

        /* --- OVERLAY UNTUK MOBILE --- */
        #sidebarOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1050;
            display: none;
            backdrop-filter: blur(2px);
        }

        /* --- RESPONSIVE MOBILE --- */
        @media (max-width: 991.98px) {
            /* Default di mobile: sidebar tersembunyi */
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
            
            /* Class saat tombol diklik di mobile */
            .sidebar.mobile-show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>

    <div id="sidebarOverlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <span class="fw-bold fs-5 text-white">PANEL ADMIN</span>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.sales.index') }}" class="{{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">
                    <i class="bi bi-person-plus-fill"></i> Akun Sales
                </a>
            </li>
           
        </ul>

        <div class="sidebar-footer text-center w-100 pb-3" style="font-size: 11px; color: rgba(255,255,255,0.6);">
            &copy; 2026 Toyota Auto 2000
        </div>
    </aside>

    <div class="main-content" id="mainContent">
        
        <header class="header-admin d-flex align-items-center">
            <div class="container-fluid px-4 d-flex justify-content-between align-items-center h-100">
                
                <div class="d-flex align-items-center">
                    <button id="sidebarToggle" class="btn p-0 border-0 fs-3" style="color: var(--toyota-red);">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="brand-text-navbar d-none d-sm-block fs-5">Toyota Auto 2000 Juanda</span>
                </div>

                <div class="dropdown">
                    <button class="btn border-0 d-flex align-items-center gap-2 fw-bold" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5 text-secondary"></i>
                        <span class="text-dark d-none d-md-inline">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</span>
                        <i class="bi bi-chevron-down text-muted" style="font-size: 12px;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2" style="border-radius: 10px; min-width: 180px;">
                        <li>
                            <a class="dropdown-item text-danger fw-bold py-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="container-fluid p-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </main>
        
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");
            const overlay = document.getElementById("sidebarOverlay");

            // Cek apakah user menggunakan perangkat mobile (lebar layar < 992px)
            function isMobile() {
                return window.innerWidth < 992;
            }

            // Fungsi ketika tombol Hamburger diklik
            sidebarToggle.addEventListener("click", function() {
                if (isMobile()) {
                    // Logika untuk Mobile
                    sidebar.classList.toggle("mobile-show");
                    if (sidebar.classList.contains("mobile-show")) {
                        overlay.style.display = "block";
                    } else {
                        overlay.style.display = "none";
                    }
                } else {
                    // Logika untuk Desktop (Laptop)
                    sidebar.classList.toggle("collapsed");
                    mainContent.classList.toggle("expanded");
                }
            });

            // Fungsi ketika overlay diklik (hanya berlaku di mobile)
            overlay.addEventListener("click", function() {
                if (isMobile()) {
                    sidebar.classList.remove("mobile-show");
                    overlay.style.display = "none";
                }
            });

            // Antisipasi jika layar di-resize dari mobile ke desktop / sebaliknya
            window.addEventListener("resize", function() {
                if (!isMobile()) {
                    // Jika kembali ke desktop, hapus class khusus mobile
                    sidebar.classList.remove("mobile-show");
                    overlay.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>