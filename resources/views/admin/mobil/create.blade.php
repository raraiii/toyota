@extends('layouts.admin')
@section('content')
<div class="container-fluid px-4 py-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        <div class="card-body">
            <h4 class="mb-4 fw-bold">Tambah Data Mobil</h4>
            <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6"><label>Nama Mobil</label><input type="text" name="nama_mobil" class="form-control" required></div>
                    <div class="col-md-3"><label>Tahun</label><input type="number" name="tahun" class="form-control" required></div>
                    <div class="col-md-3"><label>Kategori</label><select name="kategori" class="form-select"><option value="fleet">Fleet</option><option value="rental">Rental</option></select></div>
                    <div class="col-md-12"><label>Foto</label><input type="file" name="foto" class="form-control" required></div>
                    <div class="col-12 mt-3 text-end">
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection