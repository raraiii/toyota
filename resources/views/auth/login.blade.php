@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#F1F5F9] py-12 px-4">
    <div class="w-full max-w-[420px]">
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 p-10 md:p-12">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center h-14 mb-4">
                    <img src="{{ asset('toyotaaa.png') }}" alt="Toyota Logo" class="h-12 drop-shadow-md">
                </div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h2>
                <p class="text-slate-500 mt-2 font-medium text-sm">Masuk ke sistem Auto 2000 Juanda</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <div class="text-sm font-semibold text-red-700">
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                               class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#EB0A1E] focus:bg-white outline-none transition-all @error('email') border-red-500 ring-1 ring-red-500 @enderror" 
                               placeholder="nama@email.com">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Password</label>
                           
                        </div>
                        <input type="password" name="password" required 
                               class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-[#EB0A1E] focus:bg-white outline-none transition-all @error('password') border-red-500 @enderror" 
                               placeholder="••••••••">
                    </div>
                </div>

               

                <button type="submit" class="w-full py-4 mt-4 bg-[#EB0A1E] text-white font-extrabold rounded-2xl shadow-[0_15px_30px_rgba(235,10,30,0.25)] hover:bg-red-700 active:scale-95 transition-all uppercase tracking-wider">
                    Masuk
                </button>
            </form>

            <div class="mt-8 text-center text-sm font-medium text-slate-500">
                Belum memiliki akun? <a href="{{ route('register') }}" class="text-[#EB0A1E] font-bold hover:underline">Daftar</a>
            </div>
        </div>
    </div>
</div>
@endsection