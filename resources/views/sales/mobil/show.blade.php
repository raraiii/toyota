@extends('layouts.sales')

@section('content')
<style>
    .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(0,0,0,0.05); }
    .spec-item { border-left: 4px solid #EB0A1E; padding-left: 15px; background: #f8f9fa; border-radius: 0 12px 12px 0; }
    .main-media-container { border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.08); background: #000; position: relative; height: 500px; }
    .thumb-scroll { gap: 12px; padding: 10px 0; }
    .thumb-item { width: 110px; height: 75px; border-radius: 12px; object-fit: cover; cursor: pointer; transition: 0.2s; border: 2px solid transparent; opacity: 0.6; }
    .thumb-item:hover, .thumb-item.active { opacity: 1; border-color: #EB0A1E; transform: translateY(-3px); }
</style>

<div class="container py-4">
    <div class="row align-items-end mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-black text-dark mb-1 text-uppercase">{{ $mobil->nama_mobil }}</h1>
            <div class="d-flex align-items-center gap-3 text-muted">
                <span class="badge bg-dark rounded-pill px-3 text-uppercase small">{{ $mobil->kategori }}</span>
                <span><i class="bi bi-geo-alt text-danger"></i> Toyota Juanda</span>
            </div>
        </div>
        <div class="col-md-4 text-md-end mt-3">
            <a href="{{ route('sales.mobil.edit', $mobil->id) }}" class="btn btn-white border shadow-sm rounded-pill px-4 fw-bold">Edit Unit</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="main-media-container mb-3">
                <img src="{{ asset('storage/' . $mobil->fotos[0]) }}" id="displayView" class="w-100 h-100 object-fit-cover">
                <video id="videoView" controls class="w-100 h-100 d-none" style="background: #000;"><source src="" type="video/mp4"></video>
            </div>

            <div class="d-flex thumb-scroll overflow-auto pb-3">
                @foreach($mobil->fotos as $f)
                    <img src="{{ asset('storage/' . $f) }}" onclick="changeMedia('image', '{{ asset('storage/' . $f) }}', this)" class="thumb-item {{ $loop->first ? 'active' : '' }}">
                @endforeach
                @foreach($mobil->videos ?? [] as $v)
                    <div class="position-relative thumb-item d-flex align-items-center justify-content-center bg-dark" onclick="changeMedia('video', '{{ asset('storage/' . $v) }}', this)"><i class="bi bi-play-fill text-white fs-2"></i></div>
                @endforeach
            </div>

            <div class="card border-0 shadow-sm rounded-5 p-4 mt-2">
                <h5 class="fw-bold mb-3">Deskripsi Unit</h5>
                <p class="text-muted leading-relaxed" style="white-space: pre-line;">{{ $mobil->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-5 p-4 mb-4 glass-card">
                <h5 class="fw-bold mb-4 text-uppercase small">Spesifikasi Unit</h5>
                <div class="vstack gap-3">
                    <div class="spec-item p-3"><small class="text-muted d-block small fw-bold">TAHUN</small><span class="h5 fw-bold mb-0 text-danger">{{ $mobil->tahun }}</span></div>
                    <div class="spec-item p-3"><small class="text-muted d-block small fw-bold">KILOMETER</small><span class="h5 fw-bold mb-0">{{ number_format($item->km ?? $mobil->km) }} KM</span></div>
                    <div class="spec-item p-3"><small class="text-muted d-block small fw-bold">WARNA</small><span class="h5 fw-bold mb-0 text-capitalize">{{ $mobil->warna }}</span></div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-5 p-4 mb-4 border-start border-primary border-4">
                <h6 class="fw-bold text-primary text-uppercase mb-3 small">Data Pemilik Unit</h6>
                <div class="mb-3"><label class="d-block small text-muted">Nama Pemilik</label><span class="fw-bold text-dark">{{ $mobil->nama_pemilik }}</span></div>
               <div class="mb-2">
        <label class="d-block small text-muted">WhatsApp</label>
        <span class="fw-bold text-dark">{{ $mobil->telp_pemilik }}</span>
    </div>
    @if($mobil->email_pemilik)
    <div class="mb-3">
        <label class="d-block small text-muted">Email</label>
        <span class="fw-bold text-dark text-break">{{ $mobil->email_pemilik }}</span>
    </div>
    @endif
    <div class="d-grid gap-2">
        <a href="https://wa.me/{{ $mobil->telp_pemilik }}" target="_blank" class="btn btn-primary rounded-pill btn-sm fw-bold">Hubungi WA</a>
       
    </div>
            </div>
        </div>
    </div>
</div>

<script>
function changeMedia(type, src, element) {
    const imgView = document.getElementById('displayView');
    const videoView = document.getElementById('videoView');
    document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
    if (type === 'image') {
        videoView.classList.add('d-none'); videoView.pause();
        imgView.classList.remove('d-none'); imgView.src = src;
    } else {
        imgView.classList.add('d-none'); videoView.classList.remove('d-none');
        videoView.querySelector('source').src = src; videoView.load(); videoView.play();
    }
}
</script>
@endsection