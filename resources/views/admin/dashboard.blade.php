@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard Inventaris</h2>
            <p class="text-muted mb-0">Monitor dan kelola armada mobil Anda dengan mudah.</p>
        </div>
        <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
            <i class="fas fa-plus me-2"></i> Tambah Mobil
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted fw-bold small">Total Mobil</h6>
                    <h3 class="fw-bold text-primary">{{ $data_mobil->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small text-muted">Foto</th>
                            <th class="py-3 text-uppercase small text-muted">Nama Mobil</th>
                            <th class="py-3 text-uppercase small text-muted">Kategori</th>
                            <th class="py-3 text-uppercase small text-muted">Tahun</th>
                            <th class="text-end pe-4 py-3 text-uppercase small text-muted">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_mobil as $item)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="bg-light rounded-3 overflow-hidden" style="width: 65px; height: 45px;">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Mobil">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                            <i class="fas fa-car"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold text-dark">{{ $item->nama_mobil }}</span>
                            </td>
                            <td class="py-3">
                                <span class="badge rounded-pill {{ $item->kategori == 'fleet' ? 'bg-info-subtle text-info' : 'bg-success-subtle text-success' }} px-3 py-2">
                                    {{ ucfirst($item->kategori) }}
                                </span>
                            </td>
                            <td class="py-3 text-muted">{{ $item->tahun }}</td>
                            <td class="text-end pe-4 py-3">
                                <div class="btn-group">
                                    <a href="{{ route('admin.mobil.edit', $item->id) }}" class="btn btn-sm btn-light border-0 text-secondary me-1 rounded-pill px-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.mobil.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border-0 text-danger rounded-pill px-3" onclick="return confirm('Yakin hapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-2x mb-3 d-block"></i>
                                Belum ada data mobil yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
