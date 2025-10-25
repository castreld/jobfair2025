<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            // SMKN 1 Cimahi & Common SMK (Teknik)
            'Rekayasa Perangkat Lunak',
            'Sistem Informasi, Jaringan, dan Aplikasi',
            'Teknik Komputer dan Jaringan',
            'Multimedia',
            'Desain Grafis',
            'Animasi',
            'Mekatronika',
            'Teknik Elektronika Industri',
            'Teknik Otomasi Industri',
            'Instrumentasi dan Otomatisasi Proses',
            'Teknik Elektronika Komunikasi',
            'Teknik Pendingin dan Tata Udara',
            'Produksi Film dan Program Televisi',
            'Teknik Kendaraan Ringan Otomotif',
            'Teknik dan Bisnis Sepeda Motor',
            'Teknik Instalasi Tenaga Listrik',
            'Teknik Audio Video',
            'Teknik Pemesinan',
            'Teknik Pengelasan',
            'Desain Pemodelan dan Informasi Bangunan',
            'Teknik Konstruksi dan Perumahan',

            // SMK (Bisnis & Manajemen)
            'Akuntansi dan Keuangan Lembaga',
            'Otomatisasi dan Tata Kelola Perkantoran',
            'Bisnis Daring dan Pemasaran',
            'Manajemen Logistik',
            'Perbankan Syariah',

            // SMK (Pariwisata & Lainnya)
            'Usaha Perjalanan Wisata',
            'Perhotelan',
            'Tata Boga',
            'Tata Busana',
            'Tata Kecantikan Kulit dan Rambut',

            // SMK (Agribisnis & Kesehatan)
            'Agribisnis Tanaman',
            'Agribisnis Perikanan',
            'Keperawatan Hewan',
            'Asisten Keperawatan',
            'Farmasi Klinis dan Komunitas',

            // SMA
            'Matematika dan Ilmu Alam (MIA)',
            'Ilmu-Ilmu Sosial (IIS)',
            'Ilmu-Ilmu Bahasa dan Budaya (IIBB)',

            // Universitas (Teknologi & Teknik)
            'Teknik Informatika',
            'Sistem Informasi',
            'Ilmu Komputer',
            'Bisnis Digital',
            'Manajemen Informatika',
            'Teknik Elektro',
            'Teknik Mesin',
            'Teknik Sipil',
            'Arsitektur',
            'Teknik Industri',
            'Teknik Kimia',
            'Teknik Lingkungan',
            'Teknik Geologi',
            'Teknik Geodesi',
            'Teknik Perminyakan',
            'Teknik Perkapalan',
            'Teknik Penerbangan',
            'Teknik Nuklir',
            'Teknologi Pangan',
            'Perencanaan Wilayah dan Kota',

            // Universitas (Sains & Kesehatan)
            'Matematika',
            'Fisika',
            'Kimia',
            'Biologi',
            'Statistika',
            'Kedokteran',
            'Kedokteran Gigi',
            'Farmasi',
            'Keperawatan',
            'Kebidanan',
            'Kesehatan Masyarakat',
            'Gizi',
            'Psikologi',
            'Kesehatan Lingkungan',

            // Universitas (Ekonomi & Bisnis)
            'Manajemen',
            'Akuntansi',
            'Ilmu Ekonomi',
            'Ekonomi Pembangunan',
            'Manajemen Bisnis',

            // Universitas (Sosial & Humaniora)
            'Hukum',
            'Ilmu Komunikasi',
            'Hubungan Internasional',
            'Ilmu Politik',
            'Sosiologi',
            'Antropologi',
            'Kriminologi',
            'Kesejahteraan Sosial',
            'Sejarah',
            'Filsafat',
            'Arkeologi',

            // Universitas (Sastra & Seni)
            'Sastra Indonesia',
            'Sastra Inggris',
            'Sastra Jepang',
            'Sastra Korea',
            'Sastra Arab',
            'Sastra Jerman',
            'Sastra Perancis',
            'Sastra Sunda',
            'Sastra Jawa',
            'Desain Komunikasi Visual (DKV)',
            'Desain Interior',
            'Seni Murni',
            'Seni Tari',
            'Seni Teater',
            'Etnomusikologi',

            // Universitas (Pendidikan)
            'Pendidikan Guru (PGSD/PGPAUD)',
            'Pendidikan Matematika',
            'Pendidikan Bahasa Inggris',
            'Pendidikan Fisika',
            'Pendidikan Biologi',
            'Pendidikan Jasmani',
            'Bimbingan dan Konseling',
            'Pendidikan Luar Biasa',

            // Universitas (Lainnya)
            'Administrasi Publik',
            'Administrasi Bisnis',
            'Ilmu Perpustakaan',
            'Kehutanan',
            'Peternakan',
            'Perikanan',
        ];

        $uniqueMajors = array_unique($majors);
        sort($uniqueMajors);

        $data = [];
        foreach ($uniqueMajors as $major) {
            $data[] = ['name' => $major];
        }

        Major::insert($data);
    }
}