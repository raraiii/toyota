@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4 py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Data Mobil</h2>
        <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">Tambah Mobil</a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Foto</th><th>Nama</th><th>Kategori</th><th>Tahun</th><th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_mobil as $item)
                        <tr>
                            <td class="ps-4">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="rounded" width="60" height="40" style="object-fit: cover;">
                            </td>
                            <td class="fw-semibold">{{ $item->nama_mobil }}</td>
                            <td><span class="badge bg-info-subtle text-info rounded-pill">{{ ucfirst($item->kategori) }}</span></td>
                            <td>{{ $item->tahun }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.mobil.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-pill">Edit</a>
                                <form action="{{ route('admin.mobil.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection