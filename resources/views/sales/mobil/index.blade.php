@extends('layouts.sales')

@section('content')
<style>
    .card-mobil { transition: all 0.3s ease; border: 1px solid #f0f0f0; }
    .card-mobil:hover { transform: translateY(-10px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
    .img-wrapper { position: relative; overflow: hidden; aspect-ratio: 16/9; background: #eee; }
    .badge-category { position: absolute; top: 15px; left: 15px; backdrop-filter: blur(8px); background: rgba(0, 0, 0, 0.6); color: white; font-size: 10px; letter-spacing: 1px; }
    .btn-action { width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 10px; transition: 0.2s; border: none; }
</style>

<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h2 class="fw-black text-dark mb-1 text-uppercase">Katalog Unit Saya</h2>
            <p class="text-muted mb-0">Kelola unit Toyota dan data customer Anda.</p>
        </div>
        <a href="{{ route('sales.mobil.create') }}" class="btn btn-danger btn-lg rounded-pill px-4 fw-bold shadow-lg">
            <i class="bi bi-plus-lg me-2"></i>Tambah Unit
        </a>
    </div>

    <div class="row g-4">
        @forelse($mobils as $item)
            <div class="col-sm-6 col-lg-4">
                <div class="card card-mobil h-100 border-0 shadow-sm rounded-5 overflow-hidden">
                    <div class="img-wrapper">
                        <span class="badge badge-category rounded-pill px-3 py-2 text-uppercase fw-bold">{{ $item->kategori }}</span>
                        @if(!empty($item->fotos) && isset($item->fotos[0]))
                            <img src="{{ asset('storage/' . $item->fotos[0]) }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center"><i class="bi bi-image text-muted fs-1"></i></div>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-dark mb-1 text-truncate">{{ $item->nama_mobil }}</h5>
                        <div class="d-flex align-items-center gap-2 mb-3 small text-muted">
                            <span class="text-danger fw-bold">{{ $item->tahun }}</span> • <span>{{ number_format($item->km) }} KM</span> • <span class="text-capitalize">{{ $item->warna }}</span>
                        </div>
                        
                        <div class="p-2 bg-light rounded-3 d-flex align-items-center mb-3">
                            <i class="bi bi-person-circle text-primary me-2"></i>
                            <small class="fw-bold text-dark text-truncate">{{ $item->nama_pemilik }}</small>
                        </div>

                        <hr class="opacity-25">

                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-2">
                                <a href="{{ route('sales.mobil.show', $item->id) }}" class="btn-action bg-info-subtle text-info"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{ route('sales.mobil.edit', $item->id) }}" class="btn-action bg-primary-subtle text-primary"><i class="bi bi-pencil-fill"></i></a>
                            </div>
                            <form action="{{ route('sales.mobil.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus unit ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action bg-danger-subtle text-danger"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-car-front fs-1 opacity-25 text-danger"></i>
                <p class="text-muted mt-3">Belum ada unit yang diupload.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection