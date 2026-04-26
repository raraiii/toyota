@extends('layouts.admin')

@section('content')
<h4>Inventory Mobil</h4>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table">
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
        @foreach($mobil as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($item->fotos && count($item->fotos) > 0)
                    <img src="{{ asset('storage/' . $item->fotos[0]) }}" width="80">
                @else
                    <span>Tidak ada foto</span>
                @endif
            </td>
            <td>{{ $item->nama_mobil }}</td>
            <td>{{ $item->tahun }}</td>
            <td>{{ $item->km }}</td>
            <td>{{ $item->warna }}</td>
            <td>{{ $item->kategori }}</td>
            <td>
                <form action="{{ route('admin.mobil.survei', $item->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-warning btn-sm">Survei</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection