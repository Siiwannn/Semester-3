@extends('layouts.app')

@section('content')
<main class="d-flex justify-content-center align-items-center py-5">
    <div class="card p-4 text-center" style="width: 400px;">
        <!-- Foto -->
        <div class="d-flex justify-content-center mb-3">
            <img src="{{ asset('storage/' . $mahasiswas->gambar) }}" 
                 alt="{{ $mahasiswas->nama }}" 
                 class="rounded-circle shadow"
                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #0a0a0a;">
        </div>

        <!-- Nama -->
        <h3 class="card-title mb-3">{{ $mahasiswas->nama }}</h3>

        <!-- Detail -->
        <p><strong>NIM:</strong> {{ $mahasiswas->nim }}</p>
        <p><strong>Prodi:</strong> {{ $mahasiswas->prodi }}</p>
        <p><strong>Angkatan:</strong> {{ $mahasiswas->angkatan }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ $mahasiswas->tgl_lahir }}</p>
        <p><strong>Nomor HP:</strong> {{ $mahasiswas->no_hp }}</p>

        <!-- Tombol kembali -->
        <a href="{{ route('mahasiswa.index') }}" 
           class="btn btn-primary w-100 mt-3 fw-semibold">
            Kembali
        </a>
    </div>
</main>
@endsection