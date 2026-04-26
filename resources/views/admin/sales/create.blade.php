@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0 py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Tambah Akun Sales Baru</h4>
            <p class="text-secondary mb-0 small">Pastikan alamat email aktif untuk keperluan login sistem.</p>
        </div>
        <a href="{{ route('admin.sales.index') }}" class="btn btn-outline-secondary shadow-sm" style="border-radius: 8px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4 md:p-5">
            <form action="{{ route('admin.sales.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-dark small">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-secondary"></i></span>
                            <input type="text" name="name" class="form-control bg-light border-start-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: John Doe" required>
                        </div>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-dark small">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-secondary"></i></span>
                            <input type="email" name="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required>
                        </div>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-dark small">Nomor Telepon (WhatsApp)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-whatsapp text-secondary"></i></span>
                            <input type="number" name="nomor_telepon" class="form-control bg-light border-start-0 @error('nomor_telepon') is-invalid @enderror" value="{{ old('nomor_telepon') }}" placeholder="08123456xxx" required>
                        </div>
                        @error('nomor_telepon') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-dark small">Buat Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-secondary"></i></span>
                            <input type="password" name="password" class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                        </div>
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label fw-bold text-dark small">Foto Profil (Opsional)</label>
                        <input type="file" name="foto" class="form-control bg-light @error('foto') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg">
                        <div class="form-text" style="font-size: 0.75rem;">Format: JPG, PNG. Maksimal 2MB.</div>
                        @error('foto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="my-4 border-light">

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light px-4 fw-bold text-secondary" style="border-radius: 8px;">Reset Form</button>
                    <button type="submit" class="btn btn-danger px-5 fw-bold shadow-sm" style="border-radius: 8px; background-color: #EB0A1E;">
                        <i class="bi bi-check-circle me-1"></i> Simpan Akun Sales
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection