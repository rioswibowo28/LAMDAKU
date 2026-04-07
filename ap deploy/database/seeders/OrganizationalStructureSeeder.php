<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrganizationalStructure;

class OrganizationalStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $structures = [
            // Level 1 - Direktur Utama
            [
                'name' => 'Dr. Ahmad Santoso, M.Kes',
                'position' => 'Direktur Utama',
                'description' => 'Memimpin kebijakan strategis dan pengembangan organisasi',
                'level_order' => 1,
                'position_order' => 1,
                'background_color' => '#ffebee',
                'icon_class' => 'fas fa-crown',
                'is_active' => true
            ],
            
            // Level 2 - Direktur
            [
                'name' => 'Dr. Sari Wijaya, M.M',
                'position' => 'Direktur Operasional',
                'description' => 'Mengawasi operasional harian dan implementasi standar',
                'level_order' => 2,
                'position_order' => 1,
                'background_color' => '#e8f5e8',
                'icon_class' => 'fas fa-cogs',
                'is_active' => true
            ],
            [
                'name' => 'Prof. Budi Hartono, Ph.D',
                'position' => 'Direktur Pengembangan',
                'description' => 'Bertanggung jawab atas R&D dan inovasi metodologi',
                'level_order' => 2,
                'position_order' => 2,
                'background_color' => '#e8f5e8',
                'icon_class' => 'fas fa-chart-line',
                'is_active' => true
            ],
            
            // Level 3 - Manager
            [
                'name' => 'Dr. Lisa Permata, Sp.PK',
                'position' => 'Manajer Akreditasi Klinik',
                'description' => 'Memimpin tim akreditasi untuk klinik dan rumah sakit',
                'level_order' => 3,
                'position_order' => 1,
                'background_color' => '#fff3e0',
                'icon_class' => 'fas fa-hospital',
                'is_active' => true
            ],
            [
                'name' => 'Dr. Rio Mandala, M.Si',
                'position' => 'Manajer Akreditasi Lab',
                'description' => 'Mengelola akreditasi laboratorium medis',
                'level_order' => 3,
                'position_order' => 2,
                'background_color' => '#fff3e0',
                'icon_class' => 'fas fa-flask',
                'is_active' => true
            ],
            
            // Level 4 - Supervisor (contoh tambahan)
            [
                'name' => 'Ir. Dewi Sartika, M.T',
                'position' => 'Supervisor Quality Assurance',
                'description' => 'Mengawasi implementasi sistem jaminan mutu',
                'level_order' => 4,
                'position_order' => 1,
                'background_color' => '#f3e5f5',
                'icon_class' => 'fas fa-shield-alt',
                'is_active' => true
            ],
            [
                'name' => 'Drs. Agus Prasetyo, M.Pd',
                'position' => 'Supervisor Training & Development',
                'description' => 'Mengelola program pelatihan dan pengembangan SDM',
                'level_order' => 4,
                'position_order' => 2,
                'background_color' => '#f3e5f5',
                'icon_class' => 'fas fa-graduation-cap',
                'is_active' => true
            ]
        ];

        foreach ($structures as $structure) {
            OrganizationalStructure::create($structure);
        }
    }
}
