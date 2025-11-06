@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-light">Detail Fakultas</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden text-center bg-dark text-light">
                
                {{-- Gambar Fakultas --}}
                <div class="position-relative" style="background-color: #1e293b;">
                    <img src="{{ asset('GambarFakultas/' . $fakultas->gambar) }}" 
                         alt="{{ $fakultas->nama_fakultas }}" 
                         class="img-fluid w-100"
                         style="height: 250px; object-fit: cover; opacity: 0.95;">
                </div>
        
                {{-- Detail Fakultas --}}
                <div class="card-body p-4">
                    <h6 class="text-secondary mb-2">Kode Fakultas: 
                        <span class="text-light">{{ $fakultas->kode_fakultas }}</span>
                    </h6>
                    <h5 class="mb-0 text-light">{{ $fakultas->nama_fakultas }}</h5>
                    <p class="text-light mt-3">{{ $fakultas->deskripsi }}</p>
        
                    @if($fakultas->dekan)
                        <p><strong>Dekan:</strong> <span class="text-info">{{ $fakultas->dekan }}</span></p>
                    @endif
        
                    {{-- Tombol kembali --}}
                    <a href="{{ route('fakultas.index') }}" class="btn btn-primary w-100 rounded-3 mt-3">
                        Kembali
                    </a>
                </div>
        
            </div>
        </div>
    </div>
</div>
@endsection