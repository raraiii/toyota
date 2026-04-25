@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<div class="min-h-screen flex items-center justify-center bg-[#F1F5F9] py-12 px-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="w-full max-w-[420px]">
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 p-10 md:p-12">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-600 rounded-2xl mb-4 shadow-lg shadow-blue-600/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h2 class="text-3xl font-800 text-slate-900 tracking-tight">Welcome Back</h2>
                <p class="text-slate-500 mt-2 font-medium text-sm">Enter your credentials to access your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all @error('email') border-red-500 @enderror" placeholder="name@company.com">
                        @error('email') <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-bold text-blue-600 hover:underline" href="{{ route('password.request') }}">Forgot?</a>
                            @endif
                        </div>
                        <input type="password" name="password" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center ml-1">
                    <input class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500" type="checkbox" name="remember" id="remember">
                    <label class="ml-2 text-sm font-medium text-slate-600" for="remember text-xs">Keep me logged in</label>
                </div>

                <button type="submit" class="w-full py-5 mt-4 bg-blue-600 text-white font-extrabold rounded-2xl shadow-[0_15px_30px_rgba(37,99,235,0.3)] hover:bg-blue-700 active:scale-95 transition-all uppercase tracking-wider">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center text-sm font-medium text-slate-500">
                Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Sign Up</a>
            </div>
        </div>
    </div>
</div>
@endsection