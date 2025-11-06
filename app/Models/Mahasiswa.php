<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Mahasiswa extends Model
{
    //
    use Hasfactory;

    protected $fillable = [
        'nim',
        'nama',
        'prodi',
        'angkatan',
        'tgl_lahir',
        'no_hp',
        'gambar',
    ];
}
