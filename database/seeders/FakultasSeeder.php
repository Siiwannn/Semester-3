<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        $fakultasList = [
            [
                'kode_fakultas' => 'FASILKOM',
                'nama_fakultas' => 'Fakultas Ilmu Komputer',
                'dekan' => 'Dr. Rudi Hartono, M.Kom',
                'deskripsi' => 'Fokus pada pengembangan teknologi informasi, software engineering, dan sistem cerdas.',
                'gambar' => 'fasilkom.jpg',
            ],
            [
                'kode_fakultas' => 'FEB',
                'nama_fakultas' => 'Fakultas Ekonomi dan Bisnis',
                'dekan' => 'Dr. Sri Wahyuni, M.M',
                'deskripsi' => 'Mempelajari manajemen, akuntansi, dan ekonomi digital untuk dunia bisnis modern.',
                'gambar' => 'feb.jpg',
            ],
            [
                'kode_fakultas' => 'FH',
                'nama_fakultas' => 'Fakultas Hukum',
                'dekan' => 'Dr. Andi Prasetyo, S.H., M.H.',
                'deskripsi' => 'Membentuk lulusan yang menguasai hukum dan etika profesi hukum.',
                'gambar' => 'fh.jpg',
            ],
            [
                'kode_fakultas' => 'FKIP',
                'nama_fakultas' => 'Fakultas Ilmu Pendidikan',
                'dekan' => 'Dr. Diah Lestari, M.Pd.',
                'deskripsi' => 'Berfokus pada pengembangan tenaga pendidik yang profesional dan kreatif.',
                'gambar' => 'fkip.jpg',
            ],
            [
                'kode_fakultas' => 'FT',
                'nama_fakultas' => 'Fakultas Teknik',
                'dekan' => 'Ir. Bambang Setiawan, M.Eng.',
                'deskripsi' => 'Menyiapkan lulusan berkompeten di bidang teknik sipil, elektro, dan industri.',
                'gambar' => 'ft.jpg',
            ],
            [
                'kode_fakultas' => 'FPSIKOLOGI',
                'nama_fakultas' => 'Fakultas Psikologi',
                'dekan' => 'Dr. Laila Rahmawati, M.Psi.',
                'deskripsi' => 'Fokus pada studi perilaku manusia dan penerapan ilmu psikologi di berbagai bidang.',
                'gambar' => 'fpsikologi.jpg',
            ],
            [
                'kode_fakultas' => 'FISIP',
                'nama_fakultas' => 'Fakultas Ilmu Sosial',
                'dekan' => 'Dr. Bayu Pranoto, M.Si.',
                'deskripsi' => 'Mempelajari dinamika sosial, kebijakan publik, dan pemerintahan modern.',
                'gambar' => 'fisip.jpg',
            ],
            [
                'kode_fakultas' => 'FAPERTA',
                'nama_fakultas' => 'Fakultas Pertanian',
                'dekan' => 'Dr. Nurul Hidayah, M.P.',
                'deskripsi' => 'Mengembangkan inovasi di bidang agrikultur dan ketahanan pangan.',
                'gambar' => 'faperta.jpg',
            ],
            [
                'kode_fakultas' => 'FKESEHATAN',
                'nama_fakultas' => 'Fakultas Kesehatan',
                'dekan' => 'Dr. Hendra Saputra, M.Kes.',
                'deskripsi' => 'Fokus pada kesehatan masyarakat, farmasi, dan keperawatan modern.',
                'gambar' => 'fkesehatan.jpg',
            ],
            [
                'kode_fakultas' => 'FSASTRA',
                'nama_fakultas' => 'Fakultas Sastra',
                'dekan' => 'Dr. Melati Kusuma, M.Hum.',
                'deskripsi' => 'Mempelajari bahasa, sastra, dan budaya lintas bangsa.',
                'gambar' => 'fsastra.jpg',
            ],
        ];

        foreach ($fakultasList as $fk) {
            Fakultas::create($fk);
        }
    }
}