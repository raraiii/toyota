@extends('layouts.sales')

@section('content')
<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-black text-dark mb-0 text-uppercase">Unit Multimedia Baru</h3>
        <a href="{{ route('sales.mobil.index') }}" class="btn btn-light border rounded-pill px-4 fw-bold">Batal</a>
    </div>

    <form action="{{ route('sales.mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-5 p-4 p-lg-5 mb-4">
                    <h5 class="fw-bold mb-4 text-danger text-uppercase"><i class="bi bi-car-front-fill me-2"></i>Informasi Unit</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="small fw-bold text-muted">NAMA MOBIL</label>
                            <input type="text" name="nama_mobil" class="form-control rounded-4 border-0 bg-light py-2" placeholder="Contoh: Toyota Zenix Hybrid" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">TAHUN</label>
                            <input type="number" name="tahun" class="form-control rounded-4 border-0 bg-light" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">KATEGORI</label>
                            <select name="kategori" class="form-select rounded-4 border-0 bg-light">
                                <option value="fleet">Fleet</option>
                                <option value="rental">Rental</option>
                                <option value="used">Used Car</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">KM</label>
                            <input type="number" name="km" class="form-control rounded-4 border-0 bg-light" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">WARNA</label>
                            <input type="text" name="warna" class="form-control rounded-4 border-0 bg-light" required>
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-muted">DESKRIPSI</label>
                            <textarea name="deskripsi" rows="4" class="form-control rounded-4 border-0 bg-light" placeholder="Detail kondisi unit..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-5 p-4 p-lg-5">
                    <h5 class="fw-bold mb-4 text-primary text-uppercase"><i class="bi bi-person-badge-fill me-2"></i>Informasi Pemilik</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted text-uppercase">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="form-control rounded-4 border-0 bg-light" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted text-uppercase">No. WhatsApp</label>
                            <input type="text" name="telp_pemilik" class="form-control rounded-4 border-0 bg-light" required>
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-muted">EMAIL PEMILIK</label>
                            <input type="email" name="email_pemilik" class="form-control rounded-4 border-0 bg-light" placeholder="contoh@mail.com">
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-muted text-uppercase">Alamat</label>
                            <textarea name="alamat_pemilik" rows="2" class="form-control rounded-4 border-0 bg-light"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-5 p-4 bg-dark text-white mb-4">
                    <h5 class="fw-bold mb-4 text-uppercase small">Media Upload</h5>
                    <div class="mb-3">
                        <label class="small opacity-75 mb-2 d-block">FOTO UNIT (BISA BANYAK)</label>
                        <input type="file" name="fotos[]" class="form-control bg-secondary border-0 text-white" multiple accept="image/*" required>
                        <small class="text-white-50 mt-1 d-block" style="font-size: 10px;">Pilih beberapa foto sekaligus.</small>
                    </div>
                    <div class="mb-3">
                        <label class="small opacity-75 mb-2 d-block">VIDEO UNIT (BISA BANYAK)</label>
                        <input type="file" name="videos[]" class="form-control bg-secondary border-0 text-white" multiple accept="video/*">
                        <small class="text-white-50 mt-1 d-block" style="font-size: 10px;">Upload video review unit (MP4/MOV).</small>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger btn-lg py-3 rounded-pill fw-black w-100 shadow-lg text-uppercase">Simpan Unit <i class="bi bi-check2-all ms-2"></i></button>
            </div>
        </div>
    </form>
</div>
@endsection