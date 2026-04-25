@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="min-h-screen flex items-center justify-center bg-[#F1F5F9] py-12 px-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="w-full max-w-[450px]">
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 p-10 md:p-12 transition-all">
            
            <div class="text-center mb-10">
                <h2 class="text-3xl font-800 text-slate-900 tracking-tight">Registration</h2>
                <p class="text-slate-500 mt-2 font-medium text-sm">Create your professional account today</p>
            </div>

            <form id="final-form" action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="space-y-4">
                    <input type="text" name="name" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all" placeholder="Full Name">
                    
                    <div class="relative group">
                        <input type="email" id="email-val" name="email" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all" placeholder="Email Address">
                        <button type="button" id="btn-send-otp" class="absolute right-2 top-2 bottom-2 px-4 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-black transition-all">
                            Verify Email
                        </button>
                    </div>

                    <div id="otp-wrapper" class="hidden animate-fade-in">
                        <div class="relative">
                            <input type="text" id="otp-code" name="otp" maxlength="6" placeholder="Enter 6-digit OTP" class="w-full px-6 py-4 bg-blue-50/50 border-2 border-dashed border-blue-200 rounded-2xl focus:border-blue-600 text-center font-bold text-xl tracking-[0.3em] outline-none">
                            <div id="otp-status" class="mt-2 text-center text-[11px] font-bold uppercase tracking-widest text-slate-400">Waiting for code...</div>
                        </div>
                    </div>

                    <input type="password" name="password" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all" placeholder="Create Password">
                    <input type="password" name="password_confirmation" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all" placeholder="Confirm Password">
                </div>

                <button type="submit" id="btn-submit" class="hidden w-full py-5 mt-6 bg-blue-600 text-white font-extrabold rounded-2xl shadow-[0_15px_30px_rgba(37,99,235,0.3)] hover:bg-blue-700 active:scale-95 transition-all uppercase tracking-wider">
                    Create Account
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .animate-fade-in { animation: fadeIn 0.4s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    const btnSend = document.getElementById('btn-send-otp');
    const otpWrapper = document.getElementById('otp-wrapper');
    const otpInput = document.getElementById('otp-code');
    const otpStatus = document.getElementById('otp-status');
    const btnSubmit = document.getElementById('btn-submit');
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // 1. Send OTP
    btnSend.addEventListener('click', async () => {
        const email = document.getElementById('email-val').value;
        if(!email) return Swal.fire('Error', 'Input email first!', 'error');

        btnSend.disabled = true;
        btnSend.innerText = 'Sending...';

        try {
            const res = await fetch("{{ route('otp.send_only') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: JSON.stringify({ email: email })
            });
            const data = await res.json();
            
            if(data.success) {
                Swal.fire('OTP Sent!', 'Check your inbox or spam.', 'success');
                otpWrapper.classList.remove('hidden');
                btnSend.innerText = 'Verify Email';
            } else {
                Swal.fire('Failed', data.message, 'error');
                btnSend.disabled = false;
                btnSend.innerText = 'Verify Email';
            }
        } catch (e) {
            Swal.fire('Error', 'System busy.', 'error');
            btnSend.disabled = false;
        }
    });

    // 2. Real-time OTP Verification (Sesuai Permintaan)
    otpInput.addEventListener('input', async (e) => {
        const code = e.target.value;
        if(code.length === 6) {
            otpStatus.innerText = "Checking...";
            
            const res = await fetch("/verify-otp-only", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ otp: code })
            });
            const data = await res.json();

            if(data.success) {
                otpStatus.innerText = "Verified ✅";
                otpStatus.className = "mt-2 text-center text-[11px] font-bold uppercase tracking-widest text-emerald-500";
                otpInput.classList.replace('border-blue-200', 'border-emerald-500');
                btnSubmit.classList.remove('hidden'); // Tampilkan tombol register
            } else {
                otpStatus.innerText = "Wrong Code ❌";
                otpStatus.className = "mt-2 text-center text-[11px] font-bold uppercase tracking-widest text-red-500";
                btnSubmit.classList.add('hidden');
            }
        }
    });

    // 3. Final Form Submission
    document.getElementById('final-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        Swal.fire({ title: 'Creating Account...', didOpen: () => Swal.showLoading() });

        const formData = new FormData(this);
        const res = await fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        });

        const data = await res.json();
        if(data.success) {
            Swal.fire('Success!', 'Registration complete.', 'success');
            setTimeout(() => { window.location.href = data.redirect; }, 1500);
        } else {
            Swal.fire('Gagal', 'Check your data.', 'error');
        }
    });
</script>
@endsection