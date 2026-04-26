@extends('layouts.sales')

@section('content')
<style>
    .stats-card {
        border-radius: 20px;
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #ffffff;
    }
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }
    .icon-box {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    .table-container {
        background: white;
        border-radius: 25px;
        padding: 20px;
    }
    .btn-toyota {
        background-color: #EB0A1E;
        color: white;
        border-radius: 12px;
        font-weight: 700;
        padding: 10px 20px;
        transition: all 0.3s;
    }
    .btn-toyota:hover {
        background-color: #c90819;
        color: white;
        box-shadow: 0 8px 15px rgba(235, 10, 30, 0.2);
    }
</style>

<div class="container-fluid p-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item small fw-bold text-uppercase text-muted">Portal Sales</li>
                    <li class="breadcrumb-item small fw-bold text-uppercase text-danger active">Dashboard</li>
                </ol>
            </nav>
            <h2 class="fw-black text-dark m-0">Overview <span class="badge bg-danger rounded-circle p-1" style="width: 8px; height: 8px; display: inline-block;"> </span></h2>
            <p class="text-muted">Halo, <strong>{{ Auth::user()->name }}</strong>. Berikut ringkasan unit Anda hari ini.</p>
        </div>
        <div>
            <a href="{{ route('sales.mobil.create') }}" class="btn btn-toyota shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Tambah Unit Baru
            </a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card stats-card shadow-sm p-3">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-danger-subtle text-danger">
                        <i class="bi bi-car-front-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 1px;">Koleksi Unit</p>
                        <h3 class="fw-bold m-0">{{ $totalUnit }} <span class="fs-6 text-muted fw-normal">Unit</span></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card shadow-sm p-3">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-primary-subtle text-primary">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 1px;">Status Akun</p>
                        <h3 class="fw-bold m-0 fs-5">Verified Sales <i class="bi bi-patch-check-fill text-primary ms-1"></i></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card shadow-sm p-3">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-success-subtle text-success">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div>
                        <p class="text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 1px;">Lead WhatsApp</p>
                        <h3 class="fw-bold m-0 fs-5">{{ Auth::user()->nomor_telepon }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container shadow-sm border border-light">
        <div class="d-flex justify-content-between align-items-center mb-4 px-2">
            <h5 class="fw-bold m-0">Unit Terbaru</h5>
            <a href="{{ route('sales.mobil.index') }}" class="text-decoration-none text-danger fw-bold small">Lihat Semua <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="border-0 rounded-start ps-3">Info Mobil</th>
                        <th class="border-0 text-center">Tahun</th>
                        <th class="border-0">Kategori</th>
                        <th class="border-0 text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($unitTerbaru as $unit)
                    <tr>
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 60px; height: 45px;" class="overflow-hidden rounded-3 shadow-sm">
                                    @if($unit->fotos && count($unit->fotos) > 0)
                                        <img src="{{ asset('storage/' . $unit->fotos[0]) }}" class="w-100 h-100 object-fit-cover">
                                    @else
                                        <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <span class="d-block fw-bold text-dark">{{ $unit->nama_mobil }}</span>
                                    <span class="text-muted extra-small" style="font-size: 11px;">ID: #TAM-{{ $unit->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border fw-bold">{{ $unit->tahun }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-danger rounded-circle" style="width: 6px; height: 6px;"></div>
                                <span class="small fw-semibold text-muted">{{ $unit->kategori }}</span>
                            </div>
                        </td>
                        <td class="text-end pe-3">
                            <a href="{{ route('sales.mobil.edit', $unit->id) }}" class="btn btn-sm btn-light border rounded-3 shadow-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="opacity-25 mb-2"><i class="bi bi-database-exclamation fs-1"></i></div>
                            <p class="text-muted">Data inventaris belum ada.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection