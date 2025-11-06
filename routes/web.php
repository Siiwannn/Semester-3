<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;


// Halaman Utama
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');


// Halaman Mahasiswa (User)
// ===========================
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.detail');


// Halaman Fakultas (User)
// ===========================
Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas.index');
Route::get('/fakultas/{id}', [FakultasController::class, 'show'])->name('fakultas.detail');


// Admin - CRUD Mahasiswa
// ===========================

// Halaman utama admin CRUD Mahasiswa
Route::get('/admin/mahasiswa', [MahasiswaController::class, 'adminIndex'])->name('admin.mahasiswa.index');

// Data untuk DataTables (JSON)
Route::get('/admin/mahasiswa/data', [MahasiswaController::class, 'getData'])->name('admin.mahasiswa.data');

// Simpan data baru
Route::post('/admin/mahasiswa/store', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');

// Ambil data untuk edit
Route::get('/admin/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');

// Update data mahasiswa
Route::post('/admin/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');

// Hapus data mahasiswa
Route::delete('/admin/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.delete');