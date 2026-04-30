@extends('layouts.admin')

@section('content')

<h4>Status Mobil</h4>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="mb-3 d-flex gap-2">

    <a href="{{ route('admin.status.index', 'all') }}"
       class="btn btn-sm {{ $filter == 'all' ? 'btn-dark' : 'btn-outline-dark' }}">
        Semua
    </a>

    <a href="{{ route('admin.status.index', 'lolos') }}"
       class="btn btn-sm {{ $filter == 'lolos' ? 'btn-success' : 'btn-outline-success' }}">
        Lolos
    </a>

    <a href="{{ route('admin.status.index', 'gagal') }}"
       class="btn btn-sm {{ $filter == 'gagal' ? 'btn-danger' : 'btn-outline-danger' }}">
        Tidak Lolos
    </a>

</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Mobil</th>
            <th>Tahun</th>
            <th>KM</th>
            <th>Warna</th>
            <th>Kategori</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($mobil as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($item->fotos && count($item->fotos) > 0)
                    <img src="{{ asset('storage/' . $item->fotos[0]) }}" width="80">
                @else
                    -
                @endif
            <td>{{ $item->nama_mobil }}</td>
            <td>{{ $item->tahun }}</td>
            <td>{{ $item->km }}</td>
            <td>{{ $item->warna }}</td>
            <td>{{ $item->kategori }}</td>
            <td>
                @if($item->status == 'deal')
                    <span class="badge bg-success">Lolos</span>
                @else
                    <span class="badge bg-danger">Tidak Lolos</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection