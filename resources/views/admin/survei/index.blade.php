@extends('layouts.admin')

@section('content')
<h4 class="mb-4">Data Mobil - Survei</h4>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
            <th>Aksi</th>
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
            </td>

            <td>{{ $item->nama_mobil }}</td>
            <td>{{ $item->tahun }}</td>
            <td>{{ $item->km }}</td>
            <td>{{ $item->warna }}</td>
            <td>{{ $item->kategori }}</td>

            <td>
                <button class="btn btn-success btn-sm">Lolos</button>
                <button class="btn btn-danger btn-sm">Gagal</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Belum ada data survei</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection