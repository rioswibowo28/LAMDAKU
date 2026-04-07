<?php

namespace Database\Seeders;

use App\Models\Timeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timelines = [
            [
                'year' => 2008,
                'title' => 'Pendirian LAMDAKU',
                'description' => 'LAMDAKU didirikan sebagai lembaga akreditasi kesehatan pertama di Indonesia dengan fokus pada peningkatan mutu pelayanan kesehatan.',
                'icon' => 'fas fa-building',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'year' => 2010,
                'title' => 'Sertifikasi ISO 9001',
                'description' => 'Memperoleh sertifikasi ISO 9001:2008 untuk sistem manajemen mutu, menunjukkan komitmen terhadap standar internasional.',
                'icon' => 'fas fa-award',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'year' => 2012,
                'title' => 'Ekspansi Layanan',
                'description' => 'Memperluas layanan akreditasi untuk mencakup rumah sakit, klinik, dan laboratorium kesehatan.',
                'icon' => 'fas fa-chart-line',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'year' => 2015,
                'title' => 'Kemitraan Internasional',
                'description' => 'Menjalin kemitraan strategis dengan organisasi akreditasi internasional untuk transfer knowledge dan best practices.',
                'icon' => 'fas fa-globe',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'year' => 2018,
                'title' => 'Digitalisasi Proses',
                'description' => 'Implementasi sistem manajemen akreditasi digital untuk meningkatkan efisiensi dan transparansi proses.',
                'icon' => 'fas fa-rocket',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'year' => 2020,
                'title' => 'Respons Pandemi',
                'description' => 'Mengembangkan protokol akreditasi khusus untuk fasilitas kesehatan dalam menghadapi pandemi COVID-19.',
                'icon' => 'fas fa-shield',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'year' => 2022,
                'title' => 'Pencapaian 1000+ Fasyankes',
                'description' => 'Berhasil mengakreditasi lebih dari 1000 fasilitas kesehatan di seluruh Indonesia dengan tingkat kepuasan 95%.',
                'icon' => 'fas fa-trophy',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'year' => 2025,
                'title' => 'Visi 2025',
                'description' => 'Melanjutkan komitmen untuk menjadi lembaga akreditasi kesehatan terdepan dengan standar dunia dan inovasi berkelanjutan.',
                'icon' => 'fas fa-flag',
                'is_active' => true,
                'sort_order' => 8
            ]
        ];

        foreach ($timelines as $timeline) {
            Timeline::create($timeline);
        }
    }
}
