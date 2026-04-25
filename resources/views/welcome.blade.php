<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - Welcome</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                50: '#f0f9ff',
                                100: '#e0f2fe',
                                600: '#0284c7', // Warna utama biru profesional
                                700: '#0369a1',
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            [x-cloak] { display: none !important; }
            body {
                background-color: #f8fafc; /* Slate 50 */
                color: #1e293b; /* Slate 800 */
            }
            .hero-gradient {
                background: radial-gradient(circle at top right, rgba(2, 132, 199, 0.05) 0%, rgba(255, 255, 255, 0) 50%);
            }
        </style>
    </head>
    <body class="antialiased font-sans hero-gradient min-h-screen flex flex-col">
        
        <header class="w-full bg-white/80 backdrop-blur-sm sticky top-0 z-50 border-b border-slate-100">
            <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center shadow-md shadow-brand-600/20">
                        <span class="text-white font-bold text-xl">T</span>
                    </div>
                    <span class="text-2xl font-bold text-slate-950 tracking-tight">
                        {{ config('app.name', 'Toyota') }}<span class="text-brand-600">.</span>
                    </span>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm font-semibold text-slate-700 hover:text-brand-600 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-brand-600 transition">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-900 text-white text-sm font-semibold rounded-xl hover:bg-slate-800 shadow-sm transition-all duration-150 active:scale-95">
                                    Daftar Akun
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </header>

        <main class="flex-grow flex items-center justify-center pt-16 pb-24">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-sm font-medium mb-8 shadow-inner shadow-brand-100/50">
                    <span class="relative flex h-2 w-2 mr-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-600 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-600"></span>
                    </span>
                    Sistem Registrasi OTP Terverifikasi
                </div>

                <h1 class="text-5xl md:text-6xl font-extrabold text-slate-950 tracking-tighter leading-[1.1] mb-6">
                    Akses Aman, <br>
                    <span class="text-brand-600">Layanan Profesional.</span>
                </span>
                </h1>

                <p class="text-xl text-slate-600 max-w-2xl mx-auto mb-12 leading-relaxed">
                    Selamat datang di platform resmi {{ config('app.name', 'Toyota') }}. Kelola akun Anda dengan sistem keamanan tingkat tinggi menggunakan verifikasi kode OTP email.
                </p>

                @if (Route::has('login'))
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ url('/home') }}" class="inline-flex items-center justify-center px-8 py-4 bg-brand-600 text-white font-semibold rounded-2xl hover:bg-brand-700 shadow-lg shadow-brand-600/20 transition-all duration-150 active:scale-95 w-full sm:w-auto">
                            Kembali ke Dashboard
                        </a>
                    @else
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-brand-600 text-white font-semibold rounded-2xl hover:bg-brand-700 shadow-lg shadow-brand-600/20 transition-all duration-150 active:scale-95 w-full sm:w-auto text-lg">
                            Mulai Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif
                        
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-900 font-semibold rounded-2xl hover:bg-slate-50 border border-slate-200 shadow-sm transition-all duration-150 active:scale-95 w-full sm:w-auto text-lg">
                            Sudah punya akun?
                        </a>
                    @endauth
                </div>
                @endif
            </div>
        </main>

        <footer class="w-full border-t border-slate-100 bg-white">
            <div class="max-w-7xl mx-auto px-6 py-6 text-center">
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Toyota') }}. All rights reserved. Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </p>
            </div>
        </footer>

    </body>
</html>