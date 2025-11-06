<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    // HALAMAN DEPAN MAHASISWA
    public function index()
    {
        $mahasiswas = Mahasiswa::paginate(6);
        return view('pages.mahasiswa', compact('mahasiswas'));
    }

    public function show($id)
    {
        $mahasiswas = Mahasiswa::findOrFail($id);
        return view('pages.mahasiswa-detail', compact('mahasiswas'));
    }

    // HALAMAN ADMIN CRUD
    public function adminIndex()
    {
        return view('admin.index');
    }

    public function getData()
    {
        $mahasiswas = Mahasiswa::all();
        return response()->json(['data' => $mahasiswas]);
    }

    // TAMBAH DATA
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nim' => 'required|unique:mahasiswas,nim',
                'nama' => 'required|string|max:255',
                'prodi' => 'required|string|max:255',
                'angkatan' => 'required|numeric',
                'tgl_lahir' => 'required|date',
                'no_hp' => 'nullable|string|max:20',
                'gambar' => 'nullable|file|mimetypes:image/jpeg,image/png,image/webp,image/jpg,image/pjpeg,image/x-png,image/heic|max:10240',
            ]);
    
            if ($request->hasFile('gambar')) {
                $validated['gambar'] = $request->file('gambar')->store('gambar', 'public');
            }
    
            Mahasiswa::create($validated);
    
            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        }
    }

  
    // AMBIL DATA UNTUK EDIT
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // validasi dasar
        $rules = [
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'angkatan' => 'required|numeric',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:20',
        ];

        // validasi tambahan kalau gambar diupload
        if ($request->hasFile('gambar')) {
            $rules['gambar'] = 'image|mimetypes:image/jpeg,image/png,image/webp,image/jpg,image/pjpeg,image/x-png,image/heic|max:10240';
        }

        $validated = $request->validate($rules);

        // handle upload gambar baru
        if ($request->hasFile('gambar')) {
            // hapus gambar lama kalau ada
            if ($mahasiswa->gambar && Storage::disk('public')->exists($mahasiswa->gambar)) {
                Storage::disk('public')->delete($mahasiswa->gambar);
            }

            // simpan gambar baru
            $validated['gambar'] = $request->file('gambar')->store('gambar', 'public');
        }

        $mahasiswa->update($validated);

        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // hapus gambar kalau ada
        if ($mahasiswa->gambar && Storage::disk('public')->exists($mahasiswa->gambar)) {
            Storage::disk('public')->delete($mahasiswa->gambar);
        }

        $mahasiswa->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}