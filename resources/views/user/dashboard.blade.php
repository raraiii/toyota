@extends('layouts.user')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Selamat Datang, {{ auth()->user()->name }}</h1>
            <p>Ini adalah halaman utama user.</p>
        </div>
    </div>
@endsection