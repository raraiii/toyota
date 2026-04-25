<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Toyota App') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
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
        <nav class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-600/20 group-hover:scale-110 transition-all">
                        <span class="text-white font-black text-xl">T</span>
                    </div>
                    <span class="text-xl font-800 tracking-tight text-slate-900 uppercase italic">Toyota</span>
                </a>

                <div class="flex items-center gap-6">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">{{ __('Login') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-black transition-all shadow-md">
                                {{ __('Sign Up') }}
                            </a>
                        @endif
                    @else
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                            <a href="{{ route('home') }}" class="text-sm font-bold text-blue-600">Dashboard</a>
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
            confirmButtonColor: '#2563EB',
            customClass: { confirmButton: 'rounded-xl px-6 py-2' }
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#EF4444',
            customClass: { confirmButton: 'rounded-xl px-6 py-2' }
        });
    </script>
    @endif

    @stack('scripts')
</body>
</html>