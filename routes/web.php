<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\AuthController;

// ===========================
// Halaman Umum
// ===========================
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');


// ===========================
// Halaman Mahasiswa (User)
// ===========================
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.detail');


// ===========================
// Halaman Fakultas (User)
// ===========================
Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas.index');
Route::get('/fakultas/{id}', [FakultasController::class, 'show'])->name('fakultas.detail');


// ===========================
// Autentikasi (Login / Register / Logout)
// ===========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===========================
// Admin - CRUD Mahasiswa (hanya untuk yang login)
// ===========================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'adminIndex'])->name('admin.mahasiswa.index');

    // Data untuk DataTables (JSON)
    Route::get('/mahasiswa/data', [MahasiswaController::class, 'getData'])->name('admin.mahasiswa.data');

    // Simpan data baru
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');

    // Ambil data untuk edit
    Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');

    // Update data mahasiswa
    Route::post('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');

    // Hapus data mahasiswa
    Route::delete('/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.delete');

    // Export Ke Pdf
     Route::get('/mahasiswa/pdf', [MahasiswaController::class, 'reportPdf'])->name('mahasiswa.all.pdf');
});