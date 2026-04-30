@extends('layouts.sales')

@section('content')
<style>.preview-img { width: 70px; height: 50px; object-fit: cover; border-radius: 8px; }</style>
<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-black text-dark mb-0 text-uppercase">Edit Unit #{{ $mobil->id }}</h3>
        <a href="{{ route('sales.mobil.index') }}" class="btn btn-light border rounded-pill px-4 fw-bold">Kembali</a>
    </div>

    <form action="{{ route('sales.mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-5 p-4 p-lg-5 mb-4">
                    <h5 class="fw-bold mb-4 text-danger text-uppercase">Detail Kendaraan</h5>
                    <div class="row g-3">
                        {{-- NAMA MOBIL --}}
                        <div class="col-12">
                            <label class="small fw-bold text-muted">NAMA MOBIL</label>
                            <input type="text" name="nama_mobil"
                                class="form-control rounded-4 border-0 bg-light"
                                value="{{ $mobil->nama_mobil }}" required>
                        </div>

                        {{-- TAHUN --}}
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">TAHUN</label>
                            <input type="number" name="tahun"
                                class="form-control rounded-4 border-0 bg-light"
                                value="{{ $mobil->tahun }}" required>
                        </div>

                        {{-- KM --}}
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted text-uppercase">KM</label>
                            <input type="number" name="km"
                                class="form-control rounded-4 border-0 bg-light"
                                value="{{ $mobil->km }}" required>
                        </div>

                        {{-- WARNA --}}
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">WARNA</label>
                            <input type="text" name="warna"
                                class="form-control rounded-4 border-0 bg-light"
                                value="{{ $mobil->warna }}" required>
                        </div>

                        {{-- KATEGORI --}}
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">KATEGORI</label>
                            <select name="kategori" class="form-select rounded-4 border-0 bg-light" required>

                                <option value="fleet" {{ $mobil->kategori == 'fleet' ? 'selected' : '' }}>
                                    Fleet
                                </option>

                                <option value="rental" {{ $mobil->kategori == 'rental' ? 'selected' : '' }}>
                                    Rental
                                </option>

                                <option value="used" {{ $mobil->kategori == 'used' ? 'selected' : '' }}>
                                    Used Car
                                </option>

                            </select>
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="col-12">
                            <label class="small fw-bold text-muted">DESKRIPSI</label>
                            <textarea name="deskripsi" rows="5"
                                class="form-control rounded-4 border-0 bg-light">{{ $mobil->deskripsi }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-5 p-4 p-lg-5">
                    <h5 class="fw-bold mb-4 text-primary text-uppercase">Detail Pemilik</h5>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="small fw-bold text-muted text-uppercase">Nama Pemilik</label><input type="text" name="nama_pemilik" class="form-control rounded-4 border-0 bg-light" value="{{ $mobil->nama_pemilik }}" required></div>
                        <div class="col-md-6"><label class="small fw-bold text-muted text-uppercase">Kontak WA</label><input type="text" name="telp_pemilik" class="form-control rounded-4 border-0 bg-light" value="{{ $mobil->telp_pemilik }}" required></div>
                         <div class="col-12"><label class="small fw-bold">EMAIL PEMILIK</label><input type="email" name="email_pemilik" class="form-control rounded-4 border-0 bg-light" placeholder="email@contoh.com" value="{{ $mobil->email_pemilik }}"></div>
                        <div class="col-12"><label class="small fw-bold text-muted text-uppercase">Alamat</label><textarea name="alamat_pemilik" rows="2" class="form-control rounded-4 border-0 bg-light">{{ $mobil->alamat_pemilik }}</textarea></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-5 p-4 mb-4">
                    <h6 class="fw-bold text-muted mb-3">Media Saat Ini</h6>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @foreach($mobil->fotos ?? [] as $f)<img src="{{ asset('storage/'.$f) }}" class="preview-img border">@endforeach
                    </div>
                    <div class="mb-3"><label class="small fw-bold">Update Foto</label><input type="file" name="fotos[]" class="form-control form-control-sm" multiple accept="image/*"></div>
                    <div class="mb-3"><label class="small fw-bold">Update Video</label><input type="file" name="videos[]" class="form-control form-control-sm" multiple accept="video/*"></div>
                </div>
                <button type="submit" class="btn btn-dark btn-lg py-3 rounded-pill fw-bold w-100 shadow">SIMPAN PERUBAHAN</button>
            </div>
        </div>
    </form>
</div>
@endsection