@extends('layouts.user')

@section('content')
<style>
    .hero-section {
        background: white;
        border-radius: 0 0 50px 50px;
        padding: 60px 0 100px 0;
        margin-bottom: -50px;
    }
    .card-unit {
        border: none;
        border-radius: 24px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: white;
    }
    .card-unit:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
    }
    .unit-img-wrapper {
        border-radius: 24px;
        overflow: hidden;
        margin: 10px;
        height: 220px;
    }
    .badge-unit {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        color: #000;
        font-weight: 800;
        font-size: 10px;
        padding: 6px 15px;
    }
</style>

<section class="hero-section shadow-sm">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 mb-3 fw-bold">Official Katalog Unit</span>
                <h1 class="display-4 fw-extrabold mb-3">Temukan Toyota <br><span class="text-danger">Impian Anda</span></h1>
                <p class="text-muted lead mb-4">Telusuri berbagai unit pilihan dengan transparansi data dan multimedia lengkap dari Auto 2000 Juanda.</p>
            </div>
            <div class="col-lg-6 text-end d-none d-lg-block">
                <img src="https://www.toyota.astra.co.id/sites/default/files/2023-08/1_gr-corolla_0.png" class="img-fluid" style="filter: drop-shadow(0 20px 30px rgba(0,0,0,0.1));">
            </div>
        </div>
    </div>
</section>

<div class="container mt-5 pt-5" id="katalog">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-black mb-0">UNIT TERSEDIA</h3>
        <span class="text-muted small">{{ count($mobils) }} Kendaraan Ditemukan</span>
    </div>

    <div class="row g-4">
        @forelse($mobils as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card card-unit shadow-sm h-100">
                    <div class="position-relative">
                        <span class="badge badge-unit rounded-pill text-uppercase">{{ $item->kategori }}</span>
                        <div class="unit-img-wrapper">
                            @if(!empty($item->fotos) && isset($item->fotos[0]))
                                <img src="{{ asset('storage/' . $item->fotos[0]) }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                    <i class="bi bi-image fs-1"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">{{ $item->nama_mobil }}</h5>
                        <div class="row g-2 mb-4">
                            <div class="col-4">
                                <div class="bg-light p-2 rounded-3 text-center">
                                    <small class="text-muted d-block small" style="font-size: 9px">TAHUN</small>
                                    <span class="fw-bold small">{{ $item->tahun }}</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-light p-2 rounded-3 text-center">
                                    <small class="text-muted d-block small" style="font-size: 9px">JARAK</small>
                                    <span class="fw-bold small">{{ number_format($item->km) }} KM</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-light p-2 rounded-3 text-center">
                                    <small class="text-muted d-block small" style="font-size: 9px">WARNA</small>
                                    <span class="fw-bold small text-capitalize">{{ $item->warna }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('user.mobil.show', $item->id) }}" class="btn btn-danger py-2 fw-bold rounded-pill shadow-sm">
                                LIHAT DETAIL <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-search fs-1 opacity-25 text-danger"></i>
                <p class="text-muted mt-3">Mohon maaf, saat ini belum ada unit yang tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection