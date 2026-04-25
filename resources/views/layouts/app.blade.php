<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Toyota Auto 2000 Juanda</title>

    <link rel="icon" type="image/png" href="{{ asset('toyotaaa.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        toyota: '#EB0A1E',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #F8FAFC;
            color: #1E293B;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Smooth Transitions */
        .transition-all {
            transition-duration: 300ms;
        }
    </style>
</head>
<body class="antialiased">
    <div id="app">
        @if(!request()->is('home*'))
        <nav class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 md:px-6 h-20 flex items-center justify-between">
                
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('toyotaaa.png') }}" alt="Logo Toyota" class="h-10 group-hover:scale-105 transition-all">
                    <div class="flex flex-col justify-center">
                        <span class="text-xl font-extrabold leading-none tracking-tight text-slate-900">
                            AUTO <span class="text-toyota">2000</span>
                        </span>
                        <span class="text-slate-500 font-bold tracking-widest mt-1" style="font-size: 0.65rem;">
                            CABANG JUANDA
                        </span>
                    </div>
                </a>

                <div class="flex items-center gap-4 md:gap-6">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-toyota transition">
                                Login
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-toyota text-white text-sm font-bold rounded-full hover:bg-red-700 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                                Register
                            </a>
                        @endif
                    @else
                        <div class="flex items-center gap-3 md:gap-4">
                            <span class="text-sm font-medium text-slate-600 hidden md:block">
                                Halo, <strong class="text-slate-900">{{ Auth::user()->name }}</strong>
                            </span>
                            
                            @if(Auth::user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-toyota hover:text-red-700 transition">Dashboard</a>
                            @elseif(Auth::user()->role == 'sales')
                                <a href="/sales/dashboard" class="text-sm font-bold text-toyota hover:text-red-700 transition">Dashboard</a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="text-sm font-bold text-toyota hover:text-red-700 transition">Dashboard</a>
                            @endif

                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="px-4 py-2 border-2 border-slate-200 text-red-600 text-sm font-bold rounded-full hover:bg-slate-50 transition-all">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
        @endif

        <main>
            @yield('content')
        </main>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#EB0A1E', // Menggunakan merah Toyota
            customClass: { confirmButton: 'rounded-full px-6 py-2 font-bold' }
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#1a1a1a', // Warna gelap
            customClass: { confirmButton: 'rounded-full px-6 py-2 font-bold' }
        });
    </script>
    @endif

    @stack('scripts')
</body>
</html>