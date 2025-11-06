<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::paginate(6);
        return view('pages.fakultas', compact('fakultas'));
    }

    public function show($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('pages.fakultas-detail', compact('fakultas'));
    }
}