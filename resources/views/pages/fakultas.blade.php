@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4 text-light">Daftar Fakultas</h2>
    <div class="row justify-content-center">
        @foreach($fakultas as $f)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 bg-dark text-light">
                <img src="{{ asset('GambarFakultas/' . $f->gambar) }}" 
                     alt="{{ $f->nama_fakultas }}" 
                     class="card-img-top" 
                     style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h4 class="card-title text-primary">{{ $f->nama_fakultas }}</h4>
                    <a href="{{ route('fakultas.detail', $f->id) }}" class="btn btn-primary w-100 rounded-3">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $fakultas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection