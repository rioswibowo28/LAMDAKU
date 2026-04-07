<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisionMissionGoal;

class VisionMissionGoalSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Clear existing data
        VisionMissionGoal::truncate();

        // Vision
        VisionMissionGoal::create([
            'type' => 'vision',
            'title' => 'Visi',
            'content' => 'Menjadi lembaga akreditasi kesehatan terdepan dan terpercaya di Asia Tenggara yang berkomitmen meningkatkan kualitas pelayanan kesehatan melalui standar akreditasi internasional yang komprehensif dan berkelanjutan.',
            'description' => 'Visi kami adalah menjadi pemimpin dalam akreditasi kesehatan di regional Asia Tenggara',
            'icon_class' => 'fas fa-eye',
            'background_color' => '#4285f4',
            'sort_order' => 1,
            'is_active' => true
        ]);

        // Missions
        $missions = [
            'Memberikan layanan akreditasi berkualitas tinggi sesuai standar internasional',
            'Meningkatkan kompetensi dan profesionalisme tenaga kesehatan',
            'Mengembangkan sistem manajemen mutu yang berkelanjutan',
            'Memberikan konsultasi dan pendampingan terbaik kepada klien',
            'Melakukan inovasi berkelanjutan dalam metodologi akreditasi',
            'Membangun kemitraan strategis dengan stakeholder kesehatan'
        ];

        foreach ($missions as $index => $mission) {
            VisionMissionGoal::create([
                'type' => 'mission',
                'title' => $mission,
                'content' => $mission,
                'description' => null,
                'icon_class' => 'fas fa-check-circle',
                'background_color' => '#34a853',
                'sort_order' => $index + 1,
                'is_active' => true
            ]);
        }

        // Goals
        $goals = [
            [
                'title' => 'Meningkatkan Kualitas Pelayanan',
                'content' => 'Memberikan setiap fasilitas kesehatan yang lulus akan memberikan pelayanan terbaik kepada masyarakat',
                'description' => 'Menyediakan akreditasi yang meningkatkan standar pelayanan kesehatan di Indonesia'
            ],
            [
                'title' => 'Membangun Kepercayaan Publik',
                'content' => 'Meningkatkan transparansi dan akuntabilitas dari setiap fasilitas kesehatan yang terakreditasi',
                'description' => 'Membangun kepercayaan masyarakat terhadap kualitas pelayanan kesehatan'
            ],
            [
                'title' => 'Mendorong Inovasi',
                'content' => 'Mendorong fasilitas pelayanan kesehatan untuk melakukan inovasi dalam metodologi akreditasi yang adaptif terhadap perkembangan teknologi kesehatan',
                'description' => 'Mendorong inovasi dan pengembangan teknologi dalam pelayanan kesehatan'
            ]
        ];

        foreach ($goals as $index => $goal) {
            VisionMissionGoal::create([
                'type' => 'goal',
                'title' => $goal['title'],
                'content' => $goal['content'],
                'description' => $goal['description'],
                'icon_class' => 'fas fa-bullseye',
                'background_color' => '#fbbc04',
                'sort_order' => $index + 1,
                'is_active' => true
            ]);
        }
    }
}