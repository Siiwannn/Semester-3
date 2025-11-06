<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $mahasiswas = [
            [
                'nim' => '2310112221',
                'nama' => 'Andi Pratama',
                'prodi' => 'Teknik Elektro',
                'angkatan' => 2022,
                'tgl_lahir' => '2000-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'andi.jpg'
            ],
            [
                'nim' => '2310112251',
                'nama' => 'Agus Santoso',
                'prodi' => 'Teknik Mesin',
                'angkatan' => 2022,
                'tgl_lahir' => '2004-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'bambang.jpg'
            ],
            [
                'nim' => '2310112252',
                'nama' => 'Dewianty',
                'prodi' => 'Ilmu Komunikasi',
                'angkatan' => 2022,
                'tgl_lahir' => '2000-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'dewi.jpg'
            ],
            [
                'nim' => '2310112253',
                'nama' => 'Yanto',
                'prodi' => 'Teknik Informatika',
                'angkatan' => 2022,
                'tgl_lahir' => '2000-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'fajar.jpg'
            ],
            [
                'nim' => '2310112254',
                'nama' => 'Yanti',
                'prodi' => 'Manajemen',
                'angkatan' => 2022,
                'tgl_lahir' => '2000-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'fitriani.jpg'
            ],
            [
                'nim' => '2310112255',
                'nama' => 'Fitri awe',
                'prodi' => 'Ekonomi',
                'angkatan' => 2022,
                'tgl_lahir' => '2000-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'lina.jpg'
            ],
            [
                'nim' => '2310112256',
                'nama' => 'Lina Luna',
                'prodi' => 'Akuntansi',
                'angkatan' => 2022,
                'tgl_lahir' => '2000-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'rina.jpg'
            ],
            [
                'nim' => '2310112257',
                'nama' => 'Nana',
                'prodi' => 'Bahasa Inggris',
                'angkatan' => 2022,
                'tgl_lahir' => '2000-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'lina.jpg'
            ],
            [
                'nim' => '2310112258',
                'nama' => ' Sariwati',
                'prodi' => 'Ilmu Komputer',
                'angkatan' => 2022,
                'tgl_lahir' => '2000-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'rizky.jpg'
            ],
            [
                'nim' => '2310112259',
                'nama' => 'Asep',
                'prodi' => 'Teknik Perikanan',
                'angkatan' => 2022,
                'tgl_lahir' => '2002-07-22',
                'no_hp' => '08685748473',
                'gambar' => 'yusuf.jpg'
            ],
            [
                'nim' => '2310112250',
                'nama' => 'Petrus',
                'prodi' => 'Teknik Elektro',
                'angkatan' => 2022,
                'tgl_lahir' => '2001-07-22',
                'no_hp' => '08685748479',
                'gambar' => 'bambang.jpg'
            ],
        ];
        foreach ($mahasiswas as $mhs) {
            \App\Models\Mahasiswa::create($mhs);
        }
    }
}
