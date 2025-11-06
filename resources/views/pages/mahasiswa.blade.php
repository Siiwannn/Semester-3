@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Daftar Mahasiswa</h2>
    <div class="row">
        @foreach ($mahasiswas as $mhs)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('storage/' . $mhs->gambar) }}" 
                     alt="{{ $mhs->nama }}" 
                     class="card-img-top" 
                     style="height: 350px; object-fit: cover; object-position: top;">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ $mhs->nama }}</h3>
                    <h5 class="card-title text-center">{{ $mhs->nim }}</h5>
                    <a href="{{ route('mahasiswa.detail', $mhs->id) }}" 
                       class="btn btn-primary w-100">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $mahasiswas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection