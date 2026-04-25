@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Edit Mobil</h2>
            <p class="text-muted mb-0">Perbarui informasi kendaraan: {{ $mobil->nama_mobil }}</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    {{-- TAMBAHKAN INI: Agar Anda tahu kenapa gagal save --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm border-0 rounded-4 mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-3">
        <div class="card-body">
            <form action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Mobil</label>
                        <input type="text" name="nama_mobil" class="form-control form-control-lg bg-light border-0" value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Tahun</label>
                        <input type="number" name="tahun" class="form-control form-control-lg bg-light border-0" value="{{ old('tahun', $mobil->tahun) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select form-select-lg bg-light border-0">
                            <option value="fleet" {{ $mobil->kategori == 'fleet' ? 'selected' : '' }}>Fleet</option>
                            <option value="rental" {{ $mobil->kategori == 'rental' ? 'selected' : '' }}>Rental</option>
                        </select>
                    </div>

                    {{-- TAMBAHKAN FIELD YANG HILANG --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kilometer (KM)</label>
                        <input type="number" name="km" class="form-control form-control-lg bg-light border-0" value="{{ old('km', $mobil->km) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Warna</label>
                        <input type="text" name="warna" class="form-control form-control-lg bg-light border-0" value="{{ old('warna', $mobil->warna) }}" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Foto Mobil</label>
                        <div class="d-flex align-items-center gap-3">
                            @if($mobil->foto)
                                <img src="{{ asset('storage/' . $mobil->foto) }}" class="rounded-3" width="100" height="70" style="object-fit: cover;" alt="Current Photo">
                            @endif
                            <input type="file" name="foto" class="form-control form-control-lg bg-light border-0">
                        </div>
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                    </div>

                    <hr class="my-2">

                    <div class="col-12">
                        <h5 class="fw-bold text-primary mb-3">Informasi Pemilik</h5>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" class="form-control bg-light border-0" value="{{ old('nama_pemilik', $mobil->nama_pemilik) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">No Telp</label>
                        <input type="text" name="no_telp" class="form-control bg-light border-0" value="{{ old('no_telp', $mobil->no_telp) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control bg-light border-0" value="{{ old('email', $mobil->email) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control bg-light border-0" rows="3" required>{{ old('alamat', $mobil->alamat) }}</textarea>
                    </div>
                </div>

                <div class="mt-4 pt-3 text-end">
                    <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection