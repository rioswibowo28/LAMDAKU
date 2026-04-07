<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Akreditasi Klinik',
                'slug' => 'akreditasi-klinik',
                'description' => 'Layanan akreditasi profesional untuk klinik kesehatan dengan standar nasional dan internasional.',
                'content' => 'Kami menyediakan layanan akreditasi komprehensif untuk klinik kesehatan yang mencakup evaluasi sistem manajemen mutu, keselamatan pasien, dan pelayanan klinis. Tim ahli kami akan mendampingi klinik Anda dalam proses persiapan hingga sertifikasi akreditasi.',
                'icon' => 'Hospital',
                'price' => 15000000.00,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Akreditasi Laboratorium',
                'slug' => 'akreditasi-laboratorium',
                'description' => 'Sertifikasi akreditasi untuk laboratorium medis sesuai standar ISO 15189 dan regulasi terkini.',
                'content' => 'Layanan akreditasi laboratorium medis yang komprehensif meliputi sistem manajemen mutu, kompetensi teknis, dan keamanan laboratorium. Kami membantu laboratorium mencapai standar ISO 15189 dan persyaratan regulasi kesehatan.',
                'icon' => 'FlaskConical',
                'price' => 20000000.00,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Akreditasi Puskesmas',
                'slug' => 'akreditasi-puskesmas',
                'description' => 'Program akreditasi khusus untuk Pusat Kesehatan Masyarakat (Puskesmas) tingkat nasional.',
                'content' => 'Program akreditasi Puskesmas yang dirancang khusus untuk fasilitas kesehatan tingkat pertama. Meliputi evaluasi pelayanan UKM, UKP, manajemen mutu, dan kepemimpinan sesuai standar Kemenkes RI.',
                'icon' => 'Building2',
                'price' => 12000000.00,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'Konsultasi Mutu',
                'slug' => 'konsultasi-mutu',
                'description' => 'Layanan konsultasi profesional untuk pengembangan sistem manajemen mutu kesehatan.',
                'content' => 'Konsultasi ahli untuk pengembangan dan implementasi sistem manajemen mutu di fasilitas kesehatan. Tim konsultan berpengalaman akan membantu organisasi Anda mencapai standar mutu tertinggi.',
                'icon' => 'Users',
                'price' => 5000000.00,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'Pelatihan Akreditasi',
                'slug' => 'pelatihan-akreditasi',
                'description' => 'Program pelatihan komprehensif untuk tim akreditasi dan manajemen mutu fasilitas kesehatan.',
                'content' => 'Program pelatihan yang dirancang untuk meningkatkan kompetensi tim dalam mempersiapkan akreditasi. Meliputi workshop, simulasi, dan pendampingan praktis dengan metode pembelajaran yang interaktif.',
                'icon' => 'GraduationCap',
                'price' => 3000000.00,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'title' => 'Audit Internal',
                'slug' => 'audit-internal',
                'description' => 'Layanan audit internal untuk evaluasi sistem mutu dan persiapan akreditasi eksternal.',
                'content' => 'Layanan audit internal profesional untuk evaluasi kesiapan akreditasi fasilitas kesehatan. Tim auditor bersertifikat akan melakukan assessment menyeluruh dan memberikan rekomendasi perbaikan.',
                'icon' => 'Search',
                'price' => 8000000.00,
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
