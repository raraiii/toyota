@extends('layouts.user')

@section('content')
<style>
    .media-container { 
        border-radius: 32px; 
        overflow: hidden; 
        background: #000; 
        height: 550px; 
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        position: relative;
    }
    .thumb-scroll { gap: 12px; padding: 10px 0; }
    .thumb-btn { 
        width: 110px; height: 75px; border-radius: 16px; 
        object-fit: cover; cursor: pointer; transition: 0.3s; 
        border: 2px solid transparent; opacity: 0.6;
    }
    .thumb-btn:hover, .thumb-btn.active { opacity: 1; border-color: var(--toyota-red); transform: scale(1.05); }
    .sales-box { 
        background: #000; 
        color: white; 
        border-radius: 24px; 
        padding: 30px; 
    }
</style>

<div class="container mt-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-danger fw-bold text-decoration-none small text-uppercase">Katalog</a></li>
            <li class="breadcrumb-item active small text-uppercase fw-bold" aria-current="page">{{ $mobil->nama_mobil }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-8">
            <div class="media-container mb-3">
                <img src="{{ asset('storage/' . $mobil->fotos[0]) }}" id="displayView" class="w-100 h-100 object-fit-cover">
                <video id="videoView" controls class="w-100 h-100 d-none" style="background:#000;"><source src="" type="video/mp4"></video>
            </div>

            <div class="d-flex thumb-scroll overflow-auto pb-3">
                @foreach($mobil->fotos as $f)
                    <img src="{{ asset('storage/' . $f) }}" onclick="changeMedia('image', '{{ asset('storage/' . $f) }}', this)" class="thumb-btn {{ $loop->first ? 'active' : '' }}">
                @endforeach
                @if(!empty($item->videos ?? $mobil->videos))
                    @foreach($mobil->videos as $v)
                        <div class="thumb-btn bg-dark d-flex align-items-center justify-content-center text-white" onclick="changeMedia('video', '{{ asset('storage/' . $v) }}', this)">
                            <i class="bi bi-play-circle fs-2"></i>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="mt-4 p-4 p-md-5 bg-white shadow-sm rounded-5 border border-light">
                <h4 class="fw-black mb-4">Deksripsi Lengkap</h4>
                <p class="text-muted leading-relaxed" style="white-space: pre-line; line-height: 1.8;">{{ $mobil->deskripsi ?? 'Unit Toyota dengan kondisi prima.' }}</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-5 p-4 p-md-5 bg-white mb-4">
                <h2 class="fw-black text-dark mb-1">{{ $mobil->nama_mobil }}</h2>
                <div class="badge bg-danger rounded-pill px-3 py-2 text-uppercase mb-4" style="font-size: 10px">Toyota {{ $mobil->kategori }}</div>
                
                <div class="vstack gap-4 mb-5">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-light p-3 rounded-4"><i class="bi bi-calendar-check text-danger fs-4"></i></div>
                        <div><small class="text-muted d-block small">Tahun Produksi</small><span class="fw-bold">{{ $mobil->tahun }}</span></div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-light p-3 rounded-4"><i class="bi bi-speedometer text-danger fs-4"></i></div>
                        <div><small class="text-muted d-block small">Jarak Tempuh</small><span class="fw-bold">{{ number_format($mobil->km) }} KM</span></div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-light p-3 rounded-4"><i class="bi bi-palette text-danger fs-4"></i></div>
                        <div><small class="text-muted d-block small">Warna Unit</small><span class="fw-bold text-capitalize">{{ $mobil->warna }}</span></div>
                    </div>
                </div>

                <div class="sales-box shadow-lg">
                    <h6 class="text-white-50 small mb-4 fw-bold">SALES ADVISOR</h6>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="{{ $mobil->sales->foto ? asset('storage/'.$mobil->sales->foto) : 'https://ui-avatars.com/api/?name='.urlencode($mobil->sales->name).'&background=EB0A1E&color=fff' }}" 
                             class="rounded-circle border border-secondary" width="60" height="60" style="object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-0">{{ $mobil->sales->name }}</h6>
                            <small class="text-white-50">Toyota Official Sales</small>
                        </div>
                    </div>
                    <div class="d-grid">
                        <a href="https://wa.me/{{ $mobil->sales->nomor_telepon }}?text=Halo {{ $mobil->sales->name }}, saya tertarik dengan Toyota {{ $mobil->nama_mobil }}." 
                           target="_blank" class="btn btn-danger py-3 fw-bold rounded-4">
                            <i class="bi bi-whatsapp me-2"></i>HUBUNGI SALES
                        </a>
                    </div>
                </div>
            </div>
            <p class="text-center small text-muted"><i class="bi bi-shield-check text-success me-1"></i> Unit telah lolos inspeksi standar Toyota</p>
        </div>
    </div>
</div>

<script>
function changeMedia(type, src, element) {
    const imgView = document.getElementById('displayView');
    const videoView = document.getElementById('videoView');
    document.querySelectorAll('.thumb-btn').forEach(el => el.classList.remove('active'));
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