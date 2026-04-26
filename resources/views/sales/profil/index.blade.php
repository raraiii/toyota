@extends('layouts.sales')

@section('content')
<style>
    .profile-card { border: none; background: #ffffff; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .avatar-preview { width: 140px; height: 140px; border-radius: 50%; object-fit: cover; border: 5px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .form-section-title { font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; color: var(--toyota-red); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; }
    .form-section-title::after { content: ""; flex-grow: 1; height: 1px; background: #eee; }
    .custom-input { background-color: #f8fafc !important; border: 1px solid #f1f5f9 !important; padding: 12px 18px !important; border-radius: 12px !important; transition: all 0.2s ease; }
    .custom-input:focus { background-color: #fff !important; border-color: var(--toyota-red) !important; box-shadow: 0 0 0 4px rgba(235, 10, 30, 0.1) !important; }
</style>

<div class="container py-2">
    <div class="mb-5">
        <h2 class="fw-extrabold text-dark mb-1 text-uppercase">Pengaturan Profil</h2>
        <p class="text-muted small text-uppercase">Toyota Connect — Kelola akun Sales Anda</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center">
        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
        <div><span class="fw-bold d-block">Berhasil!</span><small>{{ session('success') }}</small></div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card profile-card rounded-5 p-4 text-center">
                <div class="mb-4">
                    <img src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=EB0A1E&color=fff' }}" 
                         class="avatar-preview" id="previewImg">
                </div>
                <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                <p class="text-muted small mb-3">{{ $user->email }}</p>
                <span class="badge bg-dark rounded-pill px-3 py-2 text-uppercase mb-4" style="font-size: 10px;">Verified Sales</span>
                
                <div class="bg-light rounded-4 p-3 text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Username</span>
                        <span class="fw-bold small">{{ $user->username }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Telepon</span>
                        <span class="fw-bold small">{{ $user->nomor_telepon ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card profile-card rounded-5 p-4 p-md-5">
                <form action="{{ route('sales.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-section-title text-uppercase">Informasi Personal</div>
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                            <input type="text" name="name" class="form-control custom-input" value="{{ $user->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">USERNAME</label>
                            <input type="text" name="username" class="form-control custom-input" value="{{ $user->username }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">ALAMAT EMAIL</label>
                            <input type="email" name="email" class="form-control custom-input" value="{{ $user->email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">NOMOR TELEPON</label>
                            <input type="text" name="nomor_telepon" class="form-control custom-input" value="{{ $user->nomor_telepon }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-muted text-uppercase">Ganti Foto Profil</label>
                            <input type="file" name="foto" class="form-control custom-input" accept="image/*" onchange="previewImage(this)">
                        </div>
                    </div>

                    <div class="form-section-title text-uppercase">Keamanan</div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">PASSWORD BARU</label>
                            <input type="password" name="password" class="form-control custom-input" placeholder="••••••••">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">KONFIRMASI PASSWORD</label>
                            <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i> Biarkan password kosong jika tidak ingin ganti.</p>
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-bold shadow-sm border-0">
                            Update Profil <i class="bi bi-arrow-right-short ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) { document.getElementById('previewImg').src = e.target.result; }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection