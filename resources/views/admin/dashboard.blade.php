@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Dashboard Admin</h3>
            <p class="text-secondary mb-0" style="font-size: 0.95rem;">Ringkasan sistem dan inventaris armada Toyota.</p>
        </div>
       
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; position: relative; overflow: hidden;">
                <div class="card-body p-4 d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Total Mobil</p>
                            <h2 class="fw-bold text-dark mb-0">{{ $data_mobil->count() }} <span class="fs-6 text-muted fw-normal">Unit</span></h2>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-car-front-fill text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; position: relative; overflow: hidden;">
                <div class="card-body p-4 d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Total Akun Sales</p>
                            <h2 class="fw-bold text-dark mb-0">{{ $total_sales ?? 0 }} <span class="fs-6 text-muted fw-normal">Orang</span></h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-badge-fill text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; position: relative; overflow: hidden;">
                <div class="card-body p-4 d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-uppercase text-muted fw-semibold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Total User / Client</p>
                            <h2 class="fw-bold text-dark mb-0">{{ $total_user ?? 0 }} <span class="fs-6 text-muted fw-normal">Orang</span></h2>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-people-fill text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    
</div>
@endsection